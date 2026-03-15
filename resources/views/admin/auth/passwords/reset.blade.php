@extends('admin.auth.layout.app')
@section('title', 'Login')
@section('content')
    <section class="signup position-relative">
        <div class="right-down-arrow">
            <img src="{{ asset('back/assets/dasheets/img/Ellipse.png') }}" class="img-fluid" alt="" />
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
                            <p>Enter a secure password to protect your account</p>
                        </div>
                        <form class="signup-input" method="POST" action="{{ route('password.store') }}">
                            {{-- @method('PUT') --}}
                            @csrf
                            {{-- @include('back.layout.errors') --}}
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <div class="password-container">
                                <input type="email" id="email"
                                    class="password-input form-control subheading @error('email') is-invalid @enderror"
                                    name="email" placeholder="Email" value="{{ $request->email ?? old('email') }}" required
                                    autocomplete="email" autofocus readonly />
                                <img src="dasheets/img/lock.svg" class="password-toggle pe-2"
                                    onclick="togglePasswordVisibility('password')" alt="" />
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="password-container">
                                <input type="password" id="password"
                                    class="password-input form-control subheading @error('password') is-invalid @enderror"
                                    placeholder="Password" name="password" />
                                <img src="dasheets/img/lock.svg" class="password-toggle pe-2"
                                    onclick="togglePasswordVisibility('password')" alt="" />
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="password-container">
                                <input type="password" id="password_confirmation"
                                    class="password-input form-control subheading" placeholder="Retype Password"
                                    name="password_confirmation" />
                                <img src="dasheets/img/lock.svg" class="password-toggle pe-2"
                                    onclick="togglePasswordVisibility('password')" alt="" />
                            </div>
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <button class="btn btn btn-success add-btn p-3 w-100 mt-4">
                                Reset Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
