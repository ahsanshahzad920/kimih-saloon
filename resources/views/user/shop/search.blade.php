@extends('user.layouts.app')

@section('title', 'Home')
@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        /* Customize the scrollbar width and background color */
        .shop-listing::-webkit-scrollbar {
            width: 10px;
            background-color: #f5f5f5;
            /* background-color: var(--mainColor); */
        }

        /* Customize the scrollbar thumb (the draggable handle) */
        .shop-listing::-webkit-scrollbar-thumb {
            /* background-color: #888; */
            background-color: var(--mainColor);
            border-radius: 5px;
        }
        .highlighted { background-color: #f0f0f0; }

    </style>
@endsection
@section('content')

    <section class="services-area my-5">
        <div class="container">

            {{-- <div class="row">
                @forelse ($users as $user)
                    <div class="col-lg-4 col-6 col-container">
                        <div class="services-card">
                            <a href="{{ route('shop.details', $user->businessUser->slug ?? '') }}">
                                <img src="{{ isset($user->businessUser->images[0]) ? asset('storage/' . $user->businessUser->images[0]['image']) : asset('assets/images/shope.png') }}"
                                    alt="Services" />
                            </a>
                            <div class="content">
                                <h3><a
                                        href="{{ route('shop.details', $user->businessUser->slug ?? '') }}">{{ $user->businessUser->business_name }}</a>
                                </h3>
                                <p class="mb-0">4.8 <i class="flaticon-star mt-1"></i> (1028)</p>
                                <hr>
                                <ul class="search-result-servcies">
                                    @foreach ($user->services as $service)
                                        @if ($loop->index < 3)
                                            <li class="">
                                                <p>{{ $service->service_name ?? '' }}</p>
                                                <p><b>AED {{ $service->price }}</b></p>
                                            </li>
                                        @endif
                                    @endforeach

                                </ul>
                                <a href="{{ route('shop.details', $user->businessUser->slug ?? '') }}" class="more-btn">
                                    <i class="flaticon-arrow-pointing-to-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class=" rounded-lg mb-5">
                        <div class="card-body text-center p-5">
                            <h5>No Record Found!</h5>
                        </div>
                    </div>
                @endforelse

                <div class="col-lg-12 text-center mt-20">
                    <div class="pagination-area">
                        <a href="blog-1.html" class="prev page-numbers">
                            <i class="flaticon-arrow-pointing-to-left"></i>
                        </a>
                        <span class="page-numbers current" aria-current="page">1</span>
                        <a href="blog-1.html" class="page-numbers">2</a>
                        <a href="blog-1.html" class="page-numbers">3</a>
                        <a href="blog-1.html" class="next page-numbers">
                            <i class="flaticon-arrow-pointing-to-right"></i>
                        </a>
                    </div>
                </div>
            </div> --}}

            <div class="row">
                <div class="col-3 col-md-3 col-lg-3 shop-listing vh-100" style="overflow-y:auto">
                    @forelse ($users as $user)
                        <div class="col-lg-12 col-12 col-container shop-item" data-lat="{{ $user->businessUser->latitude }}" data-lng="{{ $user->businessUser->longitude }}">
                            <div class="services-card">
                                <a href="{{ route('shop.details', $user->businessUser->slug ?? '') }}">
                                    <img src="{{ isset($user->businessUser->images[0]) ? asset('storage/' . $user->businessUser->images[0]['image']) : asset('assets/images/shope.png') }}"
                                        alt="Services" />
                                </a>
                                <div class="content">
                                    <h3><a
                                            href="{{ route('shop.details', $user->businessUser->slug ?? '') }}">{{ $user->businessUser->business_name }}</a>
                                    </h3>
                                    <p class="mb-0">{{number_format($user->feedback()->avg('rating'), 1) ?? '0.0'}} <i class="flaticon-star mt-1"></i> ({{$user->feedback->count()}})</p>
                                    <hr>
                                    <ul class="search-result-servcies">
                                        @foreach ($user->services as $service)
                                            @if ($loop->index < 3)
                                                <li class="">
                                                    <p>{{ $service->service_name ?? '' }}</p>
                                                    <p><b>AED {{ $service->price }}</b></p>
                                                </li>
                                            @endif
                                        @endforeach

                                    </ul>
                                    <a href="{{ route('shop.details', $user->businessUser->slug ?? '') }}" class="more-btn">
                                        <i class="flaticon-arrow-pointing-to-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class=" rounded-lg mb-5">
                            <div class="card-body text-center p-5">
                                <h5>No Record Found!</h5>
                            </div>
                        </div>
                    @endforelse
                </div>
                <div class="col-9 col-md-9 col-lg-9 map">

                    <div id="map" class="vh-100"></div>
                </div>
            </div>

        </div>
    </section>



@endsection

@section('scripts')

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Initialize the map
        var shopLocations = @json($shopLocations);
        var initialCoordinates = shopLocations.length > 0
        ? [shopLocations[0].latitude, shopLocations[0].longitude]
        : [25.276987, 55.296249];
        var map = L.map('map').setView(initialCoordinates, 10);

        // Set up the OSM layer
        // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //     maxZoom: 19,
        // }).addTo(map);   //for tile layer in local language

        // var MapTilesAPI_OSMEnglish = L.tileLayer('https://maptiles.p.rapidapi.com/en/map/v1/{z}/{x}/{y}.png?rapidapi-key={apikey}', {
        //     attribution: '&copy; <a href="http://www.maptilesapi.com/">MapTiles API</a>, &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        //     apikey: '<your apikey>',
        //     maxZoom: 19
        // }); //for change tile language to english


        // L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        //     maxZoom: 20
        // }).addTo(map);
        var MapTilesAPI_OSMEnglish = L.tileLayer('https://maptiles.p.rapidapi.com/en/map/v1/{z}/{x}/{y}.png?rapidapi-key=a29a17d2e5msh769b99a40b2d11dp1e3fbejsnb9cb2adc9905', {
            attribution: '&copy; <a href="http://www.maptilesapi.com/">MapTiles API</a>, &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19
        }).addTo(map);

        // Example data passed from the backend

        var blackIconSmall = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-black.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 33],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        var blackIconBig = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-black.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [30, 44],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });


        let markers = {};
        // Add markers to the map
        shopLocations.forEach(function(shop) {
            let marker =  L.marker([shop.latitude, shop.longitude],{icon: blackIconSmall})
                .bindPopup(`
                        <div class="col-lg-12 col-12 col-container">
                            <div class="services-card">
                                <a href="/shop/${shop.shop.slug}">
                                    <img src="${shop.shop_image}"
                                        alt="Not Found" />
                                </a>
                                <div class="content">
                                    <h3><a href="/shop/${shop.shop.slug}">${shop.shop.business_name}</a></h3>
                                    <p class="mb-0">4.8 <i class="flaticon-star mt-1"></i> (1028)</p>
                                    <p>${shop.shop.city ?? ''} , ${shop.shop.country ?? ''} </p>
                                    <a href="/shop/${shop.shop.slug}" class="more-btn">
                                        <i class="flaticon-arrow-pointing-to-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
            `)
            .addTo(map);

            // marker.on('click', function(e) {
            //     map.setView(e.latlng, 15);
            // });
            marker.on('mouseover', function(e) {
                marker.setIcon(blackIconBig)
            });
            marker.on('mouseout', function(e) {
                marker.setIcon(blackIconSmall)
            });

            markers[shop.shop.id] = marker;


        });

        // Set the initial zoom level (you can adjust this as needed)
        map.setZoom(11);

        // Event listeners for shop items
        document.querySelectorAll('.shop-item').forEach(function(item) {
            item.addEventListener('mouseover', function() {
                var lat = item.getAttribute('data-lat');
                var lng = item.getAttribute('data-lng');
                var shopId = shopLocations.find(shop => shop.shop.latitude == lat && shop.shop.longitude == lng).shop.id;
                var marker = markers[shopId];
                if (marker) {
                    marker.setIcon(blackIconBig);
                }
                item.classList.add('highlighted');
            });

            item.addEventListener('mouseout', function() {
                var lat = item.getAttribute('data-lat');
                var lng = item.getAttribute('data-lng');
                var shopId = shopLocations.find(shop => shop.shop.latitude == lat && shop.shop.longitude == lng).shop.id;
                var marker = markers[shopId];
                if (marker) {
                    marker.setIcon(blackIconSmall);
                }
                item.classList.remove('highlighted');
            });
        });
    </script>


@endsection
