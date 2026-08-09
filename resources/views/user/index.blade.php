@extends('user.layouts.app')

@section('title', 'Book Salons & Beauty Services Near You in Pakistan')
@section('meta_description', 'Find and book the best salons, spas, barbers, and beauty & wellness professionals in Karachi, Lahore, Islamabad, Rawalpindi & across Pakistan. Compare prices, read verified reviews, and book online in minutes with Kimih.')

@section('styles')
    <link rel="preconnect" href="https://api.fontshare.com">
    <link href="https://api.fontshare.com/v2/css?f[]=gambetta@400,500,600&f[]=switzer@400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/kimih.css') }}?v={{ time() }}">
    <style>
        .search-card-form {
            width: 100%;
        }
        .search-input-field {
            border: none;
            outline: none;
            background: transparent;
            width: 100%;
            font-size: 0.95rem;
            color: var(--ink);
        }
        .search-select-field {
            border: none;
            outline: none;
            background: transparent;
            width: 100%;
            font-size: 0.95rem;
            color: var(--ink);
            cursor: pointer;
        }
        /* Mobile Sticky CTA */
        @media (max-width: 991px) {
            .sticky-cta-bar {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                z-index: 1040;
                padding: 12px 16px;
                background: rgba(255,255,255,0.92);
                backdrop-filter: blur(12px);
                border-top: 1px solid var(--line);
            }
        }
    </style>
@endsection

