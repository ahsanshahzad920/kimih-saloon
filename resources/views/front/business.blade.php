@extends('user.layouts.app')

@section('content')
    <section class="for-business-banner">
        <div class="container">
            <h1>{{ $data->title ?? '' }}</h1>
            <h4>{{ $data->sub_title ?? '' }}</h4>
            <a href="{{ route('user-flow') }}" class="default-btn">Join For free</a>

        </div>

    </section>
    <section class="business-info-img">
        <div class="container">
            <img class="img-fluid" src="{{ asset(Storage::url($data->header_image ?? '')) }}" />
        </div>
    </section>
    {{-- <section class="capterra-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 text-center">
                    <img src="{{ asset(Storage::url($data->capterra_image ?? 'assets/images/capterra.png')) }}"
                        class="img-fluid">
                    <p class="mb-1 mt-3"><i class="flaticon-star"></i> <i class="flaticon-star"></i> <i
                            class="flaticon-star"></i> <i class="flaticon-star"></i> <i class="flaticon-star"></i> <i
                            class="flaticon-star"></i></p>
                    <h6>{{ $data->capterra_rating ?? '' }}/5 on Capterra</h6>
                </div>
                <div class="col-lg-8">
                    <div class="home-demo">
                        <div class="owl-carousel owl-theme">
                            @if (!is_null($data))
                                @foreach (json_decode($data->capterra_review, true) as $review)
                                    <div class="item">
                                        <p>
                                            {{ $review['description'] ?? '' }}
                                        </p>
                                        <h5 class="mt-3">
                                            {{ $review['heading'] ?? '' }}
                                        </h5>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <section class="business-stats section-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h1>{{ $data->top_rating_title ?? '' }}</h1>
                    <p>{{ $data->top_rating_description ?? '' }}</p>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <h4>{{ $data->business_partner_count ?? '' }}</h4>
                            <p>{{ $data->business_partner_title ?? '' }}</p>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <h4>{{ $data->stylists_count ?? '' }}</h4>
                            <p>{{ $data->stylists_title ?? '' }}</p>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <h4>{{ $data->appointmens_count ?? '' }}</h4>
                            <p>{{ $data->appointmens_title ?? '' }}</p>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <h4>{{ $data->countries_count ?? '' }}</h4>
                            <p>{{ $data->countries_title ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="grow-business">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <h1>
                        {{ $featurePage->title ?? '' }}
                    </h1>
                </div>
            </div>
            <h6 class="mb-4 mt-3">
                {{ $featurePage->description ?? '' }}
            </h6>
            <div class="row">
                @forelse ($features as $feature)
                    <div class="col-lg-4 col-container">
                        <div class="card">
                            <div class="card-body">
                                <img class="img-fluid" src="{{ asset(Storage::url($feature->icon ?? '')) }}" />
                                <h4>{{ $feature->title ?? '' }}</h4>
                                <p>
                                    {{ $feature->description ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    No record found
                @endforelse

            </div>
        </div>
    </section>
    @forelse ($businessInfo as $index => $data)
        <section class="business-info-section pt-50">
            <div class="container">
                <div class="row align-items-center">
                    @if ($index % 2 == 0)
                        <div class="offset-lg-1 col-lg-4">
                            <img class="img-fluid"
                                src="{{ $data->image ? asset(Storage::url($data->image)) : asset('path/to/default/image.jpg') }}"
                                alt="Business Image" />
                        </div>
                        <div class="offset-lg-1 col-lg-6">
                            <h2>{{ $data->title ?? 'No Title' }}</h2>
                            <p>{!! $data->description ?? 'No description available.' !!}</p>
                        </div>
                    @else
                        <div class="offset-lg-1 col-lg-6">
                            <h2>{{ $data->title ?? 'No Title' }}</h2>
                            <p>{!! $data->description ?? 'No description available.' !!}</p>
                        </div>
                        <div class="offset-lg-1 col-lg-4">
                            <img class="img-fluid"
                                src="{{ $data->image ? asset(Storage::url($data->image)) : asset('path/to/default/image.jpg') }}"
                                alt="Business Image" />
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @empty
        <p>No record found</p>
    @endforelse


    <section class="testimonial-area section-bg pt-100 pb-70">
        <div class="container">
            <div class="section-title mb-45 text-center">
                <h2>See what our partners say</h2>
            </div>
            <div class="testimonial-slider owl-carousel owl-theme owl-loaded owl-drag">
                <div class="owl-stage-outer owl-height">
                    <div class="owl-stage">
                        @foreach ($feedback as $data)
                            <div class="owl-item ">
                                <div class="testimonial-item">
                                    <img src="{{ isset($feedback->image) ? asset($feedback->image) : asset('assets/images/testimonial/testimonial-img1.jpg') }}"
                                        alt="Testimonial" style="max-width: 130px;">
                                    <h3>{{ $data->name ?? '' }} </h3>
                                    <p>
                                        {{ $data->feedback ?? '' }}
                                    </p>
                                    <div class="rating">
                                        @for ($i = 0; $i < $data->rating; $i++)
                                            <i class="ri-star-fill"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="business-started pt-50 mb-5">
        <div class="container">
            <h1 class="text-center my-4">Pick a business type to get started for free</h1>
            <div class="row mx-lg-5">
                <div class="col-lg-3">
                    <div class="services ">
                        <label>
                            <input type="checkbox" value="1">

                            <span><img src="assets/images/Nail services.svg"> <br>Nail services</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="services ">
                        <label>
                            <input type="checkbox" value="1">

                            <span><img src="assets/images/Haircut-styling.svg"> <br>Haircuts & styling</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="services ">
                        <label>
                            <input type="checkbox" value="1">

                            <span><img src="assets/images/Eyebrows-lashes.svg"> <br>Eyebrows & lashes</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="services ">
                        <label>
                            <input type="checkbox" value="1">

                            <span><img src="assets/images/injection.png"> <br>Injectables & fillers</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="services">
                        <label>

                            <input type="checkbox" value="1">

                            <span> <img src="assets/images/Makeup.svg"><br>Makeup</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="services">
                        <label>
                            <input type="checkbox" value="1">

                            <span><img src="assets/images/Massage.svg"> <br>Massage</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="services">
                        <label>
                            <input type="checkbox" value="1">

                            <span><img src="assets/images/Hair extention.svg"> <br> Hair extensions</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="services">
                        <label>
                            <input type="checkbox" value="1">

                            <span> <img src="assets/images/Hair removel.svg"> <br>Hair removal</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="services">
                        <label>
                            <input type="checkbox" value="1">

                            <span><img src="assets/images/Fitness.svg"> <br>Tattoo & piercing</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="services">
                        <label>
                            <input type="checkbox" value="1">

                            <span><img src="assets/images/Dental.png"> <br>Dental</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="services">
                        <label>
                            <input type="checkbox" value="1">

                            <span><img src="assets/images/tharapy.png"> <br>Therapy </span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="services">
                        <label>
                            <input type="checkbox" value="1">

                            <span><img src="assets/images/spa.png"> <br>Spa</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
