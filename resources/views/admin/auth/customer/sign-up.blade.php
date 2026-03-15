@extends('admin.auth.layout.app')
@section('title', 'Login')
@section('content')


    <!-- auth-page wrapper -->
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
                                    <p class="m-2 fs-2"><a href="{{ route('auth-for-customer') }}" class="text-brand"><i
                                                class="las la-arrow-left"></i></a></p>
                                    <div class="col-lg-7 py-5 mx-auto">
                                        <div class="text-center">

                                            <h3 class="text-brand">
                                                Create a customer account
                                            </h3>
                                            <p class="text-muted" id="createP">You’re almost there! Create your new
                                                account for <span class="fw-bold">{{ request()->email }}</span> by
                                                completing these details. </p>
                                            <h6 class="text-brand" id="spanName" style="display: none">Welcome back to your
                                                customer account </h6>
                                        </div>

                                        <div class="mt-4" id="toggleDiv">

                                            <form class="needs-validation" method="POST"
                                                action="{{ route('auth-customer-sign-up') }}">
                                                @csrf
                                                <div class="mb-2">
                                                    <label for="">Name</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        placeholder="Enter your name" required>

                                                    {{-- <div class="invalid-feedback" id="invalid-email">
                                                        Invalid email
                                                    </div> --}}
                                                </div>
                                                <div class="mb-2">
                                                    <label for="">Email</label>
                                                    <input type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        id="useremail" name="email" value="{{ request()->email }}"
                                                        placeholder="Enter email address" required>
                                                    <span class="text-danger">
                                                        @error('email')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="">Password</label>
                                                    <input type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        id="useremail" name="password" placeholder="Choose strong password"
                                                        required>
                                                    <span class="text-danger">
                                                        @error('password')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="">Mobile Number</label>
                                                    <input type="text"
                                                        class="form-control @error('phone') is-invalid @enderror"
                                                        id="phone" name="phone" placeholder="e.g. +971501234567"
                                                        required>
                                                    <span class="text-danger">
                                                        @error('phone')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="">Country</label>
                                                    <input type="text"
                                                        class="form-control @error('country') is-invalid @enderror"
                                                        id="country" name="country" placeholder="" required>
                                                </div>
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="checkbox" name="policy"
                                                        value="1" id="policy" checked required>
                                                    <label class="form-check-label" for="policy">
                                                        I agree to the <a href="{{ route('privacy.index') }}">Privacy
                                                            Policy</a>,
                                                        <a href="{{ route('term_of_service.index') }}">Term of Service and
                                                            Terms of Business</a>.
                                                    </label>
                                                </div>
                                                <button class="default-btn w-100 mb-4" type="submit"
                                                    id="continue">Continue</button>

                                            </form>

                                        </div>

                                        <!--  <div class="mt-5 text-center">
                                                                    <p class="mb-0">Already have an account ? <a href="auth-signin-cover.html" class="fw-semibold text-primary text-decoration-underline"> Signin</a> </p>
                                                                </div> -->
                                    </div>
                                </div>
                                <div class="col-lg-6">
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
    <!-- end auth-page-wrapper -->


@endsection

@section('script')

@endsection
