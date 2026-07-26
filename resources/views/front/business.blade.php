@extends('user.layouts.app')

@section('title', 'Kimih for Business — Bookings, Calendar and Analytics')

@section('styles')
    <link rel="preconnect" href="https://api.fontshare.com">
    <link href="https://api.fontshare.com/v2/css?f[]=gambetta@400,500,600&f[]=switzer@400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/kimih.css') }}?v={{ time() }}">
    <style>
        .business-hero {
            position: relative;
            padding: clamp(100px, 12vw, 150px) 0 clamp(40px, 5vw, 70px);
            background: linear-gradient(165deg, #FFF 0%, #F8F5FB 100%);
            overflow: hidden;
        }
        .why-card {
            padding: 28px;
            border-radius: var(--r-card);
            background: #ffffff;
            border: 1px solid var(--line);
            height: 100%;
            display: flex;
            flex-direction: column;
            gap: 14px;
            transition: transform 0.28s, border-color 0.28s, box-shadow 0.28s;
        }
        .why-card:hover {
            transform: translateY(-5px);
            border-color: var(--violet-soft);
            box-shadow: var(--sh-md);
        }
        .why-ic {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: var(--violet-soft);
            color: var(--violet);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }
        .breadcrumb-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--violet-soft);
            color: var(--violet);
            font-size: 0.8rem;
            font-weight: 600;
            padding: 6px 16px;
            border-radius: var(--r-pill);
            margin-bottom: 16px;
        }
    </style>
@endsection

