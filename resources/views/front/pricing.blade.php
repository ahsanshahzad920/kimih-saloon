@extends('user.layouts.app')

@section('title', 'Pricing Plans | Kimih')

@section('styles')
    <link rel="preconnect" href="https://api.fontshare.com">
    <link href="https://api.fontshare.com/v2/css?f[]=gambetta@400,500,600&f[]=switzer@400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/kimih.css') }}?v={{ time() }}">
    <style>
        .pricing-hero {
            position: relative;
            padding: clamp(100px, 12vw, 140px) 0 clamp(40px, 5vw, 60px);
            background: linear-gradient(165deg, #FFF 0%, #F8F5FB 100%);
            overflow: hidden;
        }
        .pricing-card {
            position: relative;
            display: flex;
            flex-direction: column;
            padding: 36px 28px;
            border-radius: var(--r-card);
            background: #ffffff;
            border: 1px solid var(--line);
            height: 100%;
            transition: transform 0.28s, box-shadow 0.28s, border-color 0.28s;
        }
        .pricing-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--sh-md);
            border-color: var(--violet-soft);
        }
        .pricing-card.featured {
            background: linear-gradient(180deg, #ffffff 0%, #F6F1FB 100%);
            border: 2px solid var(--violet);
            box-shadow: var(--sh-lg);
        }
        .pricing-badge {
            position: absolute;
            top: -14px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(100deg, var(--violet), var(--magenta));
            color: #ffffff;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 4px 16px;
            border-radius: var(--r-pill);
        }
        .price-amount {
            font-family: var(--ff-display);
            font-size: clamp(2.2rem, 4vw, 3.2rem);
            font-weight: 600;
            color: var(--ink);
            line-height: 1;
            margin: 16px 0 6px;
        }
        .price-period {
            font-size: 0.88rem;
            color: var(--body);
            font-weight: 500;
        }
        .plan-feature-list {
            list-style: none;
            padding: 0;
            margin: 24px 0;
            display: flex;
            flex-direction: column;
            gap: 12px;
            flex-grow: 1;
        }
        .plan-feature-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.92rem;
            color: var(--ink);
        }
        .plan-feature-item .ic {
            color: var(--violet);
            flex-shrink: 0;
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
    <header class="pricing-hero">
        <div class="hero-bg" aria-hidden="true">
            <span class="blob blob-1"></span>
            <span class="blob blob-2"></span>
        </div>

        <div class="container text-center">
            <span class="breadcrumb-pill">
                <a href="/" style="color:var(--violet)">Home</a> / Pricing
            </span>
            <h1 class="mb-3">Simple, transparent pricing.</h1>
            <p class="lead mx-auto">Choose the plan that fits your salon, spa, or barbershop. No hidden fees. Upgrade or cancel anytime.</p>
        </div>
    </header>

    <!-- ============ PRICING CARDS SECTION ============ -->
    <section class="sec pt-0">
        <div class="container">
            <div class="row g-4 justify-content-center">
                @forelse ($plans as $index => $plan)
                    @php
                        $isFeatured = ($index === 1 || strtolower($plan->name) == 'pro' || strtolower($plan->name) == 'popular');
                    @endphp
                    <div class="col-md-6 col-lg-4">
                        <div class="pricing-card {{ $isFeatured ? 'featured' : '' }}">
                            @if ($isFeatured)
                                <span class="pricing-badge">Most Popular</span>
                            @endif

                            <h3 class="h-card text-center mb-1" style="font-size:1.35rem">{{ $plan->name ?? 'Standard Plan' }}</h3>
                            <p class="text-center text-muted mb-0" style="font-size:0.85rem">For growing beauty &amp; wellness businesses</p>

                            <div class="text-center">
                                <div class="price-amount">
                                    Rs {{ number_format((float)($plan->price ?? 0), 2) }}
                                </div>
                                <span class="price-period">per month</span>
                            </div>

                            <ul class="plan-feature-list" style="list-style:none !important; padding:0 !important; margin:24px 0 !important; display:flex !important; flex-direction:column !important; gap:10px !important;">
                                <li class="plan-feature-item" style="display:flex !important; flex-direction:row !important; align-items:flex-start !important; gap:10px !important; line-height:1.4 !important; font-size:.92rem !important; color:var(--ink) !important;">
                                    <span style="display:inline-flex !important; align-items:center !important; justify-content:center !important; width:18px !important; height:18px !important; min-width:18px !important; border-radius:50% !important; background:var(--violet-soft, #EDE6FB) !important; color:var(--violet, #6D28D9) !important; flex-shrink:0 !important; margin-top:2px !important;">
                                        <svg class="ic" style="width:11px !important; height:11px !important; stroke-width:2.5 !important; display:block !important; margin:0 !important;"><use href="#i-check"/></svg>
                                    </span>
                                    <span style="flex:1 1 auto !important; display:block !important; text-align:left !important;">Unlimited Online Appointments</span>
                                </li>
                                <li class="plan-feature-item" style="display:flex !important; flex-direction:row !important; align-items:flex-start !important; gap:10px !important; line-height:1.4 !important; font-size:.92rem !important; color:var(--ink) !important;">
                                    <span style="display:inline-flex !important; align-items:center !important; justify-content:center !important; width:18px !important; height:18px !important; min-width:18px !important; border-radius:50% !important; background:var(--violet-soft, #EDE6FB) !important; color:var(--violet, #6D28D9) !important; flex-shrink:0 !important; margin-top:2px !important;">
                                        <svg class="ic" style="width:11px !important; height:11px !important; stroke-width:2.5 !important; display:block !important; margin:0 !important;"><use href="#i-check"/></svg>
                                    </span>
                                    <span style="flex:1 1 auto !important; display:block !important; text-align:left !important;">Client Reminders &amp; Notifications</span>
                                </li>
                                @if(!empty($plan->planServices))
                                    @foreach ($plan->planServices as $planService)
                                        <li class="plan-feature-item" style="display:flex !important; flex-direction:row !important; align-items:flex-start !important; gap:10px !important; line-height:1.4 !important; font-size:.92rem !important; color:var(--ink) !important;">
                                            <span style="display:inline-flex !important; align-items:center !important; justify-content:center !important; width:18px !important; height:18px !important; min-width:18px !important; border-radius:50% !important; background:var(--violet-soft, #EDE6FB) !important; color:var(--violet, #6D28D9) !important; flex-shrink:0 !important; margin-top:2px !important;">
                                                <svg class="ic" style="width:11px !important; height:11px !important; stroke-width:2.5 !important; display:block !important; margin:0 !important;"><use href="#i-check"/></svg>
                                            </span>
                                            <span style="flex:1 1 auto !important; display:block !important; text-align:left !important;">{{ $planService->name ?? '' }}</span>
                                        </li>
                                    @endforeach
                                @endif
                                <li class="plan-feature-item" style="display:flex !important; flex-direction:row !important; align-items:flex-start !important; gap:10px !important; line-height:1.4 !important; font-size:.92rem !important; color:var(--ink) !important;">
                                    <span style="display:inline-flex !important; align-items:center !important; justify-content:center !important; width:18px !important; height:18px !important; min-width:18px !important; border-radius:50% !important; background:var(--violet-soft, #EDE6FB) !important; color:var(--violet, #6D28D9) !important; flex-shrink:0 !important; margin-top:2px !important;">
                                        <svg class="ic" style="width:11px !important; height:11px !important; stroke-width:2.5 !important; display:block !important; margin:0 !important;"><use href="#i-check"/></svg>
                                    </span>
                                    <span style="flex:1 1 auto !important; display:block !important; text-align:left !important;">Business Analytics Dashboard</span>
                                </li>
                            </ul>

                            <a href="{{ route('register') }}" class="btn-k {{ $isFeatured ? 'btn-hero' : 'btn-outline-k' }} w-100 text-center">
                                Get Started <svg class="ic"><use href="#i-arrow"/></svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5 w-100" style="color:#8C84A0;">
                        <svg class="ic" style="width:2.5rem;height:2.5rem;opacity:.4;"><use href="#i-tag"/></svg>
                        <p class="mt-3 mb-0">No pricing plans configured yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ============ FAQ SECTION ============ -->
    <section class="sec sec-tint" id="faq">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <span class="eyebrow">Pricing FAQ</span>
                    <h2 class="h-sec">Have questions about our plans?</h2>
                    <p class="lead mt-3">Find answers to the most common pricing questions.</p>
                </div>
                <div class="col-lg-8" id="faqList"></div>
            </div>
        </div>
    </section>

</main>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/kimih.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/content.js') }}?v={{ time() }}"></script>
@endsection