@section('content')
<main id="main">

    <!-- ============ HERO SECTION ============ -->
    <header class="hero">
        <div class="hero-bg" aria-hidden="true">
            <span class="blob blob-1"></span>
            <span class="blob blob-2"></span>
            <span class="blob blob-3"></span>
        </div>

        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-9">
                    <span class="hero-pill">
                        <svg class="ic"><use href="#i-sparkle"/></svg> 
                        Now booking top salons &amp; wellness centers
                    </span>
                    <h1>{{ $home->home_title ?? 'Book beauty & wellness near you.' }}</h1>
                    <p class="lead mx-auto mt-3">Real photos, real reviews, real prices — from salons, barbers, spas and wellness studios around the corner.</p>
                    <div class="ticker" id="ticker">
                        <span class="pulse"></span>
                        <b id="tickerNum">1,420</b>&nbsp;appointments booked today
                    </div>
                </div>
            </div>

            {{-- Floating Multi-field Search Card --}}
            <div class="row justify-content-center">
                <div class="col-12 col-xl-11">
                    <div class="search-wrap">
                        <form action="{{ route('shop.search') }}" method="GET" class="search-card search-card-form" role="search">
                            <div class="search-grid">
                                {{-- Service Select --}}
                                <div class="sf">
                                    <span class="sf-label">What are you looking for?</span>
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

                                {{-- Location Input --}}
                                <div class="sf" id="locationField">
                                    <span class="sf-label">Location</span>
                                    <div class="sf-value">
                                        <svg class="ic"><use href="#i-geo"/></svg>
                                        <input type="text" name="location" id="userLocationInput" class="search-input-field js-location-autocomplete" placeholder="Near me or City" value="{{ request('location') }}" autocomplete="off">
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
                                    <button type="submit" class="btn-k btn-hero">
                                        Find services <svg class="ic"><use href="#i-arrow"/></svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- ============ CHIP MARQUEE ============ -->
    <div class="marquee-wrap">
        <div class="marquee-track" id="track"></div>
    </div>

    <!-- ============ CATEGORIES ============ -->
    <section class="sec" id="categories">
        <div class="container">
            <div class="row align-items-end mb-4 mb-lg-5">
                <div class="col-lg-7">
                    <span class="eyebrow">Explore</span>
                    <h2 class="h-sec">Explore beauty &amp; wellness</h2>
                </div>
                <div class="col-lg-5">
                    <p class="lead mb-0">Discover the services you love, from hair and beauty to wellness and self-care.</p>
                </div>
            </div>

            <div class="cat-rail">
                @foreach ($serviceCategory as $category)
                    @php
                        $iconName = 'i-sparkle';
                        $catName = strtolower($category->name);
                        if (str_contains($catName, 'hair') || str_contains($catName, 'barber')) $iconName = 'i-scissors';
                        elseif (str_contains($catName, 'nail')) $iconName = 'i-nail';
                        elseif (str_contains($catName, 'spa')) $iconName = 'i-spa';
                        elseif (str_contains($catName, 'massage')) $iconName = 'i-massage';
                        elseif (str_contains($catName, 'make') || str_contains($catName, 'beauty')) $iconName = 'i-makeup';
                        elseif (str_contains($catName, 'skin')) $iconName = 'i-skincare';
                        elseif (str_contains($catName, 'well')) $iconName = 'i-wellness';
                    @endphp
                    <a class="cat-card media-zoom" href="{{ route('shop.search', ['service' => $category->name]) }}">
                        <div class="cat-icon">
                            <svg class="ic"><use href="#{{ $iconName }}"/></svg>
                        </div>
                        <div>
                            <h3>{{ $category->name }}</h3>
                            <p>Popular Service</p>
                        </div>
                        <span class="cnt">Explore <svg class="ic"><use href="#i-arrow"/></svg></span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ============ HOMEPAGE DISCOVERY CAROUSELS ============ -->
    <div class="fresha-discovery-wrapper">
        <!-- ============ 1. RECOMMENDED CAROUSEL ============ -->
        @include('user.components.salon-carousel', [
            'title' => 'Recommended',
            'salons' => $recommendedUsers,
            'badgeType' => 'Featured',
            'carouselId' => 'carouselRecommended'
        ])

        <!-- ============ 2. NEW TO KIMIH CAROUSEL ============ -->
        @include('user.components.salon-carousel', [
            'title' => 'New to Kimih',
            'salons' => $newUsers,
            'badgeType' => 'auto_new_deals',
            'carouselId' => 'carouselNewToKimih'
        ])

        <!-- ============ 3. TRENDING CAROUSEL ============ -->
        @include('user.components.salon-carousel', [
            'title' => 'Trending',
            'salons' => $trendingUsers,
            'badgeType' => null,
            'carouselId' => 'carouselTrending'
        ])
    </div>



    <!-- ============ USE CASES ============ -->
    <section class="sec">
        <div class="container">
            <div class="row align-items-end mb-4 mb-lg-5">
                <div class="col-lg-7">
                    <span class="eyebrow">Core use cases</span>
                    <h2 class="h-sec">Built for every kind of day.</h2>
                </div>
                <div class="col-lg-5">
                    <p class="lead mb-0">Wherever life takes you, Kimih puts a professional you trust within reach.</p>
                </div>
            </div>
            <div class="row g-4" id="ucGrid"></div>
        </div>
    </section>

    <!-- ============ STATS + TRUST BADGES ============ -->
    <section class="sec sec-dark" id="statsSection">
        <div class="container">
            <div class="row mb-4">
                <div class="col-lg-7">
                    <span class="eyebrow">Kimih today</span>
                    <h2 class="h-sec">Trusted by people who care how they feel.</h2>
                </div>
            </div>
            <div class="row g-4" id="statsRow"></div>
            <div class="badges" id="badgeRow"></div>
        </div>
    </section>

    <!-- ============ HOW IT WORKS ============ -->
    <section class="sec sec-tint" id="how">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-7">
                    <span class="eyebrow">How Kimih works</span>
                    <h2 class="h-sec">Three steps, one appointment.</h2>
                </div>
            </div>
            <div class="row g-4 g-lg-5">
                <div class="col-md-4">
                    <div class="step">
                        <span class="step-n">01</span>
                        <h3>Discover</h3>
                        <p>Find beauty and wellness services near you — by category, by location, or by what's free today.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step">
                        <span class="step-n">02</span>
                        <h3>Compare</h3>
                        <p>Explore businesses, services, prices and reviews side by side before you commit to anyone.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step">
                        <span class="step-n">03</span>
                        <h3>Book</h3>
                        <p>Choose the time that works for you and confirm your appointment in a few clicks.</p>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <a href="#main" class="btn-k btn-primary-k">
                    Start searching <svg class="ic"><use href="#i-arrow"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ============ REVIEWS & FEEDBACK ============ -->
    @if (!empty($feedbacks) && $feedbacks->count() > 0)
        <section class="sec" id="reviews">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-lg-7">
                        <span class="eyebrow">Reviews</span>
                        <h2 class="h-sec">What our clients say.</h2>
                    </div>
                </div>
                <div class="row g-4">
                    @foreach ($feedbacks->take(6) as $fb)
                        <div class="col-md-6 col-lg-4">
                            <div class="rev-card h-100">
                                <div class="stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="ic ic-fill"><use href="#i-star"/></svg>
                                    @endfor
                                </div>
                                <p class="rev-text">"{{ $fb->review ?? 'Amazing service and smooth booking experience!' }}"</p>
                                <div class="rev-user">
                                    <div class="rev-avatar">
                                        <svg class="ic" style="width:100%;height:100%;"><use href="#i-usercircle"/></svg>
                                    </div>
                                    <div>
                                        <div class="rev-name">{{ $fb->client->name ?? 'Verified Client' }}</div>
                                        <div class="rev-biz">{{ $fb->store->name ?? 'Partner Salon' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- ============ APP DOWNLOAD ============ -->
    <section class="sec sec-dark" id="app">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <span class="eyebrow">Get the app</span>
                    <h2 class="h-sec">Kimih in your pocket.</h2>
                    <p class="lead mt-3">Book, reschedule and rebook in a few taps. Get reminders before every appointment so you never lose a slot.</p>
                    <div class="d-flex flex-wrap align-items-center gap-4 mt-4">
                        <div class="d-flex flex-column gap-2">
                            <a href="#" class="store-badge">
                                <svg class="ic"><use href="#i-apple"/></svg>
                                <span><small>Download on the</small><b>App Store</b></span>
                            </a>
                            <a href="#" class="store-badge">
                                <svg class="ic"><use href="#i-android"/></svg>
                                <span><small>Get it on</small><b>Google Play</b></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="kimih-mobile-app-graphic-wrap">
                        <img src="{{ asset('assets/images/kimih_app_mockup.png') }}" 
                             alt="Kimih Mobile App Experience" 
                             class="img-fluid kimih-app-mockup-img" 
                             loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ FOR BUSINESS BANNER ============ -->
    <section class="sec">
        <div class="container">
            <div class="fb-banner">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <h2>Grow your beauty &amp; wellness business.</h2>
                        <p>Take bookings, manage your calendar and get discovered by new customers — all in one place.</p>
                        <div class="fb-jrny">
                            <span>Join</span>
                            <span>Manage</span>
                            <span>Grow</span>
                        </div>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="{{ route('register') }}" class="btn-k btn-light-k">
                            Kimih for business <svg class="ic"><use href="#i-arrow"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ KIMIH FOR BUSINESS SHOWCASE ============ -->
    @include('user.components.business-showcase')

    <!-- ============ FAQ ============ -->
    <section class="sec sec-tint" id="faq">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <span class="eyebrow">Good to know</span>
                    <h2 class="h-sec">Questions, answered.</h2>
                    <p class="lead mt-3">Anything else? Our support team is here to assist you.</p>
                </div>
                <div class="col-lg-8" id="faqList"></div>
            </div>
        </div>
    </section>

    <!-- ============ FINAL CTA ============ -->
    <section class="final-cta">
        <div class="container">
            <h2>Your next appointment is one search away.</h2>
            <p class="lead mx-auto">No calls. No DMs. No afternoon lost in a waiting chair. Just book the time that works and turn up.</p>
            <a href="#main" class="btn-k btn-hero">
                Find services near me <svg class="ic"><use href="#i-arrow"/></svg>
            </a>
        </div>
    </section>

</main>

{{-- Sticky Mobile CTA --}}
<div class="sticky-cta-bar d-lg-none">
    <a href="#main" class="btn-k btn-hero w-100">
        Find services near me <svg class="ic"><use href="#i-search"/></svg>
    </a>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/kimih.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/content.js') }}?v={{ time() }}"></script>
@endsection
