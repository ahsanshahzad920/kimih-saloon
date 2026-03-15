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
                                    <p class="m-2 fs-2"><a href="{{ route('auth-for-business') }}" class="text-brand"><i
                                                class="las la-arrow-left"></i></a></p>
                                    <div class="col-lg-7 py-5 mx-auto">
                                        <div class="text-center">
                                            <img class="img-fluid mb-3" style="width:200px"
                                                src="{{ asset('assets/images/logo.png') }}"alt="Logo">
                                            <h5 class="text-brand">Kimih for Business </h5>
                                            <p class="text-muted" id="createP">Create an account or log in to manage your
                                            Kimih business. </p>
                                            <h6 class="text-brand" id="spanName" style="display: none">Welcome back to your
                                                business account, ahsan </h6>
                                            <p class="" id="spanEmailp" style="display: none">Enter your password to
                                                log in as <span class="fw-bold" id="spanEmail"></span></p>
                                        </div>

                                        <div class="mt-4" id="toggleDiv">

                                            <form class="needs-validation" id="form1">
                                                <div class="mb-3">

                                                    <input type="email" class="form-control" id="useremail" name="email"
                                                        placeholder="Enter email address" required>
                                                    <div class="invalid-feedback" id="invalid-email">
                                                        Invalid email
                                                    </div>
                                                </div>
                                                <button class="default-btn w-100 mb-4" type="submit"
                                                    id="continue">Continue</button>
                                                <h6 class=" center-devider py-1"><span>OR</span></h6>
                                                <div class="loginWith">
                                                    <button type="button" class=" waves-effect waves-light"><a
                                                            href="/socialite/facebook/business" class="text-dark"><img
                                                                class="img-fluid"
                                                                src="{{ asset('dash-assets/images/facebook.svg') }}">
                                                            </i>Continue with Facebook</a></button>
                                                    <button type="button" class=" waves-effect waves-light"><a
                                                            href="/socialite/google/business" class="text-dark"><img
                                                                class="img-fluid"
                                                                src="{{ asset('dash-assets/images/google.svg') }}">Continue
                                                            with Google
                                                        </a></button>
                                                    {{-- <button type="button" class=" waves-effect waves-light"><a
                                                            href="/socialite/apple/business" class="text-dark"><img
                                                                class="img-fluid"
                                                                src="{{ asset('dash-assets/images/apple.svg') }}">Continue
                                                            with
                                                            Apple</a></button> --}}

                                                </div>
                                                <h5 class="text-center mt-5">Customer booking?</h5>
                                                <p class="text-center">If you are a customer wishing to book a service</p>
                                                <p class="text-center"><a href="/auth/for-customer"
                                                        class="fw-semibold text-primary text-decoration-underline"> Sign up
                                                        as a customer</a> </p>
                                            </form>

                                            {{-- <form class="needs-validation" id="form2">
                                                <div class="mb-3">

                                                    <input type="password" class="form-control" id="password" name="password"
                                                        placeholder="Enter a password" required>
                                                    <input type="hidden" name="email" id="email">
                                                    <div class="invalid-feedback">
                                                        Please enter email
                                                    </div>
                                                    <a href="">Forgot Your Password?</a>
                                                </div>
                                                <button class="default-btn w-100 mb-4" type="submit"
                                                    id="continue">Login</button>

                                            </form> --}}
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
    <script>
        $(document).ready(function() {
            $('#form1').on('submit', function(e) {
                e.preventDefault();
                var emailValue = $('#useremail').val();

                if (emailValue == '') {
                    alert('Please enter email');
                    return false;
                }
                // $('#continue').text('Please wait...');
                $('#continue').html(
                    '<div class="spinner-border  spinner-border-sm text-light" role="status"><span class="visually-hidden">Loading...</span></div>'
                );
                $.ajax({
                    url: "{{ route('user-account') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        email: emailValue,
                    },
                    success: function(response) {
                        // console.log(response.email);
                        if (response.status == 200) {
                            if (response.role == 'Business User' || response.role == 'Admin') {
                                $('#spanEmail').text(response.email);
                                $('#createP').hide();
                                $('#spanName').show();
                                $('#spanEmailp').show();
                                $('#spanName').text('Welcome back to your business account, ' +
                                    response.name);
                                // $('#email').val(response.email);
                                $('#toggleDiv').html(
                                    `<form class="needs-validation" id="form2"><div class="mb-3"><input type="password" class="form-control" id="password" name="password" placeholder="Enter a password" required><input type="hidden" name="email" id="email" value="${response.email}"><div class="invalid-feedback">Please enter email</div><a href="">Forgot Your Password?</a></div><button class="default-btn w-100 mb-4" type="submit" id="login">Login</button></form>`
                                );
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    // title: 'Success!',
                                    text: 'This email have different role. Please change it',
                                });
                            }

                        } else {
                            $('#invalid-email').show();

                            // window.location.href = {{ route('auth-business-sign-up') }}+`/${emailValue}`
                            window.location.href = `/auth/sign-up/for-business/${emailValue}`;
                        }
                        // Handle the response here
                    },
                    error: function(xhr, status, error) {
                        // Handle errors here
                        // console.error(error);
                        // console.log(xhr.responseText);
                    },
                    complete: function() {
                        $('#continue').html('Continue');

                    }
                });
            });
            $(document).on('submit', '#form2', function(e) {
                e.preventDefault();

                var emailValue = $('#email').val();
                var password = $('#password').val();

                if (password == '' || emailValue == '') {
                    alert('Please fill all fields');
                    return false;
                }
                $('#login').html(
                    '<div class="spinner-border  spinner-border-sm text-light" role="status"><span class="visually-hidden">Loading...</span></div>'
                );

                $.ajax({
                    url: "{{ route('login-user') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        email: emailValue,
                        password,

                    },
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                text: 'You have successfully logged in.',
                                showConfirmButton: false,
                                timer: 1000
                            });
                            window.location.href = response.redirect;
                        } else {
                            alert(response.error);
                        }
                    },
                    error: function(xhr) {
                        // Parse the JSON response
                        var response = JSON.parse(xhr.responseText);

                        // Check if the error message is available and display it
                        if (response.error) {
                            Swal.fire({
                                icon: 'error',
                                // title: 'Success!',
                                text: 'Invalid password. Please try again.',
                            })
                        } else {
                            alert('An unexpected error occurred.');
                        }
                    },
                    complete: function() {
                        $('#login').html('Login');
                    }
                });
            });
        });
    </script>
@endsection
