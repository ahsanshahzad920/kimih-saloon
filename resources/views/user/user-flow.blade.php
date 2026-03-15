@extends('admin.auth.layout.app')
{{-- @section('title', 'user-flow') --}}

@section('content')
    <div class="auth-page-wrapper d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        <div class="auth-page-content ">
            <div class="">
                <div class="row mx-0 gx-0">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden m-0">
                            <div class="row  g-0 h-100">

                                <div class="col-lg-6">
                                    <p class="m-2 fs-2"><a href="/" class="text-brand"><i
                                                class="las la-arrow-left"></i></a></p>
                                    <div class="col-lg-7 py-5 mx-auto">

                                        <div class="text-center">
                                            <img class="img-fluid mb-3" style="width:200px"
                                                src="assets/images/logo.png"alt="Logo">
                                            <h4 class="text-brand mb-3"> Sign up/log in </h4>
                                            <p class="text-muted">Create an account or log in to manage your Kimih
                                                business.</p>
                                        </div>

                                        <div class="login-option mt-4">
                                            <a href="{{ route('auth-for-customer') }}">
                                                <button class="">
                                                    <span>
                                                        For everyone <br>
                                                        Book salons and spas near you
                                                    </span>
                                                    <i class="las la-arrow-right fs-2"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('auth-for-business') }}">
                                                <button class="">
                                                    <span>
                                                        For business <br>
                                                        Manage and grow your business
                                                    </span>
                                                    <i class="las la-arrow-right fs-2"></i>
                                                </button>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    {{-- <img src="{{asset('assets/images/login-bg.png')}}" class="img-fluid h-100"> --}}
                                    {{-- <img src="{{asset('dash-assets/images/blob-scene-haikei.png')}}" class="img-fluid h-100"> --}}
                                    <img src="{{ asset('assets/images/login-bg.jpg') }}" class="img-fluid h-100">
                                </div>

                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

    </div>
@endsection



@section('script')
    <!-- JAVASCRIPT -->
    <script src="dash-assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dash-assets/libs/simplebar/simplebar.min.js"></script>
    <script src="dash-assets/libs/node-waves/waves.min.js"></script>
    <script src="dash-assets/libs/feather-icons/feather.min.js"></script>
    <script src="dash-assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="dash-assets/js/plugins.js"></script>

    <!-- apexcharts -->
    <script src="dash-assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Vector map-->
    <script src="dash-assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="dash-assets/libs/jsvectormap/maps/world-merc.js"></script>

    <!--Swiper slider js-->
    <script src="dash-assets/libs/swiper/swiper-bundle.min.js"></script>

    <!-- Dashboard init -->
    <script src="dash-assets/js/pages/dashboard-ecommerce.init.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <!-- App js -->
    <script src="dash-assets/js/app.js"></script>
    <script>
        $(".toogler-menu-btn").click(function() {
            $(this).toggleClass("active");
        });
    </script>
@endsection
