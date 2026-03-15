@extends('user.layouts.app')

@section('content')
    <div class="inner-banner">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-12 text-center">
                    <div class="inner-title">
                        <h3>Pricing</h3>
                        <ul>
                            <li>
                                <a href="/">Home</a>
                            </li>
                            <li>Pricing</li>
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
                <h2>Our Best Price Packages</h2>
            </div>
            <div class="row justify-content-center">
                @forelse ($plans as $plan)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="pricing-item box-shadow">
                            <h2 class="text-center">{{ $plan->name ?? '' }}</h2>
                            <div class="price-tag my-2 mb-3">AED{{ $plan->price ?? 0 }}</div>
                            <ul class="plan-services">
                                @foreach ($plan->planServices as $planService)
                                    <li>
                                        <div class="content">
                                            <h3>{{ $planService->name ?? '' }}</h3>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <a href="{{ route('user-flow') }}" class="default-btn">Sign up</a>
                        </div>
                    </div>
                @empty
                    <p>No record found.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection


@section('styles')
    <style>
        .pricing-area {
            background-color: #f9f9f9;
            padding: 100px 0 70px;
        }

        .pricing-item {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .pricing-item h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .price-tag {
            font-size: 32px;
            color: #17a2b8;
            font-weight: bold;
        }

        .plan-services {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }

        .plan-services li {
            margin-bottom: 10px;
        }

        .default-btn {
            background-color: #17a2b8;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .default-btn:hover {
            background-color: #138496;
        }
    </style>
@endsection
