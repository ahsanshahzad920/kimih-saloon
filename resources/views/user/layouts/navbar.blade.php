<div class="navbar-area">
    <div class="mobile-responsive-nav">
        <div class="container">
            <div class="mobile-responsive-menu">
                <div class="logo">
                    <a href="/">
                        <!-- <h4>SURBELA</h4> -->
                        <img src="{{ asset(Storage::url(settings()->logo_front ?? '')) }}"alt="Logo">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="desktop-nav desktop-nav-three nav-area">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-md navbar-light ">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset(Storage::url(settings()->logo_front ?? '')) }}"alt="Logo">
                    {{-- <img src="{{ asset('assets/images/logo.png') }}"alt="Logo"> --}}
                    <!-- <img src="assets/images/logo.jpeg" class="logo-one" alt="Logo"> -->
                    <!-- <img src="assets/images/logo.jpeg" class="logo-two" alt="Logo"> -->
                </a>
                {{-- @if (request()->routeIs('shop.search'))
                    <h5>Search</h5>
                @endif --}}
                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ route('business.page') }}" class="nav-link">For Business</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ route('blogs.show.front') }}" class="nav-link">Blogs</a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('pricing') }}" class="nav-link">Pricing</a>
                        </li>

                        <li class="nav-item">
                            <div class="dropdown">
                                <button class=" bg-transparent dropdown-toggle" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Menu
                                </button>
                                {{-- <ul class="dropdown-menu rounded-lg" aria-labelledby="dropdownMenuButton1">
                                    @auth
                                        <li class="fw-bolder text-center p-3">{{auth()->user()->name}}</li>
                                        <li><a class="dropdown-item" href="{{route('user-profile.index')}}">Profile</a></li>
                                        <li><a class="dropdown-item" href="{{route('customer.appointments')}}">Appointments</a></li>
                                        <li><a class="dropdown-item" href="{{route('customer.membership.purchased')}}">Memberships</a></li>
                                        <li><a class="dropdown-item" href="{{route('customer.product.orders')}}">Product Orders</a></li>

                                        <form action="{{route('logout')}}" method="POST" id="logout-form">
                                            @csrf
                                        </form>
                                        <li><a class="dropdown-item" href="#" onclick="document.getElementById('logout-form').submit()">Logout</a></li>


                                    @else
                                        <li><a class="dropdown-item" href="{{ route('user-flow') }}">Login</a></li>
                                    @endauth
                                    <li><a class="dropdown-item" href="{{route('contact-us.index')}}">Customer support</a></li>
                                    <li><a class="dropdown-item" href="#">Kimih for business</a></li>
                                </ul> --}}
                                <ul class="dropdown-menu rounded-lg" aria-labelledby="dropdownMenuButton1">
                                    @auth
                                        <li class="fw-bolder text-center p-3">{{ auth()->user()->name }}</li>
                                        @if (auth()->user()->hasRole('Client'))
                                            <li><a class="dropdown-item"
                                                    href="{{ route('user-profile.index') }}">Profile</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('user.wallet') }}">My Wallet</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('customer.appointments') }}">Appointments</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('customer.membership.purchased') }}">Memberships</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('customer.product.orders') }}">Product Orders</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('cutomer.feedback.index') }}">My Feedback</a></li>
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
                                    <li><a class="dropdown-item" href="{{ route('contact-us.index') }}">Customer
                                            support</a></li>
                                </ul>

                            </div>
                        </li>
                        {{-- <li class="nav-item ms-lg-4">
                            <div class="dropdown">
                                <button class=" bg-transparent dropdown-toggle" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Lang
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">English </a></li>
                                    <li><a class="dropdown-item" href="#">Arabic</a></li>
                                    <li><a class="dropdown-item" href="#">Farci</a></li>
                                    <li><a class="dropdown-item" href="#">Hindi/Urdu</a></li>
                                    <li><a class="dropdown-item" href="#">Rushiya</a></li>
                                </ul>
                            </div>
                        </li> --}}
                        {{-- <li class="nav-item ms-3">
                            <div id="google_translate_element"></div>
                        </li> --}}
                    </ul>

                </div>
            </nav>
        </div>
    </div>
</div>
