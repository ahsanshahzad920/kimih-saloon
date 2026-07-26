@extends('user.layouts.app')

@section('title', 'Partner Terms of Service | Kimih Business')

@section('styles')
<style>
    .legal-hero-section {
        background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #311075 100%);
        color: #ffffff;
        padding: 60px 0 50px;
        position: relative;
        overflow: hidden;
    }
    .legal-hero-section h1 {
        color: #ffffff;
    }
    .legal-hero-section::after {
        content: '';
        position: absolute;
        top: 0; right: 0; bottom: 0; left: 0;
        background: radial-gradient(circle at 80% 20%, rgba(244, 208, 239, 0.15) 0%, transparent 50%);
        pointer-events: none;
    }
    .legal-badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 5px 14px;
        border-radius: 20px;
        font-size: 0.82rem;
        font-weight: 600;
        color: #e2e8f0;
        margin-bottom: 16px;
    }
    .legal-meta-bar {
        display: flex;
        align-items: center;
        gap: 20px;
        font-size: 0.88rem;
        color: #94a3b8;
        flex-wrap: wrap;
        margin-top: 20px;
    }
    .legal-container {
        padding: 50px 0 80px;
        background: #f8fafc;
    }
    .legal-toc-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 24px;
        position: sticky;
        top: 90px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    }
    .legal-toc-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: #0f172a;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 16px;
    }
    .legal-toc-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .legal-toc-link {
        display: block;
        padding: 8px 12px;
        font-size: 0.88rem;
        font-weight: 500;
        color: #64748b;
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.2s ease;
    }
    .legal-toc-link:hover, .legal-toc-link.active {
        color: #4b1fa8;
        background: rgba(75, 31, 168, 0.06);
        font-weight: 600;
    }
    .legal-section-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 32px;
        margin-bottom: 24px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
    }
    .legal-section-card h2 {
        font-size: 1.35rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .legal-section-card p, .legal-section-card li {
        font-size: 0.94rem;
        line-height: 1.7;
        color: #475569;
    }
    .legal-callout {
        background: #f0fdf4;
        border-left: 4px solid #16a34a;
        padding: 16px 20px;
        border-radius: 0 12px 12px 0;
        margin: 20px 0;
    }
    .legal-callout-warning {
        background: #fffbebf7;
        border-left: 4px solid #d97706;
    }
    .legal-table {
        width: 100%;
        margin: 20px 0;
        border-collapse: collapse;
        font-size: 0.9rem;
    }
    .legal-table th, .legal-table td {
        padding: 12px 16px;
        border: 1px solid #e2e8f0;
        text-align: left;
    }
    .legal-table th {
        background: #f8fafc;
        font-weight: 700;
        color: #0f172a;
    }
</style>
@endsection

@section('content')

{{-- Hero Section --}}
<div class="legal-hero-section">
    <div class="container position-relative z-1">
        <div class="row">
            <div class="col-lg-8 col-12">
                <span class="legal-badge-pill">
                    <i class="fa-solid fa-handshake"></i> Kimih Merchant Agreement
                </span>
                <h1 class="display-5 fw-bold mb-3">Partner Terms of Service</h1>
                <p class="lead text-light opacity-90 mb-0">
                    Legal framework and operational standards governing business venues, salons, spas, and wellness merchants listed on the Kimih platform.
                </p>
                <div class="legal-meta-bar">
                    <span><i class="fa-regular fa-calendar me-1"></i> Effective Date: July 25, 2026</span>
                    <span><i class="fa-solid fa-file-code me-1"></i> Version 2.4</span>
                    <span><i class="fa-solid fa-globe me-1"></i> Applicable Globally</span>
                </div>
            </div>
            <div class="col-lg-4 col-12 mt-4 mt-lg-0 text-lg-end d-flex align-items-center justify-content-lg-end">
                <button type="button" class="btn btn-light rounded-pill px-4 py-2 text-nowrap fw-semibold" onclick="window.print();">
                    <i class="fa-solid fa-print me-2"></i> Print Document
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Main Document Container --}}
<div class="legal-container">
    <div class="container">
        <div class="row g-4">
            
            {{-- Left Navigation Sidebar (30%) --}}
            <div class="col-lg-4 col-12">
                <div class="legal-toc-card">
                    <div class="legal-toc-title">Table of Contents</div>
                    <ul class="legal-toc-list">
                        <li><a href="#section-1" class="legal-toc-link active">1. Overview & Scope</a></li>
                        <li><a href="#section-2" class="legal-toc-link">2. Merchant Registration & Verification</a></li>
                        <li><a href="#section-3" class="legal-toc-link">3. Service Listings & Pricing</a></li>
                        <li><a href="#section-4" class="legal-toc-link">4. Bookings & Cancellations</a></li>
                        <li><a href="#section-5" class="legal-toc-link">5. Payments & Commission Fees</a></li>
                        <li><a href="#section-6" class="legal-toc-link">6. Client Reviews & Quality Standards</a></li>
                        <li><a href="#section-7" class="legal-toc-link">7. Intellectual Property & Media</a></li>
                        <li><a href="#section-8" class="legal-toc-link">8. Term, Suspension & Termination</a></li>
                        <li><a href="#section-9" class="legal-toc-link">9. Legal Contact & Support</a></li>
                    </ul>
                </div>
            </div>

            {{-- Right Content Column (70%) --}}
            <div class="col-lg-8 col-12">
                
                {{-- Dynamic Custom Text from Admin Panel --}}
                @if(!empty(settings()->partner_terms))
                    <div class="legal-section-card mb-4">
                        <div class="lead text-dark">
                            {!! settings()->partner_terms !!}
                        </div>
                    </div>
                @endif

                {{-- Section 1: Overview --}}
                <div id="section-1" class="legal-section-card">
                    <h2><i class="fa-solid fa-circle-info text-purple" style="color: #4b1fa8;"></i> 1. Overview & Scope</h2>
                    <p>
                        These Partner Terms of Service ("Agreement") constitute a legally binding agreement between <strong>Kimih Technologies Inc.</strong> ("Kimih", "we", "our", or "us") and your business entity ("Partner", "Merchant", or "Venue").
                    </p>
                    <p>
                        By registering as a Business User on Kimih, listing your services, or utilizing the Kimih merchant dashboard, POS tools, or marketplace listing services, you agree to comply with and be bound by this Agreement.
                    </p>
                    <div class="legal-callout">
                        <div class="fw-bold text-success mb-1"><i class="fa-solid fa-shield-halved me-1"></i> Core Purpose</div>
                        <div class="small">Kimih provides software tools and discovery marketplace services designed to connect consumers ("Clients") with trusted beauty, hair, nail, massage, and wellness professionals.</div>
                    </div>
                </div>

                {{-- Section 2: Registration & Verification --}}
                <div id="section-2" class="legal-section-card">
                    <h2><i class="fa-solid fa-id-card text-purple" style="color: #4b1fa8;"></i> 2. Merchant Registration & Verification</h2>
                    <p>
                        To operate on Kimih, merchants must satisfy mandatory onboarding requirements:
                    </p>
                    <ul>
                        <li><strong>Valid Business Licensing:</strong> Partners must maintain all required municipal, trade, health, and professional licenses.</li>
                        <li><strong>Accurate Venue Data:</strong> Partners must provide true, complete location addresses, contact numbers, and operating schedules.</li>
                        <li><strong>Verified Ownership:</strong> Kimih reserves the right to request proof of business registration or identity documentation prior to publishing venue listings.</li>
                    </ul>
                </div>

                {{-- Section 3: Service Listings & Pricing --}}
                <div id="section-3" class="legal-section-card">
                    <h2><i class="fa-solid fa-list-check text-purple" style="color: #4b1fa8;"></i> 3. Service Listings & Pricing</h2>
                    <p>
                        Partners maintain sole control over their published service menu, pricing, duration, and stylist assignments subject to the following guarantees:
                    </p>
                    <ul>
                        <li><strong>Price Parity:</strong> Prices published on Kimih must be equal to or lower than prices offered directly to walk-in clients at the physical venue.</li>
                        <li><strong>No Hidden Fees:</strong> All service charges must be explicitly stated; no undisclosed surcharges may be demanded from Clients upon arrival.</li>
                    </ul>
                </div>

                {{-- Section 4: Bookings & Cancellations --}}
                <div id="section-4" class="legal-section-card">
                    <h2><i class="fa-solid fa-calendar-check text-purple" style="color: #4b1fa8;"></i> 4. Bookings & Cancellations</h2>
                    <p>
                        When a Client books an appointment through Kimih, a binding service commitment is created.
                    </p>
                    <div class="legal-callout legal-callout-warning">
                        <div class="fw-bold text-amber-800 mb-1"><i class="fa-solid fa-triangle-exclamation me-1"></i> Partner Cancellation Rule</div>
                        <div class="small">Partners must not cancel confirmed client appointments except in bona fide emergencies. Unreasonable partner cancellations damage marketplace trust and may result in temporary account suspension or placement penalties.</div>
                    </div>
                </div>

                {{-- Section 5: Payments & Commission Fees --}}
                <div id="section-5" class="legal-section-card">
                    <h2><i class="fa-solid fa-credit-card text-purple" style="color: #4b1fa8;"></i> 5. Payments & Commission Fees</h2>
                    <p>
                        Kimih processes online client payments securely via PCI-compliant gateway infrastructure. Commission rates and payout timelines are structured as follows:
                    </p>
                    
                    <table class="legal-table">
                        <thead>
                            <tr>
                                <th>Tier</th>
                                <th>Marketplace Commission</th>
                                <th>Payout Schedule</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Standard Venue Listing</td>
                                <td>0% on direct bookings / standard marketplace rate</td>
                                <td>Weekly Direct Deposit</td>
                            </tr>
                            <tr>
                                <td>Featured & New Partner Boost</td>
                                <td>Custom promo rate</td>
                                <td>Bi-Weekly Automated Transfer</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Section 6: Client Reviews & Quality Standards --}}
                <div id="section-6" class="legal-section-card">
                    <h2><i class="fa-solid fa-star text-purple" style="color: #4b1fa8;"></i> 6. Client Reviews & Quality Standards</h2>
                    <p>
                        Clients who complete appointments through Kimih are invited to submit ratings and feedback.
                    </p>
                    <ul>
                        <li>Partners may not post fake reviews, incentivize artificial ratings, or harass clients regarding negative feedback.</li>
                        <li>Kimih maintains strict algorithms to filter fraudulent or abusive reviews.</li>
                    </ul>
                </div>

                {{-- Section 7: Intellectual Property --}}
                <div id="section-7" class="legal-section-card">
                    <h2><i class="fa-solid fa-images text-purple" style="color: #4b1fa8;"></i> 7. Intellectual Property & Media</h2>
                    <p>
                        Partners grant Kimih a worldwide, non-exclusive license to display business names, logos, salon interior photography, and marketing media across Kimih marketplace applications and promotional channels.
                    </p>
                </div>

                {{-- Section 8: Termination --}}
                <div id="section-8" class="legal-section-card">
                    <h2><i class="fa-solid fa-power-off text-purple" style="color: #4b1fa8;"></i> 8. Term, Suspension & Termination</h2>
                    <p>
                        Either party may terminate this Agreement at any time with 14 days' written notice. Kimih reserves the immediate right to suspend or terminate accounts engaging in fraudulent activities, health violation reports, or breach of service commitments.
                    </p>
                </div>

                {{-- Section 9: Legal Contact --}}
                <div id="section-9" class="legal-section-card">
                    <h2><i class="fa-solid fa-envelope-open-text text-purple" style="color: #4b1fa8;"></i> 9. Legal Contact & Support</h2>
                    <p>
                        If you have questions regarding these Partner Terms of Service or require assistance with merchant compliance, please reach out to our legal department:
                    </p>
                    <div class="p-3 bg-light rounded-3 border mt-3">
                        <div class="fw-bold text-dark">Kimih Legal & Merchant Operations</div>
                        <div class="text-muted small">Email: legal@kimih.com • partners@kimih.com</div>
                        <div class="text-muted small">Support Hotline: +971 (0) 4 123 4567</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
