

<footer class="footer-area footer-bg">
    <div class="container pt-100 pb-70">
        <div class="row">
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="footer-widget pe-5">
                    <div class="footer-logo">
                        <a href="#">
<!--                             <img src="{{ asset('assets/images/logo 2.png') }}" class="footer-logo1" height="65"
                                alt="Images"> -->
                            <h4>KIMIH</h4>
                        </a>
                    </div>
                    <!-- <p> Pellentesque habitant morbi tristique senectus netus malesuada fames ac turpis egestas vesti ulum tortor quam bulum tortor feugiat </p> -->
                    <ul class="social-link">
                        <li>
                            <a href="{{ siteSocialLinks()->facebook_link ?? '#' }}" target="_blank" aria-label="Facebook">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ siteSocialLinks()->twitter_link ?? '#' }}" target="_blank" aria-label="Twitter / X">
                                <i class="fa-brands fa-x-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ siteSocialLinks()->linkedin_link ?? '#' }}" target="_blank" aria-label="LinkedIn">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ siteSocialLinks()->instagram_link ?? '#' }}" target="_blank" aria-label="Instagram">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="footer-widget pe-2">
                    <h3>Our Newsletter</h3>
                    <form class="newsletter-form" data-toggle="validator" method="POST">
                        <input type="email" class="form-control" placeholder="Enter Your Email Address" name="EMAIL"
                            required autocomplete="off">
                        <button class="subscribe-btn" type="submit"> Subscribe Now <i class="flaticon-paper-plane"></i>
                        </button>
                        <div id="validator-newsletter" class="form-result"></div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="footer-widget ps-3">
                    <h3>Get In Touch</h3>
                    <ul class="footer-contact">
                        <li>
                            <a href="{{ route('about') }}">About Us</a>
                        </li>
                        <li>
                            <a href="{{ route('privacy.index') }}">Privacy Policy</a>
                        </li>
                        
                        <li>
                            <a href="{{ route('front.faqs') }}">Faq's</a>
                        </li>
                        @if(auth()->user()?->hasRole('Admin') ||auth()->user()?->hasRole('Business User'))
                        <li>
                            <a href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li>
                            <a href="{{ route('calendar.index') }}">Appointment calender</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="footer-widget ps-3">
                    <h3>For Business</h3>
                    <ul class="footer-contact">
                        <li>
                            <a href="{{ route('partner.terms') }}">Partners Terms</a>
                        </li>
                        
                        <li>
                            <a href="{{ route('contact-us.index') }}">Support</a>
                        </li>
                        <li>
                            <a href="{{ route('calendar.index') }}">Appointment calender</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="footer-widget ps-3">
                    <h3>Legal</h3>
                    <ul class="footer-contact">
                        <li>
                            <a href="{{ route('privacy.index') }}">Privacy policy</a>
                        </li>
                        <li>
                            <a href="{{ route('term_of_service.index') }}">Term of Services</a>
                        </li>
                        <li>
                            <a href="{{ route('cancellation.policy') }}">Cancellation Policy</a>
                        </li>
                        <li>
                            <a href="{{ route('term_of_service.index') }}">Term of use</a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="footer-widget ps-3">
                    <h3>Customer Support</h3>
                    <ul class="footer-contact">
                        <li>
                            <a href="{{ route('blogs.show.front') }}">Blog</a>
                        </li>
                        
                        <li>
                           <a href="{{ route('contact-us.index') }}">Support</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="copyright-area">
    <div class="container">
        <div class="copy-right-text text-center">
            <p> Copyright @
                <b>Kimih</b> All Rights Reserved <a href="/" target="_blank"></a>
            </p>
        </div>
    </div>
</div>
