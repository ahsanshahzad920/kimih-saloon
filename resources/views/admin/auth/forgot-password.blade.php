
@extends('admin.auth.layout.app')
@section('title', 'Login')
@section('content')
<section class="signup position-relative">
    <div class="right-down-arrow">
      <img src="{{asset('assets/dasheets/img/Ellipse.png')}}" class="img-fluid" alt="" />
    </div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 col-12 position-relative signup-img">
          <img
            src="{{asset('assets/dasheets/img/login.svg')}}"
            class="img-fluid text-center align-items-center p-4 py-5"
            alt=""
          />
        </div>
        <div class="col-md-6 col-12 px-4 py-5">
          <div class="signup-form text-white my-5">
            <div class="mb-5">
              <h2>Reset Password</h2>
              <p>Enter a secure password to protect your account</p>
            </div>
            <form class="signup-input">
              <div class="password-container">
                <input
                  type="password"
                  id="password"
                  class="password-input form-control subheading"
                  placeholder="Password"
                />
                <img
                  src="dasheets/img/lock.svg"
                  class="password-toggle pe-2"
                  onclick="togglePasswordVisibility('password')"
                  alt=""
                />
              </div>
              <div class="password-container">
                <input
                  type="password"
                  id="password"
                  class="password-input form-control subheading"
                  placeholder="Retype Password"
                />
                <img
                  src="dasheets/img/lock.svg"
                  class="password-toggle pe-2"
                  onclick="togglePasswordVisibility('password')"
                  alt=""
                />
              </div>
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
