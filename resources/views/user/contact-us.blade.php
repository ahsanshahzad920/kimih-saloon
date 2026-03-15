@extends('user.layouts.app')

@section('title', 'Home')
@section('styles')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" /> --}}
@endsection
@section('styles')

    <style>
        .ui-auticomplete {
            width: 440px !important;
            z-index: 99999999999999999999999999999999999;
        }
    </style>
@endsection
@section('content')


    <div class="inner-banner contact-page">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-12 mx-auto text-center">
                    <div class="inner-title">
                        <h3 class="text-white">Contact Us</h3>
                        <ul class="text-white">
                            <li>
                                <a href="/" class="text-white">Home</a>
                            </li>
                            <li class="text-white">Contact Us</li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="contact-widget-area pb-70">
                <div class="container">
                    <div class="contact-widget-max">
                        <div class="contact-form">
                            <div class="section-title text-center">
                                <h2 class="text-white">Do You’ve Any Question?</h2>
                            </div>
                            <form id="contactForm" action="{{ route('contact-us.store') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group shadow-sm">
                                            <input type="text" name="name" id="name" class="form-control"
                                                required data-error="Please Enter Your Name" placeholder="Name">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group shadow-sm">
                                            <input type="email" name="email" id="email" class="form-control"
                                                required data-error="Please Enter Your Email" placeholder="Email">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group shadow-sm">
                                            <input type="text" name="phone" id="phone" required
                                                data-error="Please Enter Your number" class="form-control"
                                                placeholder="Phone Number">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group shadow-sm">
                                            <input type="text" name="subject" id="subject" class="form-control"
                                                required data-error="Please Enter Your Subject" placeholder="Your Subject">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group shadow-sm">
                                            <textarea name="message" class="form-control" id="message" cols="30" rows="7" required
                                                data-error="Write your message" placeholder="Your Message"></textarea>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="agree-label">
                                            <input type="checkbox" id="chb1" checked>
                                            <label for="chb1" class="text-dark"> Accept <a href="#"
                                                    class="text-dark">Terms & Conditions</a> And <a href="#"
                                                    class="text-dark">Privacy Policy.</a>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <button type="submit" class="default-btn"> Send Message </button>
                                        <div id="msgSubmit" class="h3 hidden"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script src="assets/js/jquery.min.js"></script>
{{-- <script src="assets/js/plugins.js"></script> --}}
@endsection
