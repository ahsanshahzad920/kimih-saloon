@extends('admin.layout.app')
@section('title', 'Daily-Sales')

@section('content')


    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <h2>Daily sales</h2>
                        <p>
                            View, filter and export the transactions and cash movement for
                            the day. Learn more
                        </p>
                    </div>
                    <div class="col-lg-4 text-end">
                        <a href="{{route('sales.create')}}" class="btn btn-success add-btn">Add</a>
                        {{-- <button class="btn save-btn">Export</button> --}}
                    </div>
                    {{-- <div class="col-lg-4 text-end">
                    </div> --}}
                </div>

                <div class="row">
                    <div class="col-lg-6 col-container">
                        <div class="card">
                            <div class="card-header">
                                <h5>Transaction summary</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-nowrap">
                                    <thead>
                                        <tr>
                                            <th scope="col">Item type</th>
                                            <th scope="col">Sale qty</th>
                                            <th scope="col">Refund qty</th>
                                            <th scope="col">Gross total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td class="fw-semibold">Services</td>
                                            <td>{{$serviceQty ?? '0'}}</td>
                                            <td>0</td>
                                            <td>AED {{$servicePrice ?? '0.00'}}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Products</td>
                                            <td>{{$productQty ?? '0'}}</td>
                                            <td>0</td>
                                            <td>AED {{$productPrice ?? '0.00'}}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Memberships</td>
                                            <td>{{$membershipQty ?? '0'}}</td>
                                            <td>0</td>
                                            <td>AED {{$membershipPrice ?? '0.00'}}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bolder">Total Sales</td>
                                            <td class="fw-bolder">{{$totalQty ?? '0'}}</td>
                                            <td class="fw-bolder">0</td>
                                            <td class="fw-bolder">AED {{$totalPrice ?? '0.00'}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-container">
                        <div class="card">
                            <div class="card-header">
                                <h5>Cash movement summary</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-nowrap">
                                    <thead>
                                        <tr>
                                            <th scope="col">Payment type</th>
                                            <th scope="col">Payments collected</th>
                                            <th scope="col">Refunds paid</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fw-bolder">Cash</td>
                                            <td>AED {{$cash ?? '0.00'}}</td>
                                            <td>AED 0</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bolder">Other</td>
                                            <td>AED {{$other ?? '0.00'}}</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bolder">Payments collected</td>
                                            <td class="fw-bolder">AED {{$payment_collected ?? '0.00'}}</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bolder">Outstanding</td>
                                            <td class="fw-bolder">AED {{$outstanding ?? '0.00'}}</td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
    <!-- end main content-->


@endsection
