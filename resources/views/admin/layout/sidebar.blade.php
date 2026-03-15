<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a class="" href="#">
            <img class="img-fluid logo-sm" src="{{ asset(Storage::url(settings()->logo ?? '')) }}" alt="">
            <img class="img-fluid logo-lg" src="{{ asset(Storage::url(settings()->logo_with_site_name ?? '')) }}"
                alt="">
            {{-- <img class="img-fluid logo-sm" src="assets/images/logo-icon.png" alt="">
            <img class="img-fluid logo-lg" src="assets/images/gradient logo.png" alt=""> --}}
        </a>

        <button type="button" class="toogler-menu-btn btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="las la-chevron-circle-left"></i>
            <i class="las la-chevron-circle-right"></i>
            <!-- <i class="ri-record-circle-line"></i> -->
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav mt-3" id="navbar-nav">
                <!-- <li class="menu-title"><span data-key="t-menu">Menu</span></li> -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('dashboard') }}">
                        <img class="img-fluid" src="{{ asset('dash-assets/images/home.png') }}"> <span
                            data-key="t-dashboards">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('calendar.index') }}">
                        <img class="img-fluid" src="{{ asset('dash-assets/images/check mark.png') }}">
                        <span data-key="t-dashboards">Calendar</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarSales" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarSales">
                        <img class="img-fluid" src="{{ asset('dash-assets/images/tag.png') }}"> <span
                            data-key="t-apps">Sales</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarSales">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                {{-- open book.png --}}
                                <a href="{{ route('daily-sales.index') }}" class="nav-link" data-key="t-api-key">Daily
                                    sales summary</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('appointment-list.index') }}" class="nav-link"
                                    data-key="t-api-key">Appointments</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('sales.index') }}" class="nav-link" data-key="t-api-key">Sales</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('payment-transactions.index') }}" class="nav-link"
                                    data-key="t-api-key">Payments</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-api-key">Gift cards</a>
                            </li> --}}
                            <li class="nav-item">
                                <a href="{{ route('paid-plans.index') }}" class="nav-link"
                                    data-key="t-api-key">Memberships</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarClients" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarClients">
                        <img class="img-fluid" src="{{ asset('dash-assets/images/user.png') }}"> <span
                            data-key="t-apps">Clients</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarClients">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('clients.index') }}" class="nav-link" data-key="t-api-key">Clients
                                    list</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-api-key">Reviews</a>
                            </li> --}}
                            {{-- <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-api-key">Forms</a>
                            </li> --}}
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCatalogue" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarCatalogue">
                        <img class="img-fluid" src="{{ asset('dash-assets/images/open book.png') }}"> <span
                            data-key="t-apps">Catalogue</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCatalogue">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('services.index') }}" class="nav-link"
                                    data-key="t-api-key">Services</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('memberships.index') }}" class="nav-link"
                                    data-key="t-api-key">Memberships</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('products.index') }}" class="nav-link"
                                    data-key="t-api-key">Products</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-api-key">Gift cards</a>
                            </li> --}}
                            {{-- <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-api-key">Stocktakes</a>
                            </li> --}}
                            <li class="nav-item">
                                <a href="{{ route('stock-orders.index') }}" class="nav-link"
                                    data-key="t-api-key">Stock orders</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('suppliers.index') }}" class="nav-link"
                                    data-key="t-api-key">Suppliers</a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarBooking" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarBooking">
                        <img class="img-fluid" src="{{ asset('dash-assets/images/booking.png') }}"> <span
                            data-key="t-apps">Online Booking</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarBooking">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-api-key">Marketplace profile</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-api-key">Reserve with Google</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-api-key">Facebook and Instagram
                                    bookings</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-api-key"> Link builder</a>
                            </li>

                        </ul>
                    </div>
                </li> --}}
                <!-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="las la-user-tie"></i> <span data-key="t-apps">Marketing</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                              <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-api-key">Automations</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-api-key">Messages history</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-api-key">Deals</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-api-key">Smart pricing</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-api-key">Integrations</a>
                            </li>
                        </ul>
                    </div>
                </li> -->
                
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarMarkiting" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarMarkiting">
                        <img class="img-fluid" src="{{ asset('dash-assets/images/loud-speaker.png') }}">
                        <span data-key="t-apps">Marketing</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarMarkiting">
                        <ul class="nav nav-sm flex-column">
                            {{-- Leads --}}
                            <li class="nav-item">
                                <a class="nav-link " href="{{ route('leads.index') }}">
                                    <span data-key="t-dashboards">Leads</span>
                                </a>
                            </li>

                            {{-- Send SMS --}}
                            <li class="nav-item">
                                <a class="nav-link " href="{{ route('send-sms.index') }}">
                                    <span data-key="t-dashboards">SMS Marketing</span>
                                </a>
                            </li>

                            {{-- Emails --}}
                            <li class="nav-item">
                                <a class="nav-link " href="{{ route('sub.index') }}">
                                    <span data-key="t-dashboards">Email Marketing</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
               
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarTeam" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarTeam">
                        <img class="img-fluid" src="{{ asset('dash-assets/images/team.png') }}"> <span
                            data-key="t-apps">Team</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarTeam">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('team-members.index') }}" class="nav-link"
                                    data-key="t-api-key">Team members</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('scheduled-shifts.index') }}" class="nav-link"
                                    data-key="t-api-key">Scheduled shifts</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/messenger">
                        <img class="img-fluid" src="{{ asset('dash-assets/images/check mark.png') }}">
                        <span data-key="t-dashboards">Messaging Center</span>
                    </a>
                </li>
                @role('Business User')
                <li class="nav-item">
                    <a class="nav-link " href="/my-wallet">
                        <img class="img-fluid" src="{{ asset('dash-assets/images/check mark.png') }}">
                        <span data-key="t-dashboards">My Wallet</span>
                    </a>
                </li>
                @endrole

                {{-- Blog --}}
                @role('Admin')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#blogstypes" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="blogstypes">
                        <img class="img-fluid" src="{{ asset('dash-assets/images/open book.png') }}"> <span
                            data-key="t-apps">Blogs Post</span>
                    </a>
                    <div class="collapse menu-dropdown" id="blogstypes">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('blog-types.index') }}" class="nav-link" data-key="t-api-key">Blog
                                    Types</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('blogs.index') }}" class="nav-link" data-key="t-api-key">Blogs</a>
                            </li>
                        </ul>
                    </div>
                </li>

                
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarUserManagement" data-bs-toggle="collapse"
                            role="button" aria-expanded="false" aria-controls="sidebarUserManagement">
                            <img class="img-fluid" src="{{ asset('dash-assets/images/team.png') }}"> <span
                                data-key="t-apps">User Management</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarUserManagement">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}" class="nav-link" data-key="t-api-key">Users</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('roles.index') }}" class="nav-link" data-key="t-api-key">Roles</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('permissions.index') }}" class="nav-link"
                                        data-key="t-api-key">Permissions</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarCMS" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarCMS">
                            <img class="img-fluid" src="{{ asset('dash-assets/images/team.png') }}"> <span
                                data-key="t-apps">CMS</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarCMS">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('plans.index') }}" class="nav-link" data-key="t-api-key">Plans</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('landing-page.index') }}" class="nav-link"
                                        data-key="t-api-key">Landing Page</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('faqs.index') }}" class="nav-link" data-key="t-api-key">Faqs</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('feedback.index') }}" class="nav-link"
                                        data-key="t-api-key">Feedback</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('features.index') }}" class="nav-link"
                                        data-key="t-api-key">Features</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('cms-business.index') }}" class="nav-link"
                                        data-key="t-api-key">Business</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('business-info.index') }}" class="nav-link"
                                        data-key="t-api-key">Business Info</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('crm-about.index') }}" class="nav-link" data-key="t-api-key">
                                        About Us
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('cms.contactUs') }}" class="nav-link" data-key="t-api-key">Contact
                                        Us</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endrole
                {{-- <li class="nav-item">
                    <a class="nav-link " href="#">
                        <img class="img-fluid" src="{{ asset('dash-assets/images/file.png') }}"> <span
                            data-key="t-dashboards">Reports</span>
                    </a>
                </li> --}}

                {{-- Ai Bot Faqs --}}
                @role('Admin')
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('bot-faqs.index') }}">
                            <img class="img-fluid" src="{{ asset('dash-assets/images/settings.png') }}"> <span
                                data-key="t-dashboards">Bot Faqs</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('settings.index') }}">
                            <img class="img-fluid" src="{{ asset('dash-assets/images/settings.png') }}"> <span
                                data-key="t-dashboards">Setting</span>
                        </a>
                    </li>
                @endrole







            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
