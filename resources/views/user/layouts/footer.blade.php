<footer class="kimih-footer">
    <div class="kimih-footer-top">
        <div class="container">
            <div class="row g-5">
                {{-- COLUMN 1 — KIMIH --}}
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="kimih-footer-brand">
                        <a href="/" class="d-inline-block mb-3 text-decoration-none">
                            @if(!empty(settings()->logo_footer))
                                <img src="{{ asset(Storage::url(settings()->logo_footer)) }}" alt="{{ settings()->site_name ?? 'Kimih' }}" style="max-height: 48px; width: auto;">
                            @else
                                <span class="brand-footer-logo" style="font-family: inherit; font-size: 1.7rem; font-weight: 800; color: #ffffff; letter-spacing: -0.03em; display: inline-flex; align-items: center; gap: 10px;">
                                    <svg viewBox="0 0 40 40" aria-hidden="true" style="width: 36px; height: 36px; flex-shrink: 0;">
                                        <defs>
                                            <linearGradient id="footerLogoGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                                <stop offset="0%" stop-color="#a855f7"/>
                                                <stop offset="100%" stop-color="#4b1fa8"/>
                                            </linearGradient>
                                        </defs>
                                        <rect width="40" height="40" rx="12" fill="url(#footerLogoGrad)"/>
                                        <path d="M20 9c0 6.1-4.9 11-11 11 6.1 0 11 4.9 11 11 0-6.1 4.9-11 11-11-6.1 0-11-4.9-11-11z" fill="#ffffff" opacity="0.95"/>
                                    </svg>
                                    <span style="color: #ffffff; font-weight: 800;">Kimih</span><span style="color: #ec4899; font-weight: 800;">.</span>
                                </span>
                            @endif
                        </a>

                        <p>Discover and book beauty and wellness experiences near you. Find trusted salons, compare ratings, and book appointments 24/7.</p>
                        <ul class="kimih-footer-social">
                            @if(siteSocialLinks()?->facebook_link)
                            <li>
                                <a href="{{ siteSocialLinks()->facebook_link }}" target="_blank" class="kimih-footer-social-link" aria-label="Facebook">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                            </li>
                            @endif
                            @if(siteSocialLinks()?->twitter_link)
                            <li>
                                <a href="{{ siteSocialLinks()->twitter_link }}" target="_blank" class="kimih-footer-social-link" aria-label="Twitter">
                                    <i class="fa-brands fa-x-twitter"></i>
                                </a>
                            </li>
                            @endif
                            @if(siteSocialLinks()?->linkedin_link)
                            <li>
                                <a href="{{ siteSocialLinks()->linkedin_link }}" target="_blank" class="kimih-footer-social-link" aria-label="LinkedIn">
                                    <i class="fa-brands fa-linkedin-in"></i>
                                </a>
                            </li>
                            @endif
                            @if(siteSocialLinks()?->instagram_link)
                            <li>
                                <a href="{{ siteSocialLinks()->instagram_link }}" target="_blank" class="kimih-footer-social-link" aria-label="Instagram">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>

                {{-- COLUMN 2 — EXPLORE --}}
                <div class="col-lg-2 col-md-6 col-6">
                    <div class="kimih-footer-col">
                        <h4>Explore</h4>
                        <ul class="kimih-footer-links">
                            <li><a href="{{ route('shop.search', ['service' => 'Makeup & Beauty']) }}">Beauty Services</a></li>
                            <li><a href="{{ route('shop.search', ['service' => 'Hair Styling']) }}">Hair Salons</a></li>
                            <li><a href="{{ route('shop.search', ['service' => 'Nail Care']) }}">Nails Care</a></li>
                            <li><a href="{{ route('shop.search', ['service' => 'Spa & Massage']) }}">Spas & Massage</a></li>
                            <li><a href="{{ route('shop.search', ['service' => 'Spa & Massage']) }}">Wellness Shops</a></li>
                        </ul>
                    </div>
                </div>

                {{-- COLUMN 3 — FOR BUSINESSES --}}
                <div class="col-lg-2 col-md-6 col-6">
                    <div class="kimih-footer-col">
                        <h4>For Businesses</h4>
                        <ul class="kimih-footer-links">
                            <li><a href="{{ route('auth-business-sign-up') }}">List Your Business</a></li>
                            <li><a href="{{ route('auth-for-business') }}">Partner Login</a></li>
                            <li><a href="{{ route('partner.terms') }}">Partner Terms</a></li>
                            @auth
                                @if(auth()->user()->hasRole('Business User') || auth()->user()->hasRole('Admin'))
                                    <li><a href="{{ route('calendar.index') }}">Appointment Calendar</a></li>
                                @endif
                            @endauth
                        </ul>
                    </div>
                </div>

                {{-- COLUMN 4 — SUPPORT --}}
                <div class="col-lg-2 col-md-6 col-6">
                    <div class="kimih-footer-col">
                        <h4>Support</h4>
                        <ul class="kimih-footer-links">
                            <li><a href="{{ route('contact-us.index') }}">Help Center</a></li>
                            <li><a href="{{ route('contact-us.index') }}">Contact Us</a></li>
                            <li><a href="{{ route('front.faqs') }}">FAQs</a></li>
                        </ul>
                    </div>
                </div>

                {{-- COLUMN 5 — NEWSLETTER & LEGAL --}}
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="kimih-footer-newsletter">
                        <h4>Newsletter</h4>
                        <p>Subscribe to receive updates, wellness tips, and exclusive partner discounts.</p>
                        <form class="kimih-newsletter-form" action="{{ route('subscribe.store') }}" method="POST">
                            @csrf
                            <input type="email" placeholder="Email address" name="email" required autocomplete="off" aria-label="Email address for newsletter">
                            <button type="submit">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="kimih-footer-bottom">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-6 text-center text-md-start">
                    <p>&copy; {{ date('Y') }} <strong>Kimih</strong>. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item mx-2"><a href="{{ route('privacy.index') }}" class="text-decoration-none text-muted">Privacy Policy</a></li>
                        <li class="list-inline-item mx-2"><a href="{{ route('term_of_service.index') }}" class="text-decoration-none text-muted">Terms of Service</a></li>
                        <li class="list-inline-item mx-2"><a href="{{ route('cancellation.policy') }}" class="text-decoration-none text-muted">Cancellation Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
