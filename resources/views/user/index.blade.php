@extends('user.layouts.app')

@section('title', 'Home')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/landing-page.css') }}?v={{ time() }}">
    <style>
        .ui-auticomplete {
            width: 440px !important;
            z-index: 99999999999999999999999999999999999;
        }
        @media(max-width: 576px){
            .youtube-video{
                width: 325px !important;
            }
        }
        @media(max-width: 576px){
            .banner-item{
                padding-bottom: 0 !important;
            }
        }
    </style>
@endsection
@section('content')

    {{-- Redesigned Hero Section --}}
    <section class="hero-wrapper-modern">
        {{-- Background glow blobs --}}
        <div class="hero-blob hero-blob-1"></div>
        <div class="hero-blob hero-blob-2"></div>
        
        <div class="container">
            <h1 class="hero-title-modern">
                {{ $home->home_title ?? 'Discover Your Next Beauty & Wellness Experience' }}
            </h1>
            <p class="hero-subtitle-modern">
                Find trusted salons, spas, barbers, and wellness professionals near you — and book your appointment in just a few clicks.
            </p>
            
            {{-- Journey Indicators --}}
            <div class="hero-journey-indicator" aria-label="Kimih booking journey">
                <span class="hero-journey-step is-active">01 Discover</span>
                <span class="hero-journey-arrow"><i class="fa-solid fa-chevron-right"></i></span>
                <span class="hero-journey-step">02 Compare</span>
                <span class="hero-journey-arrow"><i class="fa-solid fa-chevron-right"></i></span>
                <span class="hero-journey-step">03 Book</span>
            </div>
        </div>

        {{-- SVG Wave shape divider --}}
        <div class="hero-wave-divider">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" preserveAspectRatio="none">
                <path d="M0,32L120,42.7C240,53,480,75,720,74.7C960,75,1200,53,1320,42.7L1440,32L1440,120L1320,120C1200,120,960,120,720,120C480,120,240,120,120,120L0,120Z"></path>
            </svg>
        </div>
    </section>

    {{-- Floating Search Card Section --}}
    <section class="search-card-section bg-transparent" style="margin-bottom: 30px;">
        <div class="container">
            <div class="search-card-wrapper">
                <form action="{{ route('shop.search') }}" method="GET">
                    <div class="search-fields-container">
                        
                        {{-- Field 1: Service --}}
                        <div class="search-field-col">
                            <div class="search-field-group">
                                <div class="search-field-icon">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </div>
                                <div class="search-field-content">
                                    <label id="serviceSelectLabel" for="serviceDropdownTrigger">Looking for?</label>
                                    
                                    {{-- Visually hidden original select to preserve functionality --}}
                                    <select name="service" id="serviceSelect" class="visually-hidden">
                                        <option value="">Haircut, Massage, Nails...</option>
                                        @foreach ($serviceCategory as $category)
                                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>

                                    {{-- Custom premium dropdown widget --}}
                                    <div class="custom-dropdown-container">
                                        <button type="button" class="custom-dropdown-trigger" id="serviceDropdownTrigger" aria-haspopup="listbox" aria-expanded="false" aria-labelledby="serviceSelectLabel">
                                            <span class="selected-text-holder">Haircut, Massage, Nails...</span>
                                            <i class="fa-solid fa-chevron-down dropdown-arrow-icon"></i>
                                        </button>
                                        <ul class="custom-dropdown-menu" role="listbox" aria-labelledby="serviceSelectLabel" tabindex="-1">
                                            <li class="custom-dropdown-item selected" role="option" data-value="" aria-selected="true" tabindex="0">
                                                <span class="item-icon"><i class="fa-solid fa-sparkles"></i></span>
                                                <span class="item-text">All Services</span>
                                                <span class="check-icon"><i class="fa-solid fa-check"></i></span>
                                            </li>
                                            @foreach ($serviceCategory as $category)
                                                <li class="custom-dropdown-item" role="option" data-value="{{ $category->name }}" aria-selected="false" tabindex="0">
                                                    <span class="item-icon">
                                                        @if(stripos($category->name, 'hair') !== false || stripos($category->name, 'barber') !== false)
                                                            <i class="fa-solid fa-scissors"></i>
                                                        @elseif(stripos($category->name, 'nail') !== false)
                                                            <i class="fa-solid fa-hand-sparkles"></i>
                                                        @elseif(stripos($category->name, 'massage') !== false)
                                                            <i class="fa-solid fa-spa"></i>
                                                        @elseif(stripos($category->name, 'spa') !== false)
                                                            <i class="fa-solid fa-soap"></i>
                                                        @elseif(stripos($category->name, 'make') !== false || stripos($category->name, 'beauty') !== false)
                                                            <i class="fa-solid fa-wand-magic-sparkles"></i>
                                                        @elseif(stripos($category->name, 'well') !== false)
                                                            <i class="fa-solid fa-heart"></i>
                                                        @else
                                                            <i class="fa-solid fa-sparkles"></i>
                                                        @endif
                                                    </span>
                                                    <span class="item-text">{{ $category->name }}</span>
                                                    <span class="check-icon"><i class="fa-solid fa-check"></i></span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Field 2: Location --}}
                        <div class="search-field-col">
                            <div class="search-field-group">
                                <div class="search-field-icon">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div class="search-field-content">
                                    <label for="addressInput">Location</label>
                                    <input type="text" name="location" id="addressInput" placeholder="Karachi, Pakistan" autocomplete="off">
                                    <div id="suggestionsContainer"></div>
                                </div>
                            </div>
                        </div>

                        {{-- Field 3: Date --}}
                        <div class="search-field-col">
                            <div class="search-field-group">
                                <div class="search-field-icon">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </div>
                                <div class="search-field-content">
                                    <label for="datetimepicker">Date</label>
                                    <input type="text" id="datetimepicker" placeholder="Choose date">
                                </div>
                            </div>
                        </div>

                        {{-- Field 4: Time --}}
                        <div class="search-field-col">
                            <div class="search-field-group">
                                <div class="search-field-icon">
                                    <i class="fa-solid fa-clock"></i>
                                </div>
                                <div class="search-field-content">
                                    <label for="timeInput">Time</label>
                                    <input type="time" id="timeInput" placeholder="Any time">
                                </div>
                            </div>
                        </div>

                        {{-- Hidden inputs --}}
                        <input type="hidden" name="lat" id="lat">
                        <input type="hidden" name="lon" id="lon">

                        {{-- Field 5: Action Submit Button --}}
                        <div class="search-field-col">
                            <button type="submit" class="search-submit-btn" aria-label="Find beauty and wellness services">
                                Search <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>

    {{-- Section 2: Popular Categories --}}
    <section class="categories-area kimih-section-spacing">
        <div class="container">
            <div class="kimih-section-header">
                <span>Quick Discovery</span>
                <h2>Popular Categories</h2>
            </div>
            <div class="categories-grid">
                <div class="category-card-wrapper">
                    <a href="{{ route('shop.search', ['service' => 'Hair Styling']) }}" class="category-card">
                        <div class="category-icon-wrapper">
                            <img src="{{ asset('assets/images/Haircut-styling.svg') }}" alt="Hair icon" />
                        </div>
                        <h4>Hair</h4>
                        <span>Explore Services &rarr;</span>
                    </a>
                </div>
                <div class="category-card-wrapper">
                    <a href="{{ route('shop.search', ['service' => 'Barber Shop']) }}" class="category-card">
                        <div class="category-icon-wrapper">
                            <img src="{{ asset('assets/images/Barbering.svg') }}" alt="Barber icon" />
                        </div>
                        <h4>Barber</h4>
                        <span>Explore Services &rarr;</span>
                    </a>
                </div>
                <div class="category-card-wrapper">
                    <a href="{{ route('shop.search', ['service' => 'Nail Care']) }}" class="category-card">
                        <div class="category-icon-wrapper">
                            <img src="{{ asset('assets/images/Nail services.svg') }}" alt="Nails icon" />
                        </div>
                        <h4>Nails</h4>
                        <span>Explore Services &rarr;</span>
                    </a>
                </div>
                <div class="category-card-wrapper">
                    <a href="{{ route('shop.search', ['service' => 'Spa & Massage']) }}" class="category-card">
                        <div class="category-icon-wrapper">
                            <img src="{{ asset('assets/images/Eyebrows-lashes.svg') }}" alt="Spa icon" />
                        </div>
                        <h4>Spa</h4>
                        <span>Explore Services &rarr;</span>
                    </a>
                </div>
                <div class="category-card-wrapper">
                    <a href="{{ route('shop.search', ['service' => 'Spa & Massage']) }}" class="category-card">
                        <div class="category-icon-wrapper">
                            <img src="{{ asset('assets/images/Massage.svg') }}" alt="Massage icon" />
                        </div>
                        <h4>Massage</h4>
                        <span>Explore Services &rarr;</span>
                    </a>
                </div>
                <div class="category-card-wrapper">
                    <a href="{{ route('shop.search', ['service' => 'Makeup & Beauty']) }}" class="category-card">
                        <div class="category-icon-wrapper">
                            <img src="{{ asset('assets/images/Makeup.svg') }}" alt="Makeup icon" />
                        </div>
                        <h4>Makeup</h4>
                        <span>Explore Services &rarr;</span>
                    </a>
                </div>
                <div class="category-card-wrapper">
                    <a href="{{ route('shop.search', ['service' => 'Skin Care']) }}" class="category-card">
                        <div class="category-icon-wrapper">
                            <img src="{{ asset('assets/images/Facial And skincare.svg') }}" alt="Skincare icon" />
                        </div>
                        <h4>Skincare</h4>
                        <span>Explore Services &rarr;</span>
                    </a>
                </div>
                <div class="category-card-wrapper">
                    <a href="{{ route('shop.search', ['service' => 'Spa & Massage']) }}" class="category-card">
                        <div class="category-icon-wrapper">
                            <img src="{{ asset('assets/images/Fitness.svg') }}" alt="Wellness icon" />
                        </div>
                        <h4>Wellness</h4>
                        <span>Explore Services &rarr;</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 3: Recommended Businesses & Section 4: View All Shops CTA --}}
    <section class="services-area kimih-section-spacing bg-light">
        <div class="container">
            <div class="kimih-section-header">
                <span>Best For You</span>
                <h2>Recommended Salons & Wellness Shops</h2>
            </div>
            <div class="row g-4">
                @foreach ($users as $user)
                    @php
                        $avgRating = $user->feedback->count() > 0 ? number_format($user->feedback->avg('rating'), 1) : null;
                        $reviewCount = $user->feedback->count();
                        $minPrice = $user->services->count() > 0 ? $user->services->min('price') : null;
                        $firstImage = isset($user->businessUser->images[0]) 
                            ? asset('storage/' . $user->businessUser->images[0]['image']) 
                            : asset('assets/images/shope.png');
                        
                        // Extract categories or show short service list
                        $servicesText = $user->businessUser->services ?? '';
                        if (strlen($servicesText) > 40) {
                            $servicesText = substr($servicesText, 0, 37) . '...';
                        }
                    @endphp
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="salon-card">
                            <span class="salon-badge">Top Rated</span>
                            
                            {{-- Favorite button (visual/heart) --}}
                            <button type="button" class="salon-favorite-btn" aria-label="Add to favorites">
                                <i class="fa-regular fa-heart"></i>
                            </button>

                            <div class="salon-card-image-wrapper">
                                <a href="{{ route('shop.details', $user->businessUser->slug ?? '') }}">
                                    <img src="{{ $firstImage }}" alt="{{ $user->businessUser->business_name ?? 'Salon image' }}" loading="lazy" />
                                </a>
                            </div>
                            
                            <div class="salon-card-body">
                                <div class="salon-card-meta">
                                    <span class="salon-card-category">{{ $servicesText ?: 'Wellness & Beauty' }}</span>
                                    <div class="salon-card-rating">
                                        <i class="fa-solid fa-star"></i>
                                        @if ($avgRating)
                                            {{ $avgRating }} <span>({{ $reviewCount }})</span>
                                        @else
                                            <span>New</span>
                                        @endif
                                    </div>
                                </div>

                                <a href="{{ route('shop.details', $user->businessUser->slug ?? '') }}" class="salon-card-title">
                                    {{ $user->businessUser->business_name }}
                                </a>

                                <div class="salon-card-location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    {{ $user->businessUser->city ?? 'Local' }}{{ $user->businessUser->country ? ', ' . $user->businessUser->country : '' }}
                                </div>

                                <div class="salon-card-footer">
                                    <div class="salon-card-price">
                                        @if ($minPrice)
                                            <span class="price-label">Starting from</span>
                                            <span class="price-value">${{ number_format($minPrice, 0) }}</span>
                                        @else
                                            <span class="price-label">Services</span>
                                            <span class="price-value">View Menu</span>
                                        @endif
                                    </div>
                                    <div class="salon-card-actions">
                                        <a href="{{ route('shop.details', $user->businessUser->slug ?? '') }}" class="salon-btn-view">
                                            Details
                                        </a>
                                        <a href="{{ route('shop.services', $user->businessUser->slug ?? '') }}" class="salon-btn-book">
                                            Book Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            {{-- Section 4: Explore All Businesses CTA --}}
            <div class="explore-all-btn-container">
                <a href="{{ route('shop.search') }}" class="explore-all-btn">
                    Explore All Beauty & Wellness <i class="fa-solid fa-arrow-right-long"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- Section 5: How Kimih Works --}}
    <section class="how-it-works kimih-section-spacing">
        <div class="container">
            <div class="kimih-section-header">
                <span>Simple & Easy</span>
                <h2>Book Your Perfect Experience in 3 Easy Steps</h2>
                <p class="text-muted mt-2 text-center max-w-600 mx-auto" style="max-width: 600px;">
                    Discover trusted beauty and wellness professionals, compare your options, and book your appointment with ease.
                </p>
            </div>
            
            <div class="journey-wrapper mt-5">
                <div class="journey-line"></div>
                <div class="row g-4">
                    <div class="col-md-4 col-12">
                        <div class="journey-step" data-aos="fade-up" data-aos-delay="100">
                            <div class="journey-number">01</div>
                            <div class="journey-icon">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                            <h3>Find</h3>
                            <p>Search for beauty and wellness services near you.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="journey-step" data-aos="fade-up" data-aos-delay="200">
                            <div class="journey-number">02</div>
                            <div class="journey-icon">
                                <i class="fa-solid fa-sliders"></i>
                            </div>
                            <h3>Choose</h3>
                            <p>Compare businesses, services, prices, and reviews.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="journey-step" data-aos="fade-up" data-aos-delay="300">
                            <div class="journey-number">03</div>
                            <div class="journey-icon">
                                <i class="fa-solid fa-calendar-check"></i>
                            </div>
                            <h3>Book</h3>
                            <p>Select your preferred time and book your appointment.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 6: Why Choose Kimih --}}
    <section class="why-choose-us kimih-section-spacing bg-light">
        <div class="container">
            <div class="kimih-section-header">
                <span>Why Kimih</span>
                <h2>Everything You Need to Book With Confidence</h2>
            </div>
            
            <div class="row g-4 mt-2">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="benefit-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="benefit-icon-wrapper">
                            <i class="fa-solid fa-shop"></i>
                        </div>
                        <h3>Trusted Professionals</h3>
                        <p>Discover beauty and wellness businesses in one convenient place.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="benefit-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="benefit-icon-wrapper">
                            <i class="fa-solid fa-bolt"></i>
                        </div>
                        <h3>Easy Booking</h3>
                        <p>Find your service and book your appointment in just a few clicks.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="benefit-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="benefit-icon-wrapper">
                            <i class="fa-solid fa-compress"></i>
                        </div>
                        <h3>Explore Your Options</h3>
                        <p>Compare businesses, services, and experiences before you decide.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="benefit-card" data-aos="fade-up" data-aos-delay="400">
                        <div class="benefit-icon-wrapper">
                            <i class="fa-solid fa-user-clock"></i>
                        </div>
                        <h3>Book on Your Terms</h3>
                        <p>Find the service, professional, location, and time that work best for you.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 7: For Business Section --}}
    <section class="for-business-section kimih-section-spacing">
        <div class="container">
            <div class="business-banner-area">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-12 order-lg-1 order-2 mt-4 mt-lg-0" data-aos="fade-right">
                        <div class="business-content">
                            <h2>Grow Your Beauty & Wellness Business</h2>
                            <p>
                                Manage your bookings, appointments, schedules, and customer relationships — all from one simple platform.
                            </p>
                            <ul class="business-checklist">
                                <li class="business-checklist-item">
                                    <i class="fa-solid fa-check"></i> Manage appointments
                                </li>
                                <li class="business-checklist-item">
                                    <i class="fa-solid fa-check"></i> Organize your schedule
                                </li>
                                <li class="business-checklist-item">
                                    <i class="fa-solid fa-check"></i> Reach new customers
                                </li>
                                <li class="business-checklist-item">
                                    <i class="fa-solid fa-check"></i> Grow your bookings
                                </li>
                            </ul>
                            <div class="business-cta-group">
                                <a href="{{ route('auth-business-sign-up') }}" class="btn-business-primary">
                                    Join Kimih
                                </a>
                                <a href="{{ route('business.page') }}" class="btn-business-secondary">
                                    Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12 order-lg-2 order-1" data-aos="fade-left">
                        <div class="business-visual text-center">
                            <img class="img-fluid rounded shadow-lg"
                                src="{{ asset('banners/dashboard.png') }}"
                                alt="Kimih Business Dashboard Mockup" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 8: Video / Wellness Section --}}
    <section class="wellness-video-section kimih-section-spacing bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-12" data-aos="fade-right">
                    <div class="kimih-section-header text-start mb-4">
                        <span>Your Well-Being</span>
                        <h2>Your Well-Being Starts Here</h2>
                        <p class="text-muted mt-3" style="text-align: justify; line-height: 1.8;">
                            Discover experiences that help you look good, feel good, and take time for yourself. From rejuvenating massage therapies to state-of-the-art hair styling, Kimih brings premium wellness solutions directly to your fingertips.
                        </p>
                    </div>
                </div>
                <div class="col-lg-7 col-12 mt-4 mt-lg-0" data-aos="fade-left">
                    @php
                        $videoLink = $home->section2_video_link ?? 'https://www.youtube.com/watch?v=Zd00oIDAt60';
                        // Convert watch URL to embed URL if needed
                        if (strpos($videoLink, 'watch?v=') !== false) {
                            $videoLink = str_replace('watch?v=', 'embed/', $videoLink);
                        }
                    @endphp
                    <div class="wellness-video-card">
                        {{-- Background placeholder matching the wellness vibe --}}
                        <img src="{{ asset('assets/images/shope4.png') }}" class="wellness-video-placeholder" alt="Wellness video thumbnail" />
                        <div class="wellness-video-overlay">
                            <a href="{{ $videoLink }}" target="_blank" class="wellness-video-play-btn" aria-label="Play video" rel="noopener">
                                <i class="fa-solid fa-play"></i>
                            </a>
                            <h3>Watch Our Story</h3>
                            <p>See how Kimih is transforming the beauty and wellness booking experience.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 9: Testimonials --}}
    <section class="testimonial-area kimih-section-spacing">
        <div class="container">
            <div class="kimih-section-header">
                <span>Testimonials</span>
                <h2>Loved by Our Community</h2>
            </div>
            
            <div class="row g-4 mt-2">
                @forelse ($feedbacks as $feedback)
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="testimonial-card-modern" data-aos="fade-up">
                            <div class="testimonial-quote">
                                {{ $feedback->feedback ?? 'Amazing services and booking experience!' }}
                            </div>
                            <div class="testimonial-user">
                                <img src="{{ isset($feedback->image) ? asset($feedback->image) : asset('assets/images/testimonial/testimonial-img1.jpg') }}"
                                    class="testimonial-avatar" alt="{{ $feedback->name ?? 'Client' }} avatar" />
                                <div class="testimonial-info">
                                    <h4>{{ $feedback->name ?? 'Client' }}</h4>
                                    <div class="testimonial-rating">
                                        @for ($i = 0; $i < ($feedback->rating ?? 5); $i++)
                                            <i class="fa-solid fa-star"></i>
                                        @endfor
                                    </div>
                                    <span class="testimonial-verified">
                                        <i class="fa-solid fa-circle-check"></i> Verified Customer
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Graceful fallback if no feedback exists --}}
                    <div class="col-12 text-center text-muted">
                        <p>No testimonials available yet. Be the first to share your experience!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection

