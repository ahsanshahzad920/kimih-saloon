<div class="container-fluid position-relative bg-white d-flex p-0">

    <div class="sidebar pb-3">
        <nav class="navbar navbar-light">
            <a href="{{ route('dashboard') }}" class="navbar-brand ms-3">
                {{-- <h3 class="text-primary">LOGO</h3> --}}

                {{-- <img src="{{ asset('/storaewrwege') . (isset($setting->logo) ? $setting->logo : '') }}" alt="Logo" style="width: 80px"> --}}
                <img style="width: 80px" src="{{ asset('assets/dasheets/img/profile-img.png') }}" alt="" </a>

                <div class="navbar-nav">
                    <a href="{{ route('dashboard') }}"
                        class="nav-item nav-link  @if (request()->routeIs('dashboard')) active @endif text-center border-top">
                        <i class="bi bi-grid"></i>
                        <p class="pt-1 mb-0">Dashboard</p>
                    </a>

                    <div id="navbar-toggler1" class="nav-item  nav-link text-center ">
                        <i class="bi bi-box-seam"></i>
                        <p class="pt-1 mb-0">Sales</p>
                    </div>

                    <div id="navbar-toggler2" class="nav-item nav-link text-center">
                        <i class="bi bi-cart"></i>
                        <p class="pt-1 mb-0">Clients </p>
                    </div>
                    <div id="navbar-toggler3"
                        class="nav-item nav-link text-center  @if (request()->routeIs('catalogues.*')) active @endif">
                        <i class="bi bi-file-earmark-text"></i>
                        <p class="pt-1 mb-0">Catalogue</p>
                    </div>

                    <div id="navbar-toggler4" class="nav-item nav-link text-center  ">
                        <i class="bi bi-bag"></i>
                        <p class="pt-1 mb-0">Team Member</p>
                    </div>
                    <div id="navbar-toggler5" class="nav-item nav-link text-center">
                        <i class="bi bi-person"></i>
                        <p class="pt-1 mb-0">Customer</p>
                    </div>
                    <div id="navbar-toggler6" class="nav-item nav-link text-center  ">
                        <i class="bi bi-arrow-90deg-left"></i>
                        <p class="pt-1 mb-0">Transfer</p>
                    </div>
                    <div id="navbar-toggler7" class="nav-item nav-link text-center">
                        <i class="bi bi-house"></i>
                        <p class="pt-1 mb-0">Vendors</p>
                    </div>

                    <a href="" class="nav-item nav-link text-center ">
                        <i class="bi bi-clipboard-data"></i>
                        <p class="pt-1 mb-0">Shipment</p>
                    </a>

                    <div id="navbar-toggler8" class="nav-item nav-link text-center ">
                        <i class="fa-solid fa-wallet"></i>
                        <p class="pt-1 mb-0">Accounting</p>
                    </div>
                    {{-- <a href="/" class="nav-item nav-link text-center">
                    <i class="bi bi-clipboard-data"></i>
                    <p class="pt-1 mb-0">Add Module</p>
                </a> --}}
                    <div id="navbar-toggler9"
                        class="nav-item nav-link text-center @if (request()->routeIs('users.*')) active @endif">
                        <i class="bi bi-gear"></i>
                        <p class="pt-1 mb-0">Setting</p>
                    </div>
                    <div id="navbar-toggler10" class="nav-item nav-link text-center">
                        <i class="bi bi-clipboard-data"></i>
                        <p class="pt-1 mb-0">Reports</p>
                    </div>
        </nav>
    </div>
</div>
