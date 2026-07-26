@extends('user.layouts.app')

@section('title', 'Search Beauty & Wellness Venues | Kimih')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        .search-page-wrapper {
            padding-top: 15px;
            background: #ffffff;
        }

        /* Top Filter Subnav Bar */
        .fresha-search-subbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            padding: 12px 24px;
            border-bottom: 1px solid #e5e7eb;
            background: #ffffff;
        }
        .fresha-type-pills {
            display: flex;
            background: #f3f4f6;
            padding: 3px;
            border-radius: 20px;
        }
        .fresha-type-pill {
            padding: 6px 18px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #4b5563;
            border: none;
            background: transparent;
            cursor: pointer;
            transition: all 0.2s;
        }
        .fresha-type-pill.active {
            background: #ffffff;
            color: #111827;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        }
        .fresha-search-meta {
            font-size: 0.88rem;
            color: #6b7280;
            font-weight: 500;
        }
        .fresha-filter-btn {
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 20px;
            padding: 6px 16px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #111827;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }
        .fresha-filter-btn:hover {
            background: #f9fafb;
            border-color: #9ca3af;
        }

        /* Split View Layout */
        .search-split-container {
            display: flex;
            width: 100%;
            height: calc(100vh - 130px);
            overflow: hidden;
        }
        .search-listing-col {
            width: 55%;
            height: 100%;
            overflow-y: auto;
            padding: 20px 24px 60px;
            scrollbar-width: thin;
        }
        .search-map-col {
            width: 45%;
            height: 100%;
            position: relative;
        }
        #search-map {
            width: 100%;
            height: 100%;
        }

        @media (max-width: 991px) {
            .search-split-container {
                flex-direction: column;
                height: auto;
            }
            .search-listing-col, .search-map-col {
                width: 100%;
                height: 500px;
            }
        }

        /* Rating Marker Pills on Map */
        .leaflet-rating-pill {
            background: #111827;
            color: #ffffff;
            font-size: 0.78rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 4px;
            border: 1.5px solid #ffffff;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .leaflet-rating-pill:hover, .leaflet-rating-pill.active {
            transform: scale(1.15);
            background: #4b1fa8;
            border-color: #ffffff;
        }
        .leaflet-rating-pill .star-ic {
            color: #F59E0B;
            font-size: 0.8rem;
        }
    </style>
@endsection

@section('content')

<div class="search-page-wrapper">

    {{-- Top Search Bar --}}
    <div class="container-fluid px-4 mb-3">
        <form action="{{ route('shop.search') }}" method="GET" class="search-card search-card-form py-2 px-3 border rounded-4 bg-white shadow-sm" role="search">
            <div class="search-grid">
                {{-- Service Select --}}
                <div class="sf">
                    <span class="sf-label">Service category</span>
                    <div class="sf-value">
                        <svg class="ic"><use href="#i-search"/></svg>
                        <select name="service" class="search-select-field" aria-label="Select service">
                            <option value="">All Services</option>
                            @foreach ($serviceCategory as $category)
                                <option value="{{ $category->name }}" {{ request('service') == $category->name ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Location Input with Google Places Autocomplete + Current Location --}}
                <div class="sf" id="locationField">
                    <span class="sf-label">Location</span>
                    <div class="sf-value">
                        <svg class="ic"><use href="#i-geo"/></svg>
                        <input type="text" name="location" id="userLocationInput" class="search-input-field js-location-autocomplete" placeholder="City or area (e.g. Dubai, Riyadh)" value="{{ request('location') }}" autocomplete="off">
                    </div>
                    <input type="hidden" name="lat" id="userLocationLat" value="{{ request('lat') }}">
                    <input type="hidden" name="lng" id="userLocationLng" value="{{ request('lng') }}">

                    <div class="dd-panel" id="locationDropdownPanel">
                        <div class="dd-list">
                            <div class="dd-opt dd-opt-geo" id="useCurrentLocationBtn">
                                <span class="oi"><svg class="ic"><use href="#i-crosshair"/></svg></span>
                                <span class="dd-geo-text">Current location</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Date & Time Picker --}}
                <div class="sf" id="dateTimeField">
                    <span class="sf-label">Date &amp; time</span>
                    <div class="sf-value">
                        <svg class="ic"><use href="#i-calendar"/></svg>
                        <span id="dateTimeDisplay">Any time</span>
                    </div>
                    <input type="hidden" name="date" id="dateTimeDateInput" value="{{ request('date') }}">
                    <input type="hidden" name="time" id="dateTimeTimeInput" value="{{ request('time', 'any') }}">

                    <div class="dd-panel dtp-panel" id="dateTimeDropdownPanel">
                        <div class="dtp-grid">
                            <div class="dtp-quick">
                                <button type="button" class="dtp-quick-btn" data-offset="0">
                                    <span class="dtp-quick-title">Today</span>
                                    <span class="dtp-quick-sub" id="dtpTodaySub"></span>
                                </button>
                                <button type="button" class="dtp-quick-btn" data-offset="1">
                                    <span class="dtp-quick-title">Tomorrow</span>
                                    <span class="dtp-quick-sub" id="dtpTomorrowSub"></span>
                                </button>
                            </div>
                            <div class="dtp-calendar">
                                <div class="dtp-cal-header">
                                    <button type="button" class="dtp-nav-btn" id="dtpPrevMonth" aria-label="Previous month">
                                        <svg class="ic"><use href="#i-arrow-left"/></svg>
                                    </button>
                                    <span class="dtp-cal-title" id="dtpCalTitle"></span>
                                    <button type="button" class="dtp-nav-btn" id="dtpNextMonth" aria-label="Next month">
                                        <svg class="ic"><use href="#i-arrow"/></svg>
                                    </button>
                                </div>
                                <div class="dtp-weekdays">
                                    <span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span>
                                </div>
                                <div class="dtp-days" id="dtpDaysGrid"></div>
                            </div>
                        </div>
                        <div class="dtp-time-row">
                            <span class="dtp-time-label">Select time</span>
                            <div class="dtp-time-opts" id="dtpTimeOpts">
                                <button type="button" class="dtp-time-chip is-active" data-time="any">Any time</button>
                                <button type="button" class="dtp-time-chip" data-time="morning">Morning<small>9am &ndash; 12pm</small></button>
                                <button type="button" class="dtp-time-chip" data-time="afternoon">Afternoon<small>12pm &ndash; 5pm</small></button>
                                <button type="button" class="dtp-time-chip" data-time="evening">Evening<small>5pm &ndash; 12am</small></button>
                                <button type="button" class="dtp-time-chip" data-time="custom">Custom</button>
                            </div>
                        </div>
                        <div class="dtp-custom-time-row" id="dtpCustomTimeRow">
                            <input type="time" id="dtpCustomTimeInput" class="dtp-custom-time-input">
                        </div>
                    </div>
                </div>

                {{-- Search Submit --}}
                <div class="search-go">
                    <button type="submit" class="btn-k btn-hero btn-sm py-2 px-4">
                        Search <svg class="ic"><use href="#i-arrow"/></svg>
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Filter Sub-bar --}}
    <div class="fresha-search-subbar">
        <div class="d-flex align-items-center gap-3">
            <div class="fresha-type-pills">
                <button type="button" class="fresha-type-pill active">Venues</button>
                <button type="button" class="fresha-type-pill">Professionals</button>
            </div>
            <span class="fresha-search-meta">
                <strong>{{ $users->count() }}</strong> {{ Str::plural('venue', $users->count()) }} found {{ request('location') ? 'near ' . request('location') : '' }}
            </span>
        </div>

        <div class="d-flex align-items-center gap-2">
            <button type="button" class="fresha-filter-btn">
                <i class="fa-solid fa-sliders"></i> Filters
            </button>
            <button type="button" class="fresha-filter-btn" id="toggleMapBtn" onclick="toggleMapVisibility()">
                <i class="fa-solid fa-map-location-dot"></i> <span id="mapBtnText">Hide map</span>
            </button>
        </div>
    </div>

    {{-- 50/50 Split View Container --}}
    <div class="search-split-container">
        
        {{-- Left Listing Column (55% width, 2-column grid of Cards) --}}
        <div class="search-listing-col" id="listingCol">
            <div class="row g-3">
                @forelse ($users as $salon)
                    <div class="col-md-6 col-12 shop-card-item" 
                         data-salon-id="{{ $salon->id }}"
                         data-lat="{{ $salon->businessUser->latitude ?? '25.2048' }}" 
                         data-lng="{{ $salon->businessUser->longitude ?? '55.2708' }}">
                        @include('user.components.salon-card', [
                            'salon' => $salon,
                            'badgeType' => ($loop->index % 3 == 0) ? 'Featured' : (($loop->index % 2 == 0) ? 'Deals' : null),
                            'cardIndex' => $loop->index
                        ])
                    </div>
                @empty
                    <div class="col-12 py-5 text-center">
                        <div class="empty-icon-wrap mb-3">
                            <i class="fa-solid fa-store-slash text-muted" style="font-size: 3rem;"></i>
                        </div>
                        <h4 class="h5 fw-bold text-dark mb-1">No venues found for your search</h4>
                        <p class="text-muted small mb-3">Try clearing location or service filters to discover popular spots near you.</p>
                        <a href="{{ route('shop.search') }}" class="btn-k btn-hero btn-sm">
                            Clear Filters <i class="fa-solid fa-rotate-left ms-1"></i>
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Right Map Column (45% width, Leaflet Map with Rating Pins) --}}
        <div class="search-map-col" id="mapCol">
            <div id="search-map"></div>
        </div>

    </div>

