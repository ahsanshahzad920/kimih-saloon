@extends('user.layouts.app')

@php
    $bizName = $user->businessUser->business_name ?? 'Salon';
    $bizCity = $user->businessUser->city ?? 'Pakistan';
    $bizImagesTop = $user->businessUser->images ?? collect();
    $bizOgImage = ($bizImagesTop->count() > 0 && !empty($bizImagesTop->get(0)->image)) ? asset('storage/' . $bizImagesTop->get(0)->image) : asset('assets/images/favicon.png');
@endphp

@section('title', $bizName . ' - Book Online in ' . $bizCity)
@section('meta_description', 'Book an appointment at ' . $bizName . ' in ' . $bizCity . ', Pakistan. View services, prices, reviews, and available time slots. Instant online booking on Kimih.')
@section('og_image', $bizOgImage)

@section('styles')
<style>
    /* Inline helper overrides for venue page */
    .fresha-subnav-links, .fresha-badge-row ul {
        list-style: none !important;
        padding-left: 0 !important;
    }
    .fresha-subnav-links li {
        list-style-type: none !important;
    }
    .fresha-gallery-photos-btn {
        position: absolute;
        bottom: 16px;
        right: 16px;
        z-index: 5;
        background: rgba(255, 255, 255, 0.92);
        -webkit-backdrop-filter: blur(8px);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 20px;
        padding: 6px 16px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #111827;
        box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .fresha-gallery-photos-btn:hover {
        background: #ffffff;
        transform: scale(1.03);
    }
    
    /* Opening Times Dot Styling */
    .opening-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: #10B981;
        display: inline-block;
        margin-right: 8px;
    }
    .opening-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 6px 0;
        font-size: 0.92rem;
        color: #374151;
    }
    .opening-row.today {
        font-weight: 700;
        color: #111827;
    }
</style>
@endsection

@section('content')
@php
    $ldRatingCount = $feedbacks->count() ?? 0;
    $ldRatingAvg = $ldRatingCount > 0 ? round($feedbacks->avg('rating'), 1) : null;
