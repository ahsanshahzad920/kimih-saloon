<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- jQuery UI CSS -->
    {{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" /> --}}
    <!-- jQuery UI JS -->
    {{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" />

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css"  /> --}}

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/dasheets/css/style.css') }}" rel="stylesheet" />

    {{-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" /> --}}
    {{-- <link href="{{ asset('back/assets/css/styles.css') }}" rel="stylesheet" /> --}}
    {{-- <link href="{{ asset('back/assets/js/simplebar/css/simplebar.css') }}" rel="stylesheet" /> --}}

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" /> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"> --}}
    </script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('style')

    <title>{{ env('APP_NAME') }} | @yield('title')</title>
    <style>
        .page-link {
            color: black;
        }
        .dt-buttons {
            display: none;
        }

        .cursor-p {
            cursor: pointer;
        }

        .dataTables_filter {
            display: none;
        }
    </style>
</head>

<body>
    @include('admin.layout.navbar')

    @include('admin.layout.sidebar')
    <!-- Content Start -->
    <div class="content">
      <!-- Navbar Start -->
      <nav class="navbar navbar-expand border-bottom bg-white navbar-light sticky-top px-4 py-0"
          style="height: 80px">
          <a href="{{route('dashboard')}}" class="navbar-brand d-flex d-lg-none me-4">
              <h2 class="text-primary mb-0"></h2>

          </a>
          <a href="#"
              class="sidebar-toggler text-decoration-none flex-shrink-0 align-items-center d-inline-flex">
              <i class="fa fa-bars"></i>
          </a>

          <div class="navbar-nav align-items-center ms-auto">
            <div class="nav-item">
                <a href="" class="nav-link">
                    <button class="border-theme btn bg-theme rounded-5">POS</button>
                </a>

            </div>
              <div class="nav-item dropdown">
                  <a href="#" class="nav-link" data-bs-toggle="dropdown">
                      <i class="fa fa-bell align-items-center d-inline-flex"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                      <a href="#" class="dropdown-item">
                          <h6 class="fw-normal mb-0">Profile updated</h6>
                          <small>15 minutes ago</small>
                      </a>
                      <hr class="dropdown-divider" />
                      <a href="#" class="dropdown-item">
                          <h6 class="fw-normal mb-0">New user added</h6>
                          <small>15 minutes ago</small>
                      </a>
                      <hr class="dropdown-divider" />
                      <a href="#" class="dropdown-item">
                          <h6 class="fw-normal mb-0">Password changed</h6>
                          <small>15 minutes ago</small>
                      </a>
                      <hr class="dropdown-divider" />
                      <a href="#" class="dropdown-item text-center">See all notifications</a>
                  </div>
              </div>
              <div class="nav-item dropdown">
                  <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                      <img class="rounded-circle me-lg-2" src="{{asset('assets/dasheets/img/profile-img.png') }}" alt=""
                          style="width: 40px; height: 40px" />
                  </a>
                  <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                      <a href="{{route('profile.index')}}" class="dropdown-item">My Profile</a>
                      <a href="" class="dropdown-item">Settings</a>

                          <li><a class="dropdown-item" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">Logout</a>
                      </li>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </div>
              </div>
          </div>
      </nav>
  </div>
</div>


        @yield('content')

        @include('admin.layout.footer')


    @yield('modal')

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"> --}}
    </script>
    <script src="{{ asset('back/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('back/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('back/assets/js/datatables-simple-demo.js') }}"></script>
    <script src="{{ asset('back/assets/js/simplebar/js/simplebar.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


     <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" ></script>
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
     <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>
     <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
     <!-- Template Javascript -->
     <script src="{{ asset('assets/dasheets/js/main.js') }}"></script>

     {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script> --}}
     @yield('scripts')

</body>

</html>
