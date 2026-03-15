@extends('admin.auth.layout.app')
@section('title', 'Register')
@section('content')

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
                <div class="col-md-6 col-12 px-4">
                    <div class="signup-form text-white">
                        <div class="mb-5">
                            <h2>Sign Up</h2>
                            <p>Create your account to get started</p>
                        </div>
                        <form class="signup-input mt-4" method="POST" action="{{ route('register') }}">
                            @csrf
                            <input type="text" class="form-control subheading" placeholder="Name"
                                id="exampleFormControlInput1" name="name" />
                            @error('name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <div class="password-container">
                                <input type="email" class="form-control" placeholder="Email" required name="email" />
                                <img src="{{ asset('assets/dasheets/img/mail.svg') }}" class="password-toggle pe-2"
                                    alt="" />
                            </div>
                            @error('email')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="password-container">
                                <input type="password" id="password" class="password-input form-control subheading"
                                    placeholder="Password" name="password" />
                                <img src="{{ asset('assets/dasheets/img/lock.svg') }}" class="password-toggle pe-2"
                                    onclick="togglePasswordVisibility('password')" alt="" />
                                @error('password')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="password-container">
                                <input type="password" id="password_confirmation"
                                    class="password-input form-control subheading" placeholder="Retype Password"
                                    name="password_confirmation" />
                                <img src="{{ asset('assets/dasheets/img/lock.svg') }}" class="password-toggle pe-2"
                                    onclick="togglePasswordVisibility('password')" alt="" />
                            </div>
                            @error('password_confirmation')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <button class="btn btn btn-success add-btn p-3 w-100 mt-4">
                                Sign Up
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

@endsection
