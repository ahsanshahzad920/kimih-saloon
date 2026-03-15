<div class="container-fluid position-relative bg-white d-flex p-0">

    <!-- Sidebar Start -->


    <div class="positon-relative sidebar-ul">
        <div id="product" style="display: none">
            <ul class="list-unstyled m-0 px-4 rounded-5">
                <li class="mb-2 ">
                    <a href="{{route('sales.index')}}"
                        class="text-decoration-none nav-item nav-link "><img
                            src="{{ asset('assets/dasheets/img/menu.svg') }}" class="img-fluid me-2"
                            alt="" />All Sales</a>
                </li>
                <li class="mb-2 ">
                    <a href="{{route('sales.create')}}"
                        class="text-decoration-none nav-item nav-link "><img
                            src="{{ asset('assets/dasheets/img/menu.svg') }}" class="img-fluid me-2"
                            alt="" />Create Sales</a>
                </li>
                <li class="mb-2 ">
                    <a href="{{route('sales.create')}}"
                        class="text-decoration-none nav-item nav-link "><img
                            src="{{ asset('assets/dasheets/img/menu.svg') }}" class="img-fluid me-2"
                            alt="" />Payments</a>
                </li>

            </ul>
        </div>
        <div id="sale" style="display: none">
            <ul class="list-unstyled m-0 py-3 px-3 rounded-5">
                <li class="mb-2 ">
                    <a href="{{route('clients.index')}}"
                        class="text-decoration-none nav-item nav-link "><img
                            src="{{ asset('assets/dasheets/img/menu.svg') }}" class="img-fluid me-2"
                            alt="" />Client Lists
                    </a>
                </li>
                <li class="mb-2 ">
                    <a href="{{route('clients.create')}}"
                        class="text-decoration-none nav-item nav-link "><img
                            src="{{ asset('assets/dasheets/img/menu.svg') }}" class="img-fluid me-2"
                            alt="" />Create Client
                    </a>
                </li>
                <li class="mb-2 ">
                    <a href="{{route('clients.create')}}"
                        class="text-decoration-none nav-item nav-link "><img
                            src="{{ asset('assets/dasheets/img/menu.svg') }}" class="img-fluid me-2"
                            alt="" />Blacklist
                    </a>
                </li>
            </ul>
        </div>
        <div id="purchase" style="display: none">
            <ul class="list-unstyled m-0 py-3 px-3 rounded-5">
                <li class="mb-2 ">
                    <a href="{{route('services.index')}}"
                        class="text-decoration-none nav-item nav-link "><img
                            src="{{ asset('assets/dasheets/img/menu.svg') }}" class="img-fluid me-2"
                            alt="" />Services
                    </a>
                </li>
                <li class="mb-2 ">
                    <a href="{{route('memberships.index')}}"
                        class="text-decoration-none nav-item nav-link "><img
                            src="{{ asset('assets/dasheets/img/menu.svg') }}" class="img-fluid me-2"
                            alt="" />Memmbership
                    </a>
                </li>
                <li class="mb-2 ">
                    <a href="{{route('products.index')}}"
                        class="text-decoration-none nav-item nav-link "><img
                            src="{{ asset('assets/dasheets/img/menu.svg') }}" class="img-fluid me-2"
                            alt="" />Products
                    </a>
                </li>
                <li class="mb-2 ">
                    <a href="{{route('stock-orders.index')}}"
                        class="text-decoration-none nav-item nav-link "><img
                            src="{{ asset('assets/dasheets/img/menu.svg') }}" class="img-fluid me-2"
                            alt="" />Stock Orders
                    </a>
                </li>
            </ul>
        </div>
        <div id="inventory" style="display: none">
            <ul class="list-unstyled m-0 py-3 px-3 rounded-5">
                <li class="mb-2 ">
                    <a href="{{route('team-members.index')}}"
                        class="text-decoration-none nav-item nav-link "><img
                            src="{{ asset('assets/dasheets/img/menu.svg') }}" class="img-fluid me-2"
                            alt="" />Team Members
                    </a>
                </li>
                <li class="mb-2 ">
                    <a href="{{route('team-members.index')}}"
                        class="text-decoration-none nav-item nav-link "><img
                            src="{{ asset('assets/dasheets/img/menu.svg') }}" class="img-fluid me-2"
                            alt="" />Schedule Shifts
                    </a>
                </li>
            </ul>
        </div>
        <div id="transfer" style="display: none">
            <ul class="list-unstyled m-0 py-3 px-3 rounded-5">

            </ul>
        </div>

        <div id="customer" style="display: none">
            <ul class="list-unstyled m-0 py-3 px-3 rounded-5">

            </ul>
        </div>
        <div id="vendor" style="display: none">
            <ul class="list-unstyled m-0 py-3 px-3 rounded-5">

            </ul>
        </div>
        <div id="accounting" style="display: none">
            <ul class="list-unstyled m-0 py-3 px-3 rounded-5">

            </ul>
        </div>
        <div id="setting" style="display: none">
            <ul class="list-unstyled m-0 py-3 px-3 rounded-5">

                <li class="mb-2 @if (request()->routeIs('users.*')) sidebar-list @endif">
                    <a href="{{ route('users.index') }}"
                        class="text-decoration-none nav-item nav-link "><img
                            src="{{ asset('assets/dasheets/img/menu.svg') }}" class="img-fluid me-2"
                            alt="" />Users</a>
                </li>
                <li class="mb-2 @if (request()->routeIs('roles.*')) sidebar-list @endif">
                    <a href="{{ route('roles.index') }}"
                        class="text-decoration-none nav-item nav-link "><img
                            src="{{ asset('assets/dasheets/img/menu.svg') }}" class="img-fluid me-2"
                            alt="" />User Role</a>
                </li>
                <li class="mb-2 @if (request()->routeIs('permissions.*')) sidebar-list @endif">
                    <a href="{{ route('permissions.index') }}"
                        class="text-decoration-none nav-item nav-link "><img
                            src="{{ asset('assets/dasheets/img/menu.svg') }}" class="img-fluid me-2"
                            alt="" />User Permission</a>
                </li>

            </ul>
        </div>
        <div id="report" style="display: none">
            <ul class="list-unstyled m-0 py-3 px-3 rounded-5">

            </ul>
        </div>
    </div>
    <!-- Sidebar End -->
