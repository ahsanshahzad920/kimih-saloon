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
        @media(max-width: 576px){
            .youtube-video{
            width: 325px !important;
            }
            }

        @media(max-width: 576px){
           .banner-item{
              padding-bottom: 0 !important;
           }
        }

    </style>
@endsection
@section('content')

    <section class="banner-area-three">
        <div class="banner  ">
            <div class="banner-item">
                <div class="container-fluid">
                    <div class="banner-content " data-aos="fade-down" data-aos-duration="3000">

                        <h1>{{ $home->home_title ?? 'Book beauty & <br> wellness services' }} </h1>
                        <!--    <a href="#" class="learn-btn">Learn More <i class="flaticon-arrow-pointing-to-right"></i>
                                                            </a> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="banner-form-area " data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="3000">
        <div class="container">
            <div class="banner-form">
                <form action="{{ route('shop.search') }}" method="GET">
                    <div class="row g-3 align-items-end">
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="form-group form-group-list">
                                <div class="from-icon">
                                    <i class="flaticon-user"></i>
                                </div>
                                <label>Any treatment or venue <i class="flaticon-arrow-down-sign-to-navigate"></i>
                                </label>

                                <select class="form-control" name="service">
                                    <option disable value="">Please Select</option>
                                    @foreach ($serviceCategory as $serviceCategory)
                                        <option value="{{ $serviceCategory->name }}">{{ $serviceCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="form-group form-group-list">
                                <div class="from-icon">
                                    <i class="flaticon-pin"></i>
                                </div>
                                <label>Current Location <i class="flaticon-arrow-down-sign-to-navigate"></i>
                                </label>
                                <input type="text" class="form-control" name="location" id="addressInput"
                                    placeholder="Type location" autocomplete="off">
                                <div id="suggestionsContainer"></div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="form-group form-group-list">
                                <div class="from-icon">
                                    <i class="flaticon-booking-1"></i>
                                </div>
                                <label>Any Date <i class="flaticon-arrow-down-sign-to-navigate"></i>
                                </label>
                                <input type="text" id="datetimepicker" class="form-control form-control-bg"
                                    data-error="Please Enter Date" placeholder="December 28, 2021">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="form-group form-group-list">
                                <div class="from-icon">
                                    <i class="flaticon-clock"></i>
                                </div>
                                <label>Any Time <i class="flaticon-arrow-down-sign-to-navigate"></i>
                                </label>
                                <input type="time" class="form-control form-control-bg" data-error="Please Enter Time"
                                    placeholder="Enter Time">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="lat" id="lat">
                    <input type="hidden" name="lon" id="lon">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-12 mx-auto mt-3">
                            <button type="submit" class="default-btn w-100"> Book Now <i class="flaticon-booking"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </section>

    {{-- Stores  --}}
    <section class="services-area ptb-100 mt-0 mt-md-5 pt-0 pt-md-5">
        <div class="container">
            <div class="section-title mb-45 text-center" data-aos="fade-up" data-aos-duration="800">
                <span>Best For you</span>
                <h2>Recommended</h2>

            </div>
            <div class="row">
                @foreach ($users as $user)
                    <div class="col-lg-4 col-sm-6 col-12 col-container">
                        <div class="services-card">
                            <a href="{{ route('shop.details', $user->businessUser->slug ?? '') }}">
                                <img src="{{ isset($user->businessUser->images[0]) ? asset('storage/' . $user->businessUser->images[0]['image']) : asset('assets/images/shope.png') }}"
                                    alt="{{ $user->businessUser->business_name ?? 'Salon' }}" loading="lazy" />
                            </a>
                            <div class="content">
                                <h3><a
                                        href="{{ route('shop.details', $user->businessUser->slug ?? '') }}">{{ $user->businessUser->business_name }}</a>
                                </h3>
                                @if ($user->feedback->count() > 0)
                                    <p class="mb-0">{{ number_format($user->feedback()->avg('rating'), 1) }} <i class="flaticon-star mt-1"></i> ({{ $user->feedback->count() }})</p>
                                @else
                                    <p class="mb-0 text-muted">New</p>
                                @endif
                                <p>{{ $user->businessUser->city ?? '' }} {{$user->businessUser->city != null ? ',':''}}
                                    {{ $user->businessUser->country ?? '' }}</p>
                                <a href="{{ route('shop.details', $user->businessUser->slug ?? '') }}" class="more-btn">
                                    <i class="flaticon-arrow-pointing-to-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-lg-12 text-center mt-20">
                    <a href="{{ route('shop.search') }}" class="default-btn two border-radius-5">View All Shops <i
                            class="flaticon-arrow-pointing-to-right"></i></a>
                </div>
                {{-- <div class="col-lg-12 text-center mt-20">
                    <a href="{{ route('services.list') }}" class="default-btn two border-radius-5">See All Service <i
                            class="flaticon-arrow-pointing-to-right"></i></a>
                </div> --}}
            </div>

        </div>
    </section>

    <section class="about-area section-bg pt-100 pb-70">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-12" data-aos="fade-right" data-aos-duration="800">
                    <div class="about-img-three mr-20">
                        <img class="rounded img-fluid"
                            src="{{ isset($home->section1_image) ? asset($home->section1_image) : asset('assets/images/shope4.png') }}"
                            alt="{{ $home->section1_title ?? 'About Kimih' }}" loading="lazy" />

                    </div>
                </div>
                <div class="col-lg-6 col-12" data-aos="fade-left" data-aos-duration="800">
                    <div class="about-content about-content-max">
                        <div class="section-title">

                            <h2>{{ $home->section1_title ?? '' }}</h2>
                            <p style="text-align: justify;">
                                {{ $home->section1_desc ?? '' }}
                            </p>

                        </div>
                        <a href="{{ route('blogs.show.front') }}" class="default-btn">Learn More <i
                                class="flaticon-arrow-pointing-to-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <section class="intro-video-bg2 ptb-100">
        <div class="container">
            <div class="video-content-two-bg">
                {{-- <a href="{{ $home->section2_video_link ?? 'www.youtube.com' }}" class="play-btn">
                    <i class="ri-play-fill"></i>
                </a> --}}
                @php
                    $videoLink = $home->section2_video_link ?? '';
                    if (strpos($videoLink, 'watch?v=') !== false) {
                        $videoLink = str_replace('watch?v=', 'embed/', $videoLink);
                    }
                @endphp

                <!-- <iframe class="youtube-video" width="560" height="315" src="{!! $videoLink !!}" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe> -->
                <a href="{{$videoLink??'https://www.youtube.com/watch?v=Zd00oIDAt60'}}" target="_blank" class="play-btn" style="margin: 60px 0;">
                    <i class="ri-play-fill"></i>
                </a>

                <div class="section-title text-center" data-aos="zoom-in" data-aos-duration="800">
                    <span>You're Welcomed!</span>
                    <h2>{{ $home->section2_title ?? 'We Care About Your Nail And Your well-Being' }}</h2>
                </div>
                <div class="top-vector" data-aos="fade-left" data-aos-delay="300" data-aos-duration="500">
                    <img src="assets/images/video/video-vector2.png" alt="Video" />
                </div>
                <div class="bottom-vector" data-aos="fade-right" data-aos-delay="300" data-aos-duration="500">
                    <img src="assets/images/video/video-vector1.png" alt="Video" />
                </div>
            </div>
        </div>
    </section>

    {{-- Feedback Section --}}
    <section class="testimonial-area section-bg ptb-100">
        <div class="container">
            <div class="section-title mb-45 text-center" data-aos="fade-up" data-aos-duration="800">
                <span>Our Testimonial</span>
                <h2>What Our Clients Feedback</h2>
            </div>
            <div class="testimonial-slider-three owl-carousel owl-theme">
                @forelse ($feedbacks as $feedback)
                    <div class="testimonial-card">
                        <div class="testimonial-img">
                            <img src="{{ isset($feedback->image) ? asset($feedback->image) : asset('assets/images/testimonial/testimonial-img1.jpg') }}"
                                alt="{{ $feedback->name ?? 'Client' }}" loading="lazy" style="max-width: 130px;" />
                            <i class="flaticon-quote"></i>
                        </div>
                        <div class="content">
                            <p>{{ $feedback->feedback ?? 'Feedback' }}</p>
                            <h3>{{ $feedback->name ?? 'Name' }}
                            </h3>
                            <div class="rating">
                                @for ($i = 0; $i < $feedback->rating; $i++)
                                    <i class="ri-star-fill"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="testimonial-card">
                        <div class="testimonial-img">
                            <img src="assets/images/testimonial/testimonial-img1.jpg" alt="Testimonial" />
                            <i class="flaticon-quote"></i>
                        </div>
                        <div class="content">
                            <p>Pellentesque habitant morbi tristique senectus netu et pell malesuada fames ac turpis egestas
                                vestibulu tortor quam feugiat vit tristique senectus</p>
                            <h3>Emanuele Ebrew <span>/Senior Manager</span>
                            </h3>
                            <div class="rating">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-line"></i>
                                <i class="ri-star-line"></i>
                            </div>
                        </div>
                    </div>
                @endforelse

            </div>
        </div>
    </section>

    {{-- <section class="home-status">
        <div class="container">
            <h5>The top-rated destination for beauty and wellness</h5>
            <p>One solution, one software. Trusted by the best in the beauty and wellness industry</p>
            <h1>5 Billion+</h1>
            <p>Appointments booked on Kimih</p>
            <div class="row">
                <div class="col-lg-4 mt-5">
                    <h5>580,000+</h5>
                    <h6>partner businesses</h6>
                </div>
                <div class="col-lg-4  mt-5">
                    <h5>98+ countries</h5>
                    <h6>using Kimih </h6>
                </div>
                <div class="col-lg-4  mt-5">
                    <h5>150,000+</h5>
                    <h6>stylists and professionals</h6>
                </div>
            </div>
        </div>
    </section> --}}
    {{-- <section class="for-business">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h1>{{ $home->last_section_title ?? 'Title' }}</h1>
                    <p> {{ $home->last_section_desc ?? 'Description' }}</p>
                    <button class="default-btn mt-2">Learn more</button>
                    <h5 class="mt-3">Excellent 5/5</h5>
                    <h6><i class="flaticon-star mx-1"></i><i class="flaticon-star mx-1"></i><i
                            class="flaticon-star mx-1"></i><i class="flaticon-star mx-1"></i><i
                            class="flaticon-star mx-1"></i></h6>

                </div>
                <div class="col-lg-6">
                    <img class="img-fluid"
                        src="{{ isset($home->last_section_image) ? asset($home->last_section_image) : asset('assets/images/dashboard.jpg') }}">
                </div>
            </div>
        </div>
    </section> --}}
@endsection

@section('top-scripts')

    <script src="{{ asset('assets/js/contact-form-script.js') }}" type="text/javascript"></script>

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            var suggestionsContainer = $("#suggestionsContainer");
            $("#addressInput").autocomplete({
                source: function(request, response) {
                    var searchTerm = request.term;
                    performAddressSearch(searchTerm, response);
                },
                minLength: 1,
                select: function(event, ui) {
                    $("#addressInput").val(ui.item.value);
                    var selectedAddress = ui.item.value;
                    console.log("location:" + ui.item.latitude + " long:" + ui.item.longitude);
                    // getCoordinates(selectedAddress);

                    event.preventDefault();
                },
                appendTo: "#suggestionsContainer"
            }).autocomplete("instance")._renderItem = function(ul, item) {
                return $("<li>").append("<div>" + item.label + "</div>").appendTo(ul);
            };


            function performAddressSearch(searchTerm, response) {
                console.log("perfome");
                var apiUrl = "https://nominatim.openstreetmap.org/search?format=json&limit=10&q=" +
                    encodeURIComponent(
                        searchTerm);
                $.ajax({
                    url: apiUrl,
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        var suggestions = [];
                        for (var i = 0; i < data.length; i++) {
                            suggestions.push({
                                value: data[i].display_name,
                                label: data[i].display_name,
                                latitude: parseFloat(data[i].lat),
                                longitude: parseFloat(data[i].lon),
                            });
                        }

                        response(suggestions);
                    },
                    error: function() {}
                });
            }

            $("#addressInput").on('autocompleteselect', function(event, ui) {
                var latitude = ui.item.latitude;
                var longitude = ui.item.longitude;
                $("#lat").val(latitude);
                $("#lon").val(longitude);
            });


        });
    </script>
@endsection