@endphp
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BeautySalon",
    "name": "{{ addslashes($bizName) }}",
    "image": "{{ $bizOgImage }}",
    "url": "{{ url()->current() }}",
    "address": {
        "@type": "PostalAddress",
        "addressLocality": "{{ addslashes($bizCity) }}",
        "addressCountry": "PK"
    }
    @if ($user->businessUser->latitude && $user->businessUser->longitude)
    ,"geo": {
        "@type": "GeoCoordinates",
        "latitude": "{{ $user->businessUser->latitude }}",
        "longitude": "{{ $user->businessUser->longitude }}"
    }
    @endif
    @if ($ldRatingAvg)
    ,"aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "{{ $ldRatingAvg }}",
        "reviewCount": "{{ $ldRatingCount }}"
    }
    @endif
}
</script>
<div class="fresha-page-wrapper py-4">
    <div class="container">

        {{-- Breadcrumb --}}
        <div class="fresha-breadcrumb mb-3">
            <a href="/">Home</a>
            <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
            <a href="{{ route('shop.search') }}">Salons & Wellness</a>
            <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
            <span>{{ $user->businessUser->city ?? 'Location' }}</span>
            <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
            <span class="text-dark fw-semibold">{{ $user->businessUser->business_name }}</span>
        </div>

        {{-- 1. Fresha 3-Photo Gallery Mosaic --}}
        @php
            $bizImages = $user->businessUser->images ?? collect();
            $img0 = ($bizImages->count() > 0 && !empty($bizImages->get(0)->image)) ? asset('storage/' . $bizImages->get(0)->image) : 'https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=1200&q=80';
            $img1 = ($bizImages->count() > 1 && !empty($bizImages->get(1)->image)) ? asset('storage/' . $bizImages->get(1)->image) : 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=800&q=80';
            $img2 = ($bizImages->count() > 2 && !empty($bizImages->get(2)->image)) ? asset('storage/' . $bizImages->get(2)->image) : 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?auto=format&fit=crop&w=800&q=80';
            $totalPhotosCount = max($bizImages->count(), 3);
        @endphp
        
        <div class="fresha-gallery-wrapper position-relative">
            <div class="fresha-gallery-grid">
                <div class="fresha-gallery-main gallery-tile">
                    <img src="{{ $img0 }}" alt="{{ $user->businessUser->business_name }}" />
                </div>
                <div class="fresha-gallery-side">
                    <div class="gallery-tile">
                        <img src="{{ $img1 }}" alt="{{ $user->businessUser->business_name }} Interior" />
                    </div>
                    <div class="gallery-tile">
                        <img src="{{ $img2 }}" alt="{{ $user->businessUser->business_name }} Atmosphere" />
                    </div>
                </div>
            </div>
            <button type="button" class="fresha-gallery-photos-btn">
                <i class="fa-solid fa-camera me-1"></i> See all photos ({{ $totalPhotosCount }})
            </button>
        </div>

        {{-- 2. Fresha Venue Header & Action Cards --}}
        <div class="fresha-venue-header">
            <div class="row align-items-center">
                <div class="col-lg-8 col-12">
                    <h1 class="fresha-venue-title">{{ $user->businessUser->business_name }}</h1>
                    <div class="fresha-badge-row">
                        <span class="rating-star-badge">
                            <i class="fa-solid fa-star text-warning"></i> 5.0 <span>(120+ reviews)</span>
                        </span>
                        <span class="verified-venue-badge">
                            <i class="fa-solid fa-circle-check"></i> Verified Venue
                        </span>
                        <span class="text-muted">
                            <i class="fa-solid fa-clock text-success me-1"></i> Open today • 11:00 AM - 8:00 PM
                        </span>
                        <span class="text-muted">
                            <i class="fa-solid fa-location-dot text-purple me-1"></i> {{ $user->businessUser->location ?? ($user->businessUser->city . ', ' . $user->businessUser->country) }}
                        </span>
                    </div>
                </div>
                <div class="col-lg-4 col-12 mt-3 mt-lg-0 text-lg-end">
                    <div class="fresha-action-btns justify-content-lg-end">
                        <a href="{{ route('shop.services', ['slug' => $user->businessUser->slug]) }}" class="btn-fresha-primary">
                            <i class="fa-solid fa-calendar-check"></i> Book Now
                        </a>
                        <a href="/messenger/{{ $user->id }}" class="btn-fresha-outline">
                            <i class="fa-solid fa-comments"></i> Chat
                        </a>
                        <a href="https://maps.google.com/?q={{ urlencode($user->businessUser->location ?? $user->businessUser->business_name) }}" target="_blank" class="btn-fresha-outline">
                            <i class="fa-solid fa-compass"></i> Directions
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. Sub-Header Navigation Sticky Bar --}}
        <div class="fresha-subnav-sticky">
            <div class="container">
                <ul class="fresha-subnav-links">
                    <li><a href="#services-section" class="fresha-subnav-link active">Services</a></li>
                    <li><a href="#reviews-section" class="fresha-subnav-link">Reviews</a></li>
                    <li><a href="#team-section" class="fresha-subnav-link">Team</a></li>
                    <li><a href="#about-section" class="fresha-subnav-link">About & Location</a></li>
                </ul>
            </div>
        </div>

        {{-- 4. Main Content 2-Column Grid --}}
        <div class="row g-4 mb-5">
            
            {{-- Left Main Column (70%) --}}
            <div class="col-lg-8 col-12">
                
                {{-- Services Section --}}
                <div id="services-section" class="bg-white p-4 rounded-4 border mb-4 shadow-sm">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h2 class="h4 fw-bold text-dark m-0">Services Menu</h2>
                        <span class="badge bg-light text-dark border">{{ $services->count() }} Services Available</span>
                    </div>

                    {{-- Service Search Filter --}}
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-magnifying-glass"></i></span>
                            <input type="text" id="serviceSearchInput" class="form-control bg-light border-start-0 ps-0" placeholder="Search services..." onkeyup="searchServicesFilter()">
                        </div>
                    </div>

                    {{-- Category Filter Pills --}}
                    @if(isset($user->serviceCategory) && $user->serviceCategory->count() > 0)
                        <div class="category-pills-row">
                            <button class="category-pill-btn active" onclick="filterServices('all', this)">All Services</button>
                            @foreach($user->serviceCategory as $cat)
                                <button class="category-pill-btn" onclick="filterServices('cat-{{ $cat->id }}', this)">{{ $cat->name }}</button>
                            @endforeach
                        </div>
                    @endif

                    {{-- Services Items Grid --}}
                    <div class="services-list-wrapper">
                        @forelse ($services as $service)
                            <div class="fresha-service-item service-card-node cat-all cat-{{ $service->category_id ?? '' }}">
                                <div class="service-left">
                                    <div class="service-title">{{ $service->service_name ?? '' }}</div>
                                    @if(!empty($service->description))
                                        <div class="service-desc">{{ Str::limit($service->description, 120) }}</div>
                                    @endif
                                    <div class="service-meta">
                                        <span class="service-time"><i class="fa-regular fa-clock me-1"></i> {{ $service->duration ?? '30 mins' }}</span>
                                        <span class="service-price">Rs {{ number_format($service->price, 0) }}</span>
                                    </div>
                                </div>
                                <div class="service-right">
                                    <button class="btn-select-service" 
                                            onclick="toggleCartService('{{ $service->id }}', '{{ addslashes($service->service_name) }}', '{{ $service->duration ?? '30 mins' }}', '{{ $service->price }}', this)">
                                        + Add
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5 text-muted">
                                <i class="fa-solid fa-scissors fa-2x mb-2 text-purple" style="color: #4b1fa8;"></i>
                                <p>No services currently listed for this shop.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Reviews Section --}}
                <div id="reviews-section" class="bg-white p-4 rounded-4 border mb-4 shadow-sm">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h2 class="h4 fw-bold text-dark m-0">Reviews & Ratings</h2>
                        @auth
                            <button class="btn btn-outline-primary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#customerFeedbackModal">
                                <i class="fa-solid fa-pen me-1"></i> Write a Review
                            </button>
                        @endauth
                    </div>

                    {{-- Rating Breakdown Box --}}
                    <div class="rating-summary-card">
                        <div class="text-center">
                            <div class="rating-big-num">5.0</div>
                            <div class="text-warning small my-1">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="text-muted small">Based on 120+ reviews</div>
                        </div>
                        <div class="vr mx-3 d-none d-sm-block" style="height: 60px;"></div>
                        <div class="flex-grow-1 small text-muted">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span>5 ★</span>
                                <div class="progress flex-grow-1" style="height: 6px;"><div class="progress-bar bg-warning" style="width: 95%;"></div></div>
                                <span>95%</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span>4 ★</span>
                                <div class="progress flex-grow-1" style="height: 6px;"><div class="progress-bar bg-warning" style="width: 5%;"></div></div>
                                <span>5%</span>
                            </div>
                        </div>
                    </div>

                    {{-- Reviews List --}}
                    @forelse ($feedbacks as $feedback)
                        <div class="border-bottom pb-3 mb-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="fw-bold text-dark">{{ $feedback->name ?? 'Verified Client' }}</div>
                                <div class="text-warning small">
                                    @for ($i = 0; $i < ($feedback->rating ?? 5); $i++)
                                        <i class="fa-solid fa-star"></i>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-muted small mb-0">{{ $feedback->feedback }}</p>
                        </div>
                    @empty
                        <p class="text-muted text-center py-3 small">No client reviews yet. Be the first to share your experience!</p>
                    @endforelse
                </div>

                {{-- Team Section --}}
                <div id="team-section" class="bg-white p-4 rounded-4 border mb-4 shadow-sm">
                    <h2 class="h4 fw-bold text-dark mb-4">Meet the Stylists</h2>
                    <div class="row g-3">
                        @forelse ($team_members as $team_member)
                            <div class="col-md-4 col-6">
                                <div class="fresha-staff-card text-center p-3 border rounded-3">
                                    <img src="{{ asset($team_member->image ?? 'assets/images/gallery/gallery-img10.jpg') }}" class="fresha-staff-avatar rounded-circle mb-2" style="width: 72px; height: 72px; object-fit: cover;" alt="{{ $team_member->name }}" />
                                    <div class="fw-bold text-dark mb-1 small">{{ $team_member->name ?? 'Staff Member' }}</div>
                                    <div class="text-muted small" style="font-size: 12px;">{{ $team_member->job_title ?? 'Professional Stylist' }}</div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center text-muted py-3 small">No team members currently listed.</div>
                        @endforelse
                    </div>
                </div>

                {{-- About & Opening Times Section --}}
                <div id="about-section" class="bg-white p-4 rounded-4 border mb-4 shadow-sm">
                    <h2 class="h4 fw-bold text-dark mb-3">About {{ $user->businessUser->business_name }}</h2>
                    <p class="text-muted leading-relaxed mb-4 small">
                        {{ $user->businessUser->about_us ?? 'Welcome to our premium beauty & wellness destination! We offer high quality treatments tailored to elevate your style and well-being.' }}
                    </p>

                    {{-- Opening Times & Additional Info Grid (Matching Fresha UX) --}}
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <h3 class="h5 fw-bold text-dark mb-3">Opening times</h3>
                            <div class="opening-hours-list">
                                <div class="opening-row">
                                    <span><span class="opening-dot"></span>Monday</span>
                                    <span>11:00 AM - 8:00 PM</span>
                                </div>
                                <div class="opening-row">
                                    <span><span class="opening-dot"></span>Tuesday</span>
                                    <span>11:00 AM - 8:00 PM</span>
                                </div>
                                <div class="opening-row">
                                    <span><span class="opening-dot"></span>Wednesday</span>
                                    <span>11:00 AM - 8:00 PM</span>
                                </div>
                                <div class="opening-row">
                                    <span><span class="opening-dot"></span>Thursday</span>
                                    <span>11:00 AM - 8:00 PM</span>
                                </div>
                                <div class="opening-row">
                                    <span><span class="opening-dot"></span>Friday</span>
                                    <span>11:00 AM - 8:00 PM</span>
                                </div>
                                <div class="opening-row today">
                                    <span><span class="opening-dot"></span>Saturday</span>
                                    <span>11:00 AM - 8:00 PM</span>
                                </div>
                                <div class="opening-row">
                                    <span><span class="opening-dot"></span>Sunday</span>
                                    <span>11:00 AM - 8:00 PM</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h3 class="h5 fw-bold text-dark mb-3">Additional information</h3>
                            <div class="d-flex flex-column gap-3 small text-dark">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fa-regular fa-circle-check text-dark fs-6"></i>
                                    <span>Instant confirmation</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fa-solid fa-wifi text-dark fs-6"></i>
                                    <span>Free High-Speed Wi-Fi</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fa-regular fa-credit-card text-dark fs-6"></i>
                                    <span>Digital & Card Payments Accepted</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fa-solid fa-wheelchair text-dark fs-6"></i>
                                    <span>Wheelchair Accessible</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="h6 fw-bold text-dark mb-3">Location & Directions</h3>
                    <div class="rounded-4 overflow-hidden border">
                        <iframe
                            src="https://maps.google.com/maps?q={{ $user->businessUser->latitude ?? '31.5994529' }},{{ $user->businessUser->longitude ?? '74.3379943' }}&t=m&z=16&ie=UTF8&iwloc=&output=embed"
                            width="100%" height="280" style="border:0;" allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                </div>

            </div>

            {{-- Right Sticky Sidebar Column (30%) --}}
            <div class="col-lg-4 col-12">
                <div class="fresha-cart-sidebar sticky-top" style="top: 80px;">
                    <div class="cart-sidebar-title">
                        <span>Your Booking</span>
                        <span id="cartCountBadge" class="badge rounded-pill px-2 py-1" style="font-size: 12px; background: rgba(75,31,168,0.1); color: #4b1fa8;">0 items</span>
                    </div>

                    <div id="cartItemsContainer" class="cart-items-list">
                        <div class="text-center text-muted py-4 small" id="emptyCartNotice">
                            <i class="fa-solid fa-basket-shopping fa-2x mb-2 text-muted" style="opacity: 0.4;"></i>
                            <p class="m-0">No services selected yet.<br/>Click <strong>+ Add</strong> on any service to start booking.</p>
                        </div>
                    </div>

                    <div class="cart-total-bar">
                        <div class="cart-total-row">
                            <span>Total</span>
                            <span id="cartTotalSum">Rs 0</span>
                        </div>
                    </div>

                    <a id="cartCheckoutBtn" 
                       href="{{ route('shop.services', ['slug' => $user->businessUser->slug]) }}" 
                       class="btn-checkout-fresha text-decoration-none">
                        Book Appointment <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>

        </div>

        {{-- 5. Venues Nearby Section (Matching Fresha Screenshot) --}}
        @if(isset($nearByUsers) && $nearByUsers->count() > 0)
            <div class="venues-nearby-section pt-4 border-top">
                <h2 class="h3 fw-bold text-dark mb-4">Venues nearby</h2>
                <div class="row g-3">
                    @foreach($nearByUsers->take(4) as $nearBySalon)
                        <div class="col-lg-3 col-md-6 col-12">
                            @include('user.components.salon-card', [
                                'salon' => $nearBySalon,
                                'badgeType' => ($loop->index == 0) ? 'Featured' : (($loop->index == 1) ? 'Deals' : null),
                                'cardIndex' => $loop->index
                            ])
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>

