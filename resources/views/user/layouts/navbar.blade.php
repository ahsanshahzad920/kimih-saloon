<header class="kimih-header">
    <div class="container-fluid">
        <nav class="kimih-navbar" aria-label="Primary">
            <a class="kimih-navbar-brand" href="/">
                <img src="{{ asset(Storage::url(settings()->logo_front ?? '')) }}" alt="{{ settings()->site_name ?? 'Kimih' }} home">
            </a>

            @php
                $isHome = request()->is('/');
            @endphp
            <ul class="kimih-nav-links">
                <li>
                    <a href="{{ $isHome ? '#home' : url('/#home') }}" class="kimih-nav-link">Home</a>
                </li>
                <li>
                    <a href="{{ $isHome ? '#explore' : url('/#explore') }}" class="kimih-nav-link">Explore</a>
                </li>
                <li>
                    <a href="{{ $isHome ? '#how-it-works' : url('/#how-it-works') }}" class="kimih-nav-link">How It Works</a>
                </li>
                <li>
                    <a href="{{ $isHome ? '#why-kimih' : url('/#why-kimih') }}" class="kimih-nav-link">Why Kimih</a>
                </li>
                <li>
                    <a href="{{ $isHome ? '#pricing' : url('/#pricing') }}" class="kimih-nav-link">Pricing</a>
                </li>
                <li>
                    <a href="{{ $isHome ? '#for-business' : url('/#for-business') }}" class="kimih-nav-link">For Business</a>
                </li>
                <li>
                    <a href="{{ $isHome ? '#testimonials' : url('/#testimonials') }}" class="kimih-nav-link">Testimonials</a>
                </li>
                <li class="dropdown">
                    <button class="kimih-nav-link kimih-nav-more bg-transparent dropdown-toggle" type="button"
                        id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth()->user()->name ?? 'Menu' }} <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <ul class="dropdown-menu rounded-lg" aria-labelledby="dropdownMenuButton1">
                        @auth
                            <li class="fw-bolder text-center p-3">{{ auth()->user()->name }}</li>
                            @if (auth()->user()->hasRole('Client'))
                                <li><a class="dropdown-item" href="{{ route('user-profile.index') }}">Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.wallet') }}">My Wallet</a></li>
                                <li><a class="dropdown-item" href="{{ route('customer.appointments') }}">Appointments</a></li>
                                <li><a class="dropdown-item" href="{{ route('customer.membership.purchased') }}">Memberships</a></li>
                                <li><a class="dropdown-item" href="{{ route('customer.product.orders') }}">Product Orders</a></li>
                                <li><a class="dropdown-item" href="{{ route('cutomer.feedback.index') }}">My Feedback</a></li>
                            @elseif (auth()->user()->hasRole('Business User') || auth()->user()->hasRole('Admin'))
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                            @endif

                            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                                @csrf
                            </form>
                            <li><a class="dropdown-item" href="#"
                                    onclick="document.getElementById('logout-form').submit()">Logout</a></li>
                        @else
                            <li><a class="dropdown-item" href="{{ route('user-flow') }}">Login</a></li>
                        @endauth
                        <li><a class="dropdown-item" href="{{ route('contact-us.index') }}">Customer support</a></li>
                    </ul>
                </li>
            </ul>

            <div class="kimih-nav-auth">
                @guest
                    <a href="{{ route('user-flow') }}" class="kimih-login-link">Login</a>
                    <a href="{{ route('user-flow') }}" class="default-btn kimih-signup-btn">Get Started</a>
                @endguest
            </div>

            <button type="button" class="kimih-nav-toggle" aria-label="Open navigation menu"
                aria-controls="kimihMobileDrawer" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </nav>
    </div>

    <div class="kimih-mobile-backdrop" id="kimihMobileBackdrop"></div>
    <div class="kimih-mobile-drawer" id="kimihMobileDrawer" role="dialog" aria-modal="true" aria-label="Navigation menu">
        <div class="kimih-mobile-drawer-header">
            <a href="/" class="kimih-navbar-brand">
                <img src="{{ asset(Storage::url(settings()->logo_front ?? '')) }}" alt="{{ settings()->site_name ?? 'Kimih' }} home">
            </a>
            <button type="button" class="kimih-mobile-close" aria-label="Close navigation menu">&times;</button>
        </div>
        <div class="kimih-mobile-drawer-body">
            <ul class="kimih-mobile-links">
                <li><a href="{{ $isHome ? '#home' : url('/#home') }}">Home</a></li>
                <li><a href="{{ $isHome ? '#explore' : url('/#explore') }}">Explore</a></li>
                <li><a href="{{ $isHome ? '#how-it-works' : url('/#how-it-works') }}">How It Works</a></li>
                <li><a href="{{ $isHome ? '#why-kimih' : url('/#why-kimih') }}">Why Kimih</a></li>
                <li><a href="{{ $isHome ? '#pricing' : url('/#pricing') }}">Pricing</a></li>
                <li><a href="{{ $isHome ? '#for-business' : url('/#for-business') }}">For Business</a></li>
                <li><a href="{{ $isHome ? '#testimonials' : url('/#testimonials') }}">Testimonials</a></li>
                @auth
                    @if (auth()->user()->hasRole('Client'))
                        <li><a href="{{ route('user-profile.index') }}">Profile</a></li>
                        <li><a href="{{ route('user.wallet') }}">My Wallet</a></li>
                        <li><a href="{{ route('customer.appointments') }}">Appointments</a></li>
                        <li><a href="{{ route('customer.membership.purchased') }}">Memberships</a></li>
                        <li><a href="{{ route('customer.product.orders') }}">Product Orders</a></li>
                        <li><a href="{{ route('cutomer.feedback.index') }}">My Feedback</a></li>
                    @elseif (auth()->user()->hasRole('Business User') || auth()->user()->hasRole('Admin'))
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    @endif
                @endauth
                <li><a href="{{ route('contact-us.index') }}">Customer Support</a></li>
            </ul>

            <div class="kimih-mobile-auth">
                @guest
                    <a href="{{ route('user-flow') }}" class="default-btn two">Login</a>
                    <a href="{{ route('user-flow') }}" class="default-btn kimih-signup-btn">Get Started</a>
                @else
                    <form action="{{ route('logout') }}" method="POST" id="logout-form-mobile">
                        @csrf
                    </form>
                    <a href="#" class="default-btn two"
                        onclick="document.getElementById('logout-form-mobile').submit()">Logout</a>
                @endauth
            </div>
        </div>
    </div>
</header>

<script>
    (function($) {
        var $drawer = $('#kimihMobileDrawer');
        var $backdrop = $('#kimihMobileBackdrop');
        var $toggle = $('.kimih-nav-toggle');
        var $close = $('.kimih-mobile-close');

        function openDrawer() {
            $drawer.add($backdrop).addClass('is-open');
            $toggle.addClass('is-active').attr('aria-expanded', 'true');
            $('body').addClass('kimih-drawer-open');
            $close.trigger('focus');
        }

        function closeDrawer() {
            $drawer.add($backdrop).removeClass('is-open');
            $toggle.removeClass('is-active').attr('aria-expanded', 'false');
            $('body').removeClass('kimih-drawer-open');
            $toggle.trigger('focus');
        }

        $toggle.on('click', openDrawer);
        $close.on('click', closeDrawer);
        $backdrop.on('click', closeDrawer);
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && $drawer.hasClass('is-open')) {
                closeDrawer();
            }
        });
    })(jQuery);
</script>
