<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm-hover" data-sidebar-image="none" data-preloader="disable">
<head>

    <meta charset="utf-8" />
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="dash-assets/images/">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- jsvectormap css -->
    <link href="{{asset('dash-assets/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
    <!--Swiper slider css-->
    <link href="{{asset('dash-assets/libs/swiper/swiper-bundle.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="{{asset('dash-assets/js/layout.js')}}"></script>
    <!-- Bootstrap Css -->
    <link href="{{asset('dash-assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('dash-assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('dash-assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{asset('dash-assets/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('style')

    <title>{{ env('APP_NAME') }} | @yield('title')</title>

</head>

<body>


    @yield('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
     {{-- <script src="{{asset('dash-assets/js/app.js')}}"></script> --}}
    {{-- <script>
        document.getElementById('inputRememberPassword').addEventListener('focus', function() {
            this.nextElementSibling.classList.add('focus');
        });

        document.getElementById('inputRememberPassword').addEventListener('blur', function() {
            this.nextElementSibling.classList.remove('focus');
        });
    </script> --}}

    @yield('script')
</body>

</html>