{{-- Feedback Modal --}}
<div class="modal fade" id="customerFeedbackModal" tabindex="-1" aria-labelledby="customerFeedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold" id="customerFeedbackModalLabel">Customer Feedback</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('cutomer.feedback.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="store_id" value="{{ $user->id }}" />
                    <div class="form-group mb-3">
                        <label class="form-label fw-semibold">Your Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label fw-semibold">Feedback & Experience</label>
                        <textarea name="feedback" class="form-control" placeholder="Share your experience..." rows="3" required></textarea>
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label fw-semibold">Rating (1 to 5 Stars)</label>
                        <input type="number" min="1" max="5" class="form-control" name="rating" placeholder="5" required>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" style="background: #4b1fa8; border: none;">Submit Review</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let selectedServices = {};

    function filterServices(catClass, btnElement) {
        document.querySelectorAll('.category-pill-btn').forEach(btn => btn.classList.remove('active'));
        btnElement.classList.add('active');

        document.querySelectorAll('.service-card-node').forEach(card => {
            if (catClass === 'all' || card.classList.contains(catClass)) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    function searchServicesFilter() {
        const query = document.getElementById('serviceSearchInput').value.toLowerCase().trim();
        document.querySelectorAll('.service-card-node').forEach(card => {
            const title = card.querySelector('.service-title')?.innerText.toLowerCase() || '';
            const desc = card.querySelector('.service-desc')?.innerText.toLowerCase() || '';
            if (title.includes(query) || desc.includes(query)) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    function toggleCartService(id, name, duration, price, btnElement) {
        if (selectedServices[id]) {
            delete selectedServices[id];
            btnElement.classList.remove('is-selected');
            btnElement.innerText = '+ Add';
        } else {
            selectedServices[id] = { id: id, name: name, duration: duration, price: parseFloat(price) };
            btnElement.classList.add('is-selected');
            btnElement.innerText = '✓ Added';
        }
        updateCartUI();
    }

    function removeCartItem(id) {
        delete selectedServices[id];
        document.querySelectorAll('.btn-select-service').forEach(btn => {
            if (btn.getAttribute('onclick').includes("'" + id + "'")) {
                btn.classList.remove('is-selected');
                btn.innerText = '+ Add';
            }
        });
        updateCartUI();
    }

    function updateCartUI() {
        const container = document.getElementById('cartItemsContainer');
        const countBadge = document.getElementById('cartCountBadge');
        const totalSum = document.getElementById('cartTotalSum');
        const keys = Object.keys(selectedServices);

        if (keys.length === 0) {
            container.innerHTML = `
                <div class="text-center text-muted py-4 small" id="emptyCartNotice">
                    <i class="fa-solid fa-basket-shopping fa-2x mb-2 text-muted" style="opacity: 0.4;"></i>
                    <p class="m-0">No services selected yet.<br/>Click <strong>+ Add</strong> on any service to start booking.</p>
                </div>`;
            countBadge.innerText = '0 items';
            totalSum.innerText = 'Rs 0';
            return;
        }

        let html = '';
        let grandTotal = 0;

        keys.forEach(id => {
            const item = selectedServices[id];
            grandTotal += item.price;
            html += `
                <div class="cart-item-row">
                    <div class="cart-item-info">
                        <div class="title">${item.name}</div>
                        <div class="subtitle">${item.duration} • Rs ${item.price}</div>
                    </div>
                    <button class="cart-item-remove" onclick="removeCartItem('${id}')" title="Remove">&times;</button>
                </div>
            `;
        });

        container.innerHTML = html;
        countBadge.innerText = keys.length + (keys.length === 1 ? ' item' : ' items');
        totalSum.innerText = 'Rs ' + grandTotal.toLocaleString();
    }
</script>
@endsection