@section('top-scripts')

    <script src="{{ asset('assets/js/contact-form-script.js') }}" type="text/javascript"></script>

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            var suggestionsContainer = $("#suggestionsContainer");
            $("#addressInput").autocomplete({
                source: function(request, response) {
                    var searchTerm = request.term;
                    performAddressSearch(searchTerm, response);
                },
                minLength: 1,
                select: function(event, ui) {
                    $("#addressInput").val(ui.item.value);
                    var selectedAddress = ui.item.value;
                    console.log("location:" + ui.item.latitude + " long:" + ui.item.longitude);
                    // getCoordinates(selectedAddress);

                    event.preventDefault();
                },
                appendTo: "#suggestionsContainer"
            }).autocomplete("instance")._renderItem = function(ul, item) {
                return $("<li>").append("<div>" + item.label + "</div>").appendTo(ul);
            };


            function performAddressSearch(searchTerm, response) {
                console.log("perfome");
                var apiUrl = "https://nominatim.openstreetmap.org/search?format=json&limit=10&q=" +
                    encodeURIComponent(
                        searchTerm);
                $.ajax({
                    url: apiUrl,
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        var suggestions = [];
                        for (var i = 0; i < data.length; i++) {
                            suggestions.push({
                                value: data[i].display_name,
                                label: data[i].display_name,
                                latitude: parseFloat(data[i].lat),
                                longitude: parseFloat(data[i].lon),
                            });
                        }

                        response(suggestions);
                    },
                    error: function() {}
                });
            }

            $("#addressInput").on('autocompleteselect', function(event, ui) {
                var latitude = ui.item.latitude;
                var longitude = ui.item.longitude;
                $("#lat").val(latitude);
                $("#lon").val(longitude);
            });

            // Custom dropdown select element sync and accessibility
            const $select = $('#serviceSelect');
            const $trigger = $('#serviceDropdownTrigger');
            const $menu = $('.custom-dropdown-menu');
            const $items = $('.custom-dropdown-item');

            $items.on('click', function(e) {
                e.stopPropagation();
                const val = $(this).attr('data-value');
                const text = $(this).find('.item-text').text();

                $items.removeClass('selected').attr('aria-selected', 'false');
                $(this).addClass('selected').attr('aria-selected', 'true');

                $select.val(val).trigger('change');
                $trigger.find('.selected-text-holder').text(text || 'Haircut, Massage, Nails...');
                
                closeDropdown();
                $trigger.focus();
            });

            $trigger.on('click', function(e) {
                e.stopPropagation();
                const isOpen = $menu.hasClass('show');
                if (isOpen) {
                    closeDropdown();
                } else {
                    openDropdown();
                }
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('.custom-dropdown-container').length) {
                    closeDropdown();
                }
            });

            $trigger.on('keydown', function(e) {
                if (e.key === 'ArrowDown' || e.key === ' ' || e.key === 'Enter') {
                    e.preventDefault();
                    openDropdown();
                    setTimeout(() => {
                        $menu.find('.custom-dropdown-item.selected').focus();
                    }, 50);
                }
            });

            $menu.on('keydown', '.custom-dropdown-item', function(e) {
                const $currentItem = $(this);
                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    const $next = $currentItem.next('.custom-dropdown-item');
                    if ($next.length) $next.focus();
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    const $prev = $currentItem.prev('.custom-dropdown-item');
                    if ($prev.length) $prev.focus();
                } else if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    $currentItem.click();
                } else if (e.key === 'Escape') {
                    e.preventDefault();
                    closeDropdown();
                    $trigger.focus();
                }
            });

            function openDropdown() {
                $menu.addClass('show');
                $trigger.attr('aria-expanded', 'true');
            }

            function closeDropdown() {
                $menu.removeClass('show');
                $trigger.attr('aria-expanded', 'false');
            }

        });
    </script>
@endsection
