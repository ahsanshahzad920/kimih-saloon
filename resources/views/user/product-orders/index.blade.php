@extends('user.layouts.app')

@section('title', 'Product orders')
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-5 mt-3">Product Orders</h2>
                <div class="row row-cols-1 row-cols-md-2 g-4 mb-5">
                    @forelse ($orders as $order)
                        <?php

                        $carbonDate = \Carbon\Carbon::parse($order->created_at);

                        $formattedDate = $carbonDate->format('j M Y \a\t g:ia'); // Example: "6 Jun 2024 at 11:30am"
                        ?>
                        <div class="col">
                            <div class="card mb-3 p-2" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="{{ asset('/storage' . $order->items[0]->productItem->images[0]['img_path']) }}"
                                            class="img-fluid rounded-start" alt="No Image found">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title d-flex justify-content-between">
                                                <span>{{ $order->createdBy->businessUser->business_name }}</span> <span
                                                    class="badge rounded-pill text-bg-primary">{{ $order->status ?? '' }}</span>
                                            </h5>
                                            <p class="card-text"> <i class="bi bi-alarm me-2"></i>
                                                <span>{{ $formattedDate ?? '' }}</span></p>
                                            <div class="d-flex justify-content-between">
                                                <p class="card-text fw-bold">AED {{ $order->grand_total ?? '' }} .
                                                    {{ count($order->items) }} Products</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        No Record found.
                    @endforelse

                </div>

            </div>
        </div>
    </div>
@endsection
@section('top-scripts')


@endsection
