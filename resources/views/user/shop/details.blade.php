@extends('user.layouts.app')

@section('title', 'Shop Details')
@section('styles')
@endsection
@section('content')
    <section class="details-banner">
        <div class="container">
            <h1>{{ $user->businessUser->business_name }}</h1>
            {{-- <h6><span class="me-3"> 5.0 <i class="flaticon-star"></i> <i class="flaticon-star "></i> <i
                        class="flaticon-star"></i> <i class="flaticon-star "> </i> <i
                        class="flaticon-star "></i></span><span>Open until 7:00 pm</span>
                <h6> --}}
            <div class="row">
                {{-- <div class="col-lg-8">
                            <div class="ratio ratio ratio-4x3">
                                <img class="img-fluid w-100" src="{{ asset('assets/images/shope.png') }}">
                            </div>
                        </div> --}}
                <div class="col-lg-8">
                    <div class="ratio ratio ratio-4x3">
                        <img class="img-fluid w-100"
                            src="{{ isset($user->businessUser->images[0]) ? asset('storage/' . $user->businessUser->images[0]['image']) : asset('assets/images/shope.png') }}"
                            alt="Services" />
                    </div>
                </div>
                <div class="col-lg-4">
                    @if (isset($user->businessUser->images[1]))
                        <div class="ratio ratio ratio-4x3 mb-3">
                            {{-- <img class="img-fluid w-100" src="{{ asset('assets/images/shope.png') }}"> --}}
                            <img class="img-fluid w-100"
                                src="{{ isset($user->businessUser->images[1]) ? asset('storage/' . $user->businessUser->images[1]['image']) : asset('assets/images/shope.png') }}"
                                alt="Services" />
                        </div>
                    @endif
                    @if (isset($user->businessUser->images[2]))
                        <div class="ratio ratio ratio-4x3">
                            {{-- <img class="img-fluid w-100" src="{{ asset('assets/images/shope.png') }}"> --}}
                            <img class="img-fluid w-100"
                                src="{{ isset($user->businessUser->images[2]) ? asset('storage/' . $user->businessUser->images[2]['image']) : asset('assets/images/shope.png') }}"
                                alt="Services" />
                        </div>
                    @endif

                </div>
            </div>

    </section>
    <section class="services-booking">
        <div class="container">
            <h4 class="main-title">Services</h4>
            <div class="row">
                <div class="col-lg-8 services-booking-card">
                    @foreach ($services as $service)
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h5>{{ $service->service_name ?? '' }}</h5>
                                        <h6>{{ $service->duration ?? '' }}</h6>
                                        <p>AED {{ $service->price }}</p>
                                    </div>
                                    <div class="col-lg-4 text-end">
                                        <a href="{{ route('shop.services', ['slug' => $user->businessUser->slug]) }}"
                                            class="default-btn">Book
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-4 card-infos">
                    <div class="card">
                        <div class="card-body">
                            <h1>{{ $user->businessUser->business_name ?? '' }}</h1>
                            <h6>
                                {{-- <span class="me-3"> 5.0 <i class="flaticon-star"></i>
                                    <i class="flaticon-star "></i>
                                    <i class="flaticon-star"></i>
                                    <i class="flaticon-star "></i>
                                    <i class="flaticon-star "></i>
                                </span>
                                <span>Open until 7:00 pm</span> --}}

                                <button class="default-btn w-100 my-4" data-bs-toggle="modal"
                                    data-bs-target="#bookingModal">Book Now
                                </button>
                                <a href="/messenger/{{ $user->id }}" class="default-btn w-100">Chat with us
                                </a>
                                <hr>
                                <p>
                                    <i class="flaticon-clock "></i> Closed opens at 9:00 am
                                </p>
                                <p>
                                    <i class="flaticon-pin "></i> {{ $user->businessUser->location }}
                                </p>
                                <p>
                                    <a href="#" class="me-2">Get directions</a>
                                    @php
                                        use App\Models\Feedback;
                                        $feedbackExists = Feedback::where('store_id', $user->id)
                                            ->where('created_by', auth()->id())
                                            // Assuming you have store_id in the user model
                                            ->exists();
                                    @endphp

                                    @auth
                                        @if (!$feedbackExists)
                                            <a href="#" class="text-success text-decoration-none" data-bs-toggle="modal"
                                                data-bs-target="#customerFeedbackModal">
                                                Give Your Feedback
                                            </a>
                                        @endif
                                    @endauth

                                </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="team-area pt-50 pb-70">
            <div class="container">
                <div class="section-title mb-45 text-center">
                    <span>Our Staff</span>
                    <h2>Our Excellent &amp; Expert Staff</h2>
                </div>
                <div class="row justify-content-center">

                    @forelse ($team_members as $team_member)
                        <div class="col-lg-4 col-md-6">
                            <div class="team-card">
                                <div class="team-img">
                                    <a href="team-details.html">
                                        <img src="{{ asset($team_member->image??'/dash-assets/images/users/avatar-1.jpg') }}" alt="Team">
                                    </a>
                                    <ul class="social-links-btn">
                                        <li class="share-btn">
                                            <i class="flaticon-arrow-pointing-to-right"></i>
                                        </li>
                                        <li>
                                            <a href="https://vimeo.com/" target="_blank">
                                                <i class="ri-vimeo-fill"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://twitter.com/" target="_blank">
                                                <i class="ri-twitter-fill"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.linkedin.com/" target="_blank">
                                                <i class="ri-linkedin-fill"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.facebook.com/" target="_blank">
                                                <i class="ri-facebook-fill"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="content">
                                    <h3>
                                        <a href="#"> {{ $team_member->name ?? 'Name' }} </a>
                                    </h3>
                                    <span>{{ $team_member->job_title ?? 'Job Title' }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="fw-bold mt-3 text-center">No Record Found!</div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
    <section class="testimonial-area section-bg ptb-100">
        <div class="container">
            <div class="section-title mb-45 text-center">
                <span>Our Testimonial</span>
                <h2>What Our Clients Feedback</h2>
            </div>
            <div class="testimonial-slider-three owl-carousel owl-theme">
                @forelse ($feedbacks as $feedback)
                    <div class="testimonial-card">
                        <div class="testimonial-img">
                            <img src="{{ isset($feedback->image) ? asset($feedback->image) : asset('assets/images/testimonial/testimonial-img1.jpg') }}"
                                alt="Testimonial" style="max-width: 130px;
                        " />
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
    <section class="about-us-details">
        <div class="container">
            <h1>About Us</h1>
            <p>{{ $user->businessUser->about_us ??
                'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                                                                                                                                                                                                                                                                                                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                                                                                                                                                                                                                                                                                                                ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                                                                                                                                                                                                                                                                                                                nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                                                                                                                                                                                                                                                                                                                anim id est laborum.' }}
            </p>

            {{-- <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d435519.2273943813!2d74.00472901005566!3d31.4831036647255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39190483e58107d9%3A0xc23abe6ccc7e2462!2sLahore%2C%20Punjab%2C%20Pakistan!5e0!3m2!1sen!2s!4v1715388395046!5m2!1sen!2s"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
            {{-- <iframe
                src="https://maps.google.com/maps?q={{ $user->businessUser->latitude ?? '31.5994529' }},{{ $user->businessUser->longitude ?? '74.3379943' }}&t=k&z=16&ie=UTF8&iwloc=&output=embed"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe> --}}

            <iframe
                src="https://maps.google.com/maps?q={{ $user->businessUser->latitude ?? '31.5994529' }},{{ $user->businessUser->longitude ?? '74.3379943' }}&t=m&z=16&ie=UTF8&iwloc=&output=embed"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>


            <div class="row">
                <div class="col-lg-6">
                    <div class="col-lg-12">
                        <h2>Opening times</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <h6>Monday</h6>
                        </div>
                        <div class="col-lg-8">
                            <p>9:00 am - 7:00 pm</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <h6>Tuesday</h6>
                        </div>
                        <div class="col-lg-8">
                            <p>9:00 am - 7:00 pm</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <h6>Monday</h6>
                        </div>
                        <div class="col-lg-8">
                            <p>9:00 am - 7:00 pm</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <h6>Wednesday</h6>
                        </div>
                        <div class="col-lg-8">
                            <p>9:00 am - 7:00 pm</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <h6>Thursday</h6>
                        </div>
                        <div class="col-lg-8">
                            <p>9:00 am - 7:00 pm</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <h6>Friday</h6>
                        </div>
                        <div class="col-lg-8">
                            <p>9:00 am - 7:00 pm</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <h6>Saturday</h6>
                        </div>
                        <div class="col-lg-8">
                            <p>9:00 am - 7:00 pm</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <h6 class="text-light"> Sunday</h6>
                        </div>
                        <div class="col-lg-8">
                            <p class="text-light">close</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2>Additional information</h2>
                    <p>
                        <i class="fa fa-check me-1"></i>Instant Confirmation
                    </p>
                    <p>
                        <i class="fa-solid fa-credit-card me-1"></i>Pay by app
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section>

        <div class="container services-area services-details-area">
            <h1 class="">NearBy Location</h1>
            <div class="nearbyLocation owl-carousel owl-theme mt-3">

                @forelse ($nearByUsers as $shop)
                    <div class=" item">
                        <div class="services-card">
                            <a href="{{ isset($shop->businessUser->images[0]) ? asset('storage/' . $shop->businessUser->images[0]['image']) : asset('assets/images/shope.png') }}"
                                target="_blank">
                                <img src="{{ isset($shop->businessUser->images[0]) ? asset('storage/' . $shop->businessUser->images[0]['image']) : asset('assets/images/shope.png') }}"
                                    alt="Services">
                            </a>
                            <div class="content">
                                <h3>
                                    <a
                                        href="{{ route('shop.details', $shop->businessUser->slug ?? '') }}">{{ $shop->businessUser->business_name ?? '' }}</a>
                                </h3>
                                {{-- <p class="mb-0">4.8 <i class="flaticon-star mt-1"></i> (1028) </p> --}}
                                <p>{{ $shop->businessUser->city ?? 'City' }},
                                    {{ $user->businessUser->country ?? 'Country' }}</p>
                                <p>
                                    <span class="bage-outline">{{ $shop->name ?? '' }}</span>
                                </p>
                                <a href="{{ route('shop.details', $shop->businessUser->slug ?? '') }}" class="more-btn">
                                    <i class="flaticon-arrow-pointing-to-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
        <!-- #owl-demo-2 -->
    </section>

    <div class="modal fade productsQuickView" id="productsQuickView" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close-on" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="flaticon-close"></i>
                    </span>
                </button>
                <div class="product-details-desc">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12">
                            <div class="products-quickView-image">
                                <img src="assets/images/products/product-details.png" alt="Product Details">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="product-desc mb-30 pl-20">
                                <h3>Nail Polish Removers </h3>
                                <div class="price">
                                    <span class="old-price">$140.00 </span>
                                    <span class="new-price">- $110.00</span>
                                </div>
                                <div class="product-review">
                                    <div class="rating">
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-line"></i>
                                        <i class="ri-star-line"></i>
                                    </div>
                                    <div class="rating-count">255 Reviews</div>
                                </div>
                                <p> Voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo
                                    inventore veritatis et quasi. </p>
                                <ul class="product-category-list">
                                    <li>Availablity: <span>In Stock</span>
                                    </li>
                                    <li>Tags: <span>Nail, Lover</span>
                                    </li>
                                </ul>
                                <div class="input-counter-area">
                                    <h4>Quantity</h4>
                                    <div class="input-counter">
                                        <span class="minus-btn">
                                            <i class="ri-add-fill"></i>
                                        </span>
                                        <input type="text" value="1">
                                        <span class="plus-btn">
                                            <i class="ri-subtract-line"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="product-add-btn">
                                    <button type="submit" class="default-btn border-radius-5"> Add To Cart <i
                                            class="flaticon-shopping-cart-empty-side-view"></i>
                                    </button>
                                    <ul class="products-action">
                                        <li>
                                            <a href="#">
                                                <i class="ri-arrow-left-right-line"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="ri-heart-line"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product-share">
                                    <ul>
                                        <li>
                                            <span>Share:</span>
                                        </li>
                                        <li>
                                            <a href="https://twitter.com/" target="_blank">
                                                <i class="ri-twitter-fill"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.linkedin.com/" target="_blank">
                                                <i class="ri-linkedin-fill"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.facebook.com/" target="_blank">
                                                <i class="ri-facebook-fill"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://vimeo.com/" target="_blank">
                                                <i class="ri-vimeo-fill"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="bookingModalLabel">Choose an option</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="list-group">
                        <div class="mb-2">
                            <h5>Book</h5>
                            <a href="{{ route('shop.services', ['slug' => $user->businessUser->slug]) }}"
                                class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Book an appointment</h5>
                                </div>
                                <p class="mb-1">Schedule services for yourself</p>
                            </a>
                        </div>

                        @if ($user->shopMemberships->count() > 0 || $user->products->count() > 0)
                            <div class="mt-2">
                                <h5>Buy</h5>
                                @if ($user->shopMemberships->count() > 0)
                                    <a href="{{ route('shop.memberships.index', ['slug' => $user->businessUser->slug]) }}"
                                        class="list-group-item list-group-item-action ">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Memberships</h5>
                                        </div>
                                        <p class="mb-1">Bundle your services into a membership</p>
                                    </a>
                                @endif
                                @if ($user->products->count() > 0)
                                    <br>
                                    <a href="{{ route('shop.products.index', ['slug' => $user->businessUser->slug]) }}"
                                        class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Products</h5>
                                        </div>
                                        <p class="mb-1">Buy products online</p>
                                    </a>
                                @endif
                                <br>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Feedback Modal -->
    <div class="modal fade" id="customerFeedbackModal" tabindex="-1" aria-labelledby="customerFeedbackModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customerFeedbackModalLabel">Customer Feedback Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('cutomer.feedback.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-2">
                            <label for="exampleFormControlInput1">Name</label>
                            <input type="text" class="form-control subheading" name="name"
                                id="exampleFormControlInput1" placeholder="Name" required>
                        </div>
                        <div class="form-group mt-2">
                            <div class="my-3 show-sm">
                                <span class="text-primary fw-bold me-2">
                                    Store:
                                </span> {{ $user->businessUser->business_name ?? '' }}
                            </div>
                            <input type="hidden" name="store_id" id="store_id" class="form-controller"
                                value="{{ $user->id }}" />
                        </div>


                        <div class="form-group mt-2">
                            <label for="exampleFormControlInput1">Feedback</label>
                            {{-- <input type="text" class="form-control subheading" name="feedback"
                                id="exampleFormControlInput1" placeholder="Feedback" required> --}}
                            <textarea name="feedback" id="feedback" class="form-control subheading" placeholder="Feddback" rows="3"></textarea>
                        </div>
                        <div class="form-group mt-2">
                            <label for="exampleFormControlInput1">Rating</label>
                            <input type="number" min="1" max="5" class="form-control subheading"
                                name="rating" id="exampleFormControlInput1" placeholder="Feedback" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('top-scripts')


@endsection
