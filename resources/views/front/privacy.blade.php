@extends('user.layouts.app')

@section('content')
<!--     <div class="inner-banner">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-12 text-center">
                    <div class="inner-title">
                        <h3>Privacy Policy</h3>
                        <ul>
                            <li>
                                <a href="/">Home</a>
                            </li>
                            <li>Privacy Policy</li>
                        </ul>
                    </div>
                </div>
                 <div class="col-lg-4 col-md-5">
                                                    <div class="inner-img">
                                                      <img src="assets/images/faq.png" alt="Inner Banner" />
                                                    </div>
                                                  </div> 
            </div>
        </div>
    </div> -->
    <div class="privacy-policy-area pt-100 pb-70">
        <div class="container">
            <div class="row pt-45">
                <div class="col-lg-12">
                    <div class="single-content">
                        {!! settings()->privacy_policy ?? '' !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
