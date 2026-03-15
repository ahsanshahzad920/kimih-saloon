@extends('admin.auth.layout.app')
@section('title', 'Email')

@section('content')
    <section class="signup position-relative">
        <div class="right-down-arrow">
            <img src="{{ asset('assets/dasheets/img/Ellipse.png') }}" class="img-fluid" alt="" />
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-12 position-relative signup-img">
                    <img src="{{ asset('assets/dasheets/img/login.svg') }}"
                        class="img-fluid text-center align-items-center p-4 py-5" alt="" />
                </div>
                <div class="col-md-6 col-12 px-4 py-5">
                    <div class="signup-form text-white my-5">
                        <div class="mb-5">
                            <h2>Reset Password</h2>
                            <p>Enter your email for reset password</p>
                        </div>
                        <form class="signup-input" method="POST" action="{{ route('password.email') }}">
                            @csrf
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="password-container">
                                <input type="email" id="email" class="password-input form-control subheading"
                                    placeholder="Email Address" name="email" />
                                <img src="dasheets/img/lock.svg" class="password-toggle pe-2"
                                    onclick="togglePasswordVisibility('password')" alt="" />
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <button class="btn btn btn-success add-btn p-3 w-100 mt-4" type="submit">
                                Send Password Reset Link
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
