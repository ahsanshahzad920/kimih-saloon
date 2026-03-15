@extends('user.layouts.app')

@section('title', 'Memberships')
@section('styles')

@endsection
@section('content')
    <div class="inner-banner">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-12 text-center">
                    <div class="inner-title">
                        <h3>{{$shop->businessUser->business_name ?? ''}}</h3>
                        <ul>
                            <li>
                                <a href="index.html">Home</a>
                            </li>
                            <li>Memberships</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="pricing-area pt-100 pb-70">
        <div class="container">
            <div class="section-title mb-45 text-center">
                <span>Best Deals</span>
                <h2>Our Best Pricing Packages</h2>
            </div>
            <div class="row justify-content-center">
                @foreach ($shop->shopMemberships as $membership)
                    <div class="col-lg-4 col-6">
                        <div class="pricing-item box-shadow">
                            <img src="{{asset('assets/images/pricing/pricing-shape.png')}}" alt="Pricing" />
                            <h2>{{$membership->name ?? ''}}</h2>
                            <div class="d-flex justify-content-between">
                                <span>Membership Price: </span>
                                <span class="fw-bold">AED{{$membership->price}}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Validity:</span>
                                <span class="fw-bold">{{$membership->valid_for}}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Total Sessions: </span>
                                <span class="fw-bold">{{$membership->no_of_session ?? ''}} sessions</span>
                            </div>

                            <hr>
                            <h4>Services</h4>
                            <ul>
                                @foreach ($membership->services as $service)
                                    <li>
                                        <div class="content">
                                            <h3>{{$service->service_name ?? ''}} <span>AED{{$service->price ?? ''}}</span>
                                            </h3>
                                            <p>Clean {{$service->duration ?? ''}}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <form action="{{route('shop.membership.checkout',['slug' => $shop->businessUser->slug])}}" method="POST">
                                @csrf
                                {{-- <a href="{{route('shop.membership.checkout')}}" class="default-btn">Buy Now <i class="flaticon-booking"></i> --}}
                                    <input type="hidden" name="membership_id" value="{{$membership->id}}">
                                    <input type="hidden" name="shop_id" value="{{$shop->id}}">
                                    <input type="hidden" name="price" value="{{$membership->price}}">
                                    <input type="hidden" name="client_id" value="{{auth()->id()}}">
                                    <button type="submit" class="default-btn">Buy Now <i class="flaticon-booking"></i></button>
                            </form>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
@section('top-scripts')


@endsection
