@extends('admin.auth.layout.app')
@section('title', 'Login')
@section('content')

    {{-- <section id="signup" class="signup">
        <div class="container">
            <div class="signup-form">
                <div>
                    <h2 class="text-center">Sign In</h2>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <label for="inputEmail">Email</label>
                        <input class="form-control  @error('email') is-invalid @enderror" name="email" id="inputEmail"
                            type="email" placeholder="name@example.com" />
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div>
                        <label for="inputPassword">Password</label>
                        <input class="form-control  @error('password') is-invalid @enderror" name="password"
                            id="inputPassword" type="password" placeholder="Password" />
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row keep-me-logged">
                        <div class="col-md-7 col-6 mt-3">
                            <input class="form-check-input" id="inputRememberPassword" type="checkbox"
                                        value="" />
                                    <label class="form-check-label" for="inputRememberPassword">Remember
                                        Password</label>
                        </div>

                        <div class="col-md-5 col-6 mt-3 exist">
                            <a class="small text-decoration-none forget-btn" href="#">Forgot
                                Password?</a>
                        </div>
                    </div>

                    <button class="btn btn btn-success add-btn w-100 mt-3 rounded-5">Sign In</button>

                    <div class="exist mt-3">
                        <p class="exist">Not registered yet? <a href="{{route('register')}}" class="text-decoration-none">Create
                                Account</a></p>
                    </div>

                    <div class="or">
                        <p class="text-center">or</p>
                    </div>

                    <div>
                        <button class="btn create-btn w-100 rounded-5">
                            <img src="{{ asset('back/assets/dasheets/img/google.png') }}" class="pe-2"
                                alt="" />Sign
                            in with Google
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section> --}}

    {{-- <div>
        <section class="signup position-relative">
            <div class="right-down-arrow">
                <img src="{{ asset('assets/dasheets/img/Ellipse.png') }}" class="img-fluid" alt="" />
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-12 position-relative signup-img">
                        <img src="{{ asset('assets/dasheets/img/login.svg') }}"
                            class="img-fluid text-center align-items-center py-5" alt="" />
                    </div>
                    <div class="col-md-6 col-12 py-5 px-4">
                        <div class="signup-form text-white my-5">
                            <div class="mb-5">
                                <h2>Sign in</h2>
                                <p>Please enter your credentials</p>
                            </div>
                            <form class="signup-input" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="password-container">
                                    <input type="email"
                                        class="form-control @error('email') border border-danger @enderror"
                                        placeholder="Email" name="email" required />

                                    <img src="{{ asset('assets/dasheets/img/mail.svg') }}" class="password-toggle pe-2"
                                        alt="" />

                                </div>
                                @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="password-container">
                                    <input type="password" id="password"
                                        class="password-input form-control subheading @error('password') border border-danger @enderror"
                                        placeholder="Password" name="password" />

                                    <img src="{{ asset('assets/dasheets/img/lock.svg') }}" class="password-toggle pe-2"
                                        onclick="togglePasswordVisibility('password')" alt="" />
                                </div>
                                @error('password')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="row text-white keep-me-logged">
                                    <div class="col-md-6 d-flex mt-3">
                                        <input type="checkbox" class="checkboxing" name="" id="" />
                                        <span>Keep me signed in</span>
                                    </div>

                                    <div class="col-md-6 mt-3 forget-password text-end">
                                        <a href="{{ route('password.request') }}" class="text-decoration-none text-white">
                                            Forgot Password? </a>
                                    </div>
                                </div>
                                <button class="btn btn btn-success add-btn p-3 w-100 mt-4">
                                    Sign In
                                </button>

                                <div>
                                    <a  href="/socialite/google"  class="btn btn-light w-100 rounded-5 mt-2">
                                        <img src="{{ asset('back/assets/dasheets/img/google.png') }}" class="pe-2"
                                            alt="" />Sign in with Google <i class="bi bi-google"></i>
                                    </a>
                                </div>
                                <div>
                                    <a  href="/socialite/facebook"  class="btn btn-light w-100 rounded-5 mt-2">
                                        <img src="{{ asset('back/assets/dasheets/img/google.png') }}" class="pe-2"
                                            alt="" />Sign in with Facebook <i class="bi bi-facebook"></i>
                                    </a>
                                </div>
                                <div>
                                    <a  href="/socialite/github"  class="btn btn-light w-100 rounded-5 mt-2">
                                        <img src="{{ asset('back/assets/dasheets/img/google.png') }}" class="pe-2"
                                            alt="" />Sign in with Github <i class="bi bi-github"></i>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Template Javascript -->
        <script src="dasheets/js/main.js"></script>
    </div> --}}

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
                                                            href="/socialite/facebook" class="text-dark"><img
                                                                class="img-fluid" src="dash-assets/images/facebook.svg">
                                                            </i>Continue with Facebook</a></button>
                                                    <button type="button" class=" waves-effect waves-light"><a
                                                            href="/socialite/google" class="text-dark"><img
                                                                class="img-fluid"
                                                                src="dash-assets/images/google.svg">Continue with Google
                                                        </a></button>
                                                    <button type="button" class=" waves-effect waves-light"><a
                                                            href="/socialite/apple" class="text-dark"><img class="img-fluid"
                                                                src="dash-assets/images/apple.svg">Continue with
                                                            Apple</a></button>

                                                </div>
                                                <h5 class="text-center mt-5">Customer booking?</h5>
                                                <p class="text-center">If you are a customer wishing to book a service</p>
                                                <p class="text-center"><a href="auth-signin-cover.html"
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
                                    <img src="dash-assets/images/signup.jpg" class="img-fluid h-100">
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
                $('#continue').html('<div class="spinner-border  spinner-border-sm text-light" role="status"><span class="visually-hidden">Loading...</span></div>');
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
                            $('#invalid-email').show();
                        }
                        // Handle the response here
                    },
                    error: function(xhr, status, error) {
                        // Handle errors here
                        // console.error(error);
                        // console.log(xhr.responseText);
                    },
                    complete: function(){
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
                $('#login').html('<div class="spinner-border  spinner-border-sm text-light" role="status"><span class="visually-hidden">Loading...</span></div>');

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
                    complete: function(){
                        $('#login').html('Login');
                    }
                });
            });
        });
    </script>
@endsection