@section('content')
<main id="main">

    <!-- ============ HERO SECTION ============ -->
    <header class="business-hero">
        <div class="hero-bg" aria-hidden="true">
            <span class="blob blob-1"></span>
            <span class="blob blob-2"></span>
        </div>

        <div class="container text-center">
            <span class="breadcrumb-pill">
                <svg class="ic"><use href="#i-shop"/></svg> Free to start · No credit card required
            </span>
            <h1 class="mb-3">{{ $data->title ?? 'Run your chair, better.' }}</h1>
            <p class="lead mx-auto">{{ $data->sub_title ?? 'Take online bookings, keep your calendar accurate, cut no-shows and get discovered by customers already searching for what you offer.' }}</p>

            <div class="d-flex flex-wrap gap-3 justify-content-center mt-4">
                <a href="{{ route('register') }}" class="btn-k btn-hero">
                    Join Kimih <svg class="ic"><use href="#i-arrow"/></svg>
                </a>
                <a href="#features" class="btn-k btn-outline-k">Explore Features</a>
            </div>

            <div class="fb-jrny justify-content-center mt-4">
                <span style="background:var(--violet-soft);color:var(--violet)">Join</span>
                <span style="background:var(--violet-soft);color:var(--violet)">Manage</span>
                <span style="background:var(--violet-soft);color:var(--violet)">Grow</span>
            </div>
        </div>
    </header>

    <!-- ============ KIMIH FOR BUSINESS SHOWCASE ============ -->
    @include('user.components.business-showcase')

    <!-- ============ FEATURES ============ -->
    <section class="sec sec-tint" id="features">
        <div class="container">
            <div class="row align-items-end mb-4 mb-lg-5">
                <div class="col-lg-7">
                    <span class="eyebrow">What you get</span>
                    <h2 class="h-sec">{{ $featurePage->title ?? 'Everything the front desk does — automatically.' }}</h2>
                </div>
                <div class="col-lg-5">
                    <p class="lead mb-0">{{ $featurePage->description ?? 'Built for single chairs, growing salons and multi-location studios alike.' }}</p>
                </div>
            </div>

            <div class="row g-4">
                @if($features && $features->count() > 0)
                    @foreach($features as $feature)
                        <div class="col-sm-6 col-lg-3">
                            <div class="why-card">
                                <div class="why-ic">
                                    <svg class="ic"><use href="#i-sparkle"/></svg>
                                </div>
                                <h3 class="h-card mb-0" style="font-size:1.15rem">{{ $feature->title ?? '' }}</h3>
                                <p class="mb-0" style="font-size:0.9rem;color:var(--body)">{{ $feature->description ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-sm-6 col-lg-3">
                        <div class="why-card">
                            <div class="why-ic"><svg class="ic"><use href="#i-users"/></svg></div>
                            <h3 class="h-card mb-0" style="font-size:1.15rem">Reach new customers</h3>
                            <p class="mb-0" style="font-size:0.9rem;color:var(--body)">Get discovered by people searching for beauty &amp; wellness services in your area.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="why-card">
                            <div class="why-ic"><svg class="ic"><use href="#i-cal-check"/></svg></div>
                            <h3 class="h-card mb-0" style="font-size:1.15rem">Manage bookings</h3>
                            <p class="mb-0" style="font-size:0.9rem;color:var(--body)">Accept, reschedule and track every appointment from one calendar.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="why-card">
                            <div class="why-ic"><svg class="ic"><use href="#i-bell"/></svg></div>
                            <h3 class="h-card mb-0" style="font-size:1.15rem">Cut no-shows</h3>
                            <p class="mb-0" style="font-size:0.9rem;color:var(--body)">Automatic reminders go out before every appointment so fewer slots go to waste.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="why-card">
                            <div class="why-ic"><svg class="ic"><use href="#i-wallet"/></svg></div>
                            <h3 class="h-card mb-0" style="font-size:1.15rem">Track revenue</h3>
                            <p class="mb-0" style="font-size:0.9rem;color:var(--body)">Track earnings, deposits and payouts without needing a separate spreadsheet.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- ============ STATS SECTION ============ -->
    <section class="sec sec-dark">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <span class="eyebrow">{{ $data->top_rating_title ?? 'Trusted by Salon Owners' }}</span>
                    <h2 class="h-sec mb-3">Empowering beauty &amp; wellness creators.</h2>
                    <p class="lead">{{ $data->top_rating_description ?? 'Join thousands of active partners growing their monthly client revenue with Kimih.' }}</p>
                </div>
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-4 rounded-4" style="background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.12)">
                                <div class="display mb-1 text-white" style="font-size:2.2rem">{{ $data->business_partner_count ?? '1,200+' }}</div>
                                <div style="font-size:0.85rem;color:rgba(255,255,255,0.7)">{{ $data->business_partner_title ?? 'Partner Salons' }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-4 rounded-4" style="background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.12)">
                                <div class="display mb-1 text-white" style="font-size:2.2rem">{{ $data->appointmens_count ?? '210K+' }}</div>
                                <div style="font-size:0.85rem;color:rgba(255,255,255,0.7)">{{ $data->appointmens_title ?? 'Bookings Managed' }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-4 rounded-4" style="background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.12)">
                                <div class="display mb-1 text-white" style="font-size:2.2rem">{{ $data->stylists_count ?? '3,400+' }}</div>
                                <div style="font-size:0.85rem;color:rgba(255,255,255,0.7)">{{ $data->stylists_title ?? 'Active Stylists' }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-4 rounded-4" style="background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.12)">
                                <div class="display mb-1 text-white" style="font-size:2.2rem">{{ $data->countries_count ?? '18' }}</div>
                                <div style="font-size:0.85rem;color:rgba(255,255,255,0.7)">{{ $data->countries_title ?? 'Cities Active' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ HOW TO JOIN ============ -->
    <section class="sec">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-7">
                    <span class="eyebrow">Getting started</span>
                    <h2 class="h-sec">Live in an afternoon.</h2>
                </div>
            </div>
            <div class="row g-4 g-lg-5">
                <div class="col-md-4">
                    <div class="step">
                        <span class="step-n">01</span>
                        <h3>Join</h3>
                        <p>Create your business profile, add photos, services and prices. Free to start.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step">
                        <span class="step-n">02</span>
                        <h3>Manage</h3>
                        <p>Set your opening hours and team availability. Bookings land straight in your calendar.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step">
                        <span class="step-n">03</span>
                        <h3>Grow</h3>
                        <p>Appear in local search, collect reviews, and turn first-time bookings into regulars.</p>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <a href="{{ route('register') }}" class="btn-k btn-primary-k">
                    Create your profile <svg class="ic"><use href="#i-arrow"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ============ PRICING ============ -->
    <section class="sec sec-tint" id="pricing">
        <div class="container">
            <div class="text-center mb-5">
                <span class="eyebrow">Pricing</span>
                <h2 class="h-sec">Simple, transparent pricing.</h2>
                <p class="lead mx-auto mt-3">Start free. Upgrade when your calendar fills up.</p>
            </div>
            <div class="row g-4 justify-content-center" id="pricingRow"></div>
        </div>
    </section>

    <!-- ============ FAQ ============ -->
    <section class="sec" id="faq">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <span class="eyebrow">Good to know</span>
                    <h2 class="h-sec">Questions from owners.</h2>
                    <p class="lead mt-3">Still unsure? Talk to someone on our partner support team.</p>
                    <a href="{{ route('contact-us.index') }}" class="btn-k btn-outline-k mt-3">
                        Contact sales <svg class="ic"><use href="#i-arrow"/></svg>
                    </a>
                </div>
                <div class="col-lg-8" id="faqList"></div>
            </div>
        </div>
    </section>

    <!-- ============ FINAL CTA ============ -->
    <section class="final-cta">
        <div class="container">
            <h2>Your next regular is searching right now.</h2>
            <p class="lead mx-auto">Set up your profile today and start taking bookings before the week is out.</p>
            <a href="{{ route('register') }}" class="btn-k btn-hero">
                Join Kimih for business <svg class="ic"><use href="#i-arrow"/></svg>
            </a>
        </div>
    </section>

</main>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/kimih.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/business.js') }}?v={{ time() }}"></script>
@endsection
