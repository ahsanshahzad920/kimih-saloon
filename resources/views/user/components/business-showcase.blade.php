<!-- ============ KIMIH FOR BUSINESS SHOWCASE SECTION ============ -->
<section class="sec kimih-biz-showcase-section" id="kimih-for-business">
    <div class="container">
        <div class="row align-items-center g-5">
            <!-- Left Side: Copywriting & Capterra Trust Badge -->
            <div class="col-lg-5">
                <span class="eyebrow" style="color:var(--violet-bright);">Partner With Us</span>
                <h2 class="h-sec text-white mb-3" style="font-size:clamp(2.2rem, 4vw, 3.4rem);">
                    Kimih for business
                </h2>
                <p class="lead text-white-50 mb-4" style="font-size:1.1rem;line-height:1.6">
                    Supercharge your business with the top booking &amp; management platform for salons, spas, and barbershops. Independently voted No. 1 by industry professionals.
                </p>
                <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
                    <a href="{{ route('register') }}" class="btn-k btn-hero">
                        Find out more <svg class="ic"><use href="#i-arrow"/></svg>
                    </a>
                    <a href="{{ route('auth-for-business') }}" class="btn-k btn-outline-k text-white border-white-50">
                        Partner Login
                    </a>
                </div>

                <!-- Trust / Capterra Rating -->
                <div class="d-flex align-items-center gap-3 pt-3 border-top border-secondary border-opacity-25">
                    <div>
                        <div class="d-flex align-items-center gap-1 text-warning mb-1">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <span class="fw-bold text-white ms-1">4.9 / 5</span>
                        </div>
                        <p class="mb-0 text-white-50" style="font-size:0.85rem;">
                            Over <strong>1,200+ reviews</strong> on Capterra &amp; Google
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Side: Official Kimih Dashboard & Mobile App Showcase Graphic -->
            <div class="col-lg-7">
                <div class="biz-showcase-stage-wrap">
                    <!-- Glowing Background Aura -->
                    <div class="biz-showcase-aura"></div>

                    <!-- Kimih Dashboard Showcase Image -->
                    <div class="kimih-dashboard-graphic-wrap">
                        <img src="{{ asset('assets/images/kimih_dashboard_showcase.png') }}" 
                             alt="Kimih Business Portal & Mobile App Showcase" 
                             class="img-fluid kimih-dashboard-img" 
                             loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