</div>

@endsection

@section('scripts')
    <script src="{{ asset('assets/js/kimih.js') }}?v={{ time() }}"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var shopLocations = @json($shopLocations ?? []);
            
            var defaultLat = shopLocations.length > 0 ? parseFloat(shopLocations[0].latitude) : 25.2048;
            var defaultLng = shopLocations.length > 0 ? parseFloat(shopLocations[0].longitude) : 55.2708;
            
            var map = L.map('search-map', {
                zoomControl: false
            }).setView([defaultLat, defaultLng], 12);

            L.control.zoom({ position: 'bottomright' }).addTo(map);

            L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://carto.com/">CARTO</a>'
            }).addTo(map);

            var markersMap = {};

            shopLocations.forEach(function (shopData) {
                var lat = parseFloat(shopData.latitude);
                var lng = parseFloat(shopData.longitude);
                if (isNaN(lat) || isNaN(lng)) return;

                var ratingVal = shopData.shop?.rating || '5.0';
                
                var ratingPillIcon = L.divIcon({
                    className: 'custom-leaflet-pin',
                    html: '<div class="leaflet-rating-pill"><span class="star-ic">★</span> ' + ratingVal + '</div>',
                    iconSize: [60, 26],
                    iconAnchor: [30, 13]
                });

                var marker = L.marker([lat, lng], { icon: ratingPillIcon }).addTo(map);
                
                var popupHtml = `
                    <div style="width: 220px; font-family: inherit;">
                        <img src="${shopData.shop_image}" style="width:100%; height:120px; object-fit:cover; border-radius:10px;" alt="${shopData.shop?.business_name}">
                        <div style="font-weight:700; font-size:0.95rem; margin-top:8px; color:#111827;">${shopData.shop?.business_name}</div>
                        <div style="font-size:0.82rem; color:#6b7280; margin-bottom:8px;">★ ${ratingVal} • ${shopData.shop?.city || ''}</div>
                        <a href="/shop/${shopData.shop?.slug}" style="display:block; text-align:center; background:#4b1fa8; color:#fff; padding:6px 12px; border-radius:8px; font-weight:600; text-decoration:none; font-size:0.82rem;">Book Venue</a>
                    </div>
                `;
                marker.bindPopup(popupHtml);

                if (shopData.shop?.id) {
                    markersMap[shopData.shop.id] = marker;
                }
            });

            // Card hover highlights map marker
            document.querySelectorAll('.shop-card-item').forEach(function (card) {
                var salonId = card.getAttribute('data-salon-id');
                card.addEventListener('mouseenter', function () {
                    if (markersMap[salonId]) {
                        var marker = markersMap[salonId];
                        var el = marker.getElement();
                        if (el) {
                            var pill = el.querySelector('.leaflet-rating-pill');
                            if (pill) pill.classList.add('active');
                        }
                    }
                });
                card.addEventListener('mouseleave', function () {
                    if (markersMap[salonId]) {
                        var marker = markersMap[salonId];
                        var el = marker.getElement();
                        if (el) {
                            var pill = el.querySelector('.leaflet-rating-pill');
                            if (pill) pill.classList.remove('active');
                        }
                    }
                });
            });
        });

        function toggleMapVisibility() {
            var mapCol = document.getElementById('mapCol');
            var listingCol = document.getElementById('listingCol');
            var btnText = document.getElementById('mapBtnText');

            if (mapCol.style.display === 'none') {
                mapCol.style.display = 'block';
                listingCol.style.width = '55%';
                btnText.innerText = 'Hide map';
            } else {
                mapCol.style.display = 'none';
                listingCol.style.width = '100%';
                btnText.innerText = 'Show map';
            }
        }
    </script>
@endsection
