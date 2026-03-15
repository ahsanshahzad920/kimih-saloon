@extends('admin.layout.app')
@section('title', 'Sales')
@section('styles')
    <link href="{{ asset('assets_old/js/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <style>
        .dataTables_paginate {
            display: none !important;
        }

        .dataTables_length {
            display: none !important;
        }

        .dataTables_info {
            display: none !important;
        }

        .dataTables_filter {
            display: none !important;
        }

        .dt-buttons {
            display: none !important;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('content')

    <!-- ============================================================== -->

    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <!-- start page title -->

            <!-- end page title -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Invoice</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Invoice</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xxl-9" id="invoice">
                        <div class="card" id="demo">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card-header border-bottom-dashed p-4">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">

                                                <div class="">
                                                    <h6 class="text-muted text-uppercase fw-semibold">Address</h6>
                                                    <p class="text-muted mb-1" id="address-details">
                                                        {{ $sale->createdBy->country ?? 'Dubai UAE' }}</p>
                                                    {{-- <p class="text-muted mb-0" id="zip-code"><span>Zip-code:</span> 90201 --}}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 mt-sm-0 mt-3">
                                                {{-- <h6><span class="text-muted fw-normal">Legal Registration No:</span><span
                                                        id="legal-register-no">987654</span></h6> --}}
                                                <h6><span class="text-muted fw-normal">Email:</span><span
                                                        id="email">{{ $sale->createdBy->email ?? 'example@gmail.com' }}</span>
                                                </h6>
                                                <h6><span class="text-muted fw-normal">Website:</span> <a
                                                        href="https://themesbrand.com/" class="link-primary" target="_blank"
                                                        id="website">{{ $sale->createdBy->website ?? 'www.website.com' }}</a>
                                                </h6>
                                                <h6 class="mb-0"><span class="text-muted fw-normal">Contact No:
                                                    </span><span id="contact-no">
                                                        {{ $sale->createdBy->phone ?? '12345678' }}</span></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card-header-->
                                </div><!--end col-->
                                <div class="col-lg-12">
                                    <div class="card-body p-4">
                                        <div class="row g-3">
                                            <div class="col-lg-3 col-6">
                                                <p class="text-muted mb-2 text-uppercase fw-semibold">Invoice No</p>
                                                <h5 class="fs-14 mb-0">#<span
                                                        id="invoice-no">{{ $sale->invoice_number ?? '123342' }}</span></h5>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-3 col-6">
                                                <p class="text-muted mb-2 text-uppercase fw-semibold">Date</p>
                                                <h5 class="fs-14 mb-0"><span
                                                        id="invoice-date">{{ $sale->date ?? '12/23/24' }}</span>
                                                    {{-- <small class="text-muted" id="invoice-time">02:36PM</small> --}}
                                                </h5>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-3 col-6">
                                                <p class="text-muted mb-2 text-uppercase fw-semibold">Payment Status</p>
                                                <span class="badge bg-success-subtle text-success fs-11"
                                                    id="payment-status">{{ $sale->status ?? '' }}</span>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-3 col-6">
                                                <p class="text-muted mb-2 text-uppercase fw-semibold">Total Amount</p>
                                                <h5 class="fs-14 mb-0"><span
                                                        id="total-amount">{{ $sale->grand_total ?? '' }}</span></h5>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </div>
                                    <!--end card-body-->
                                </div><!--end col-->
                                <div class="col-lg-12">
                                    <div class="card-body p-4 border-top border-top-dashed">
                                        <div class="row g-3">
                                            <div class="col-6">
                                                <h6 class="text-muted text-uppercase fw-semibold mb-3">Billing Address</h6>
                                                <p class="fw-medium mb-2" id="billing-name">{{ $sale->client->name ?? '' }}
                                                </p>
                                                <p class="text-muted mb-1" id="billing-address-line-1">
                                                    {{ $sale->client->address ?? 'N/A' }}
                                                </p>
                                                <p class="text-muted mb-1"><span>Phone: </span><span
                                                        id="billing-phone-no">{{ $sale->client->phone ?? 'N/A' }}</span>
                                                </p>
                                                {{-- <p class="text-muted mb-0"><span>Tax: </span><span
                                                        id="billing-tax-no">12-3456789</span> </p> --}}
                                            </div>
                                            <!--end col-->
                                            <div class="col-6">
                                                <h6 class="text-muted text-uppercase fw-semibold mb-3">Shipping Address</h6>
                                                <p class="fw-medium mb-2" id="billing-name">{{ $sale->client->name ?? '' }}
                                                </p>
                                                <p class="text-muted mb-1" id="billing-address-line-1">
                                                    {{ $sale->client->address ?? 'N/A' }}
                                                </p>
                                                <p class="text-muted mb-1"><span>Phone: +</span><span
                                                        id="billing-phone-no">{{ $sale->client->phone ?? 'N/A' }}</span>
                                                </p>
                                                {{-- <p class="text-muted mb-0"><span>Tax: </span><span
                                                        id="billing-tax-no">12-3456789</span> </p> --}}
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </div>
                                    <!--end card-body-->
                                </div><!--end col-->
                                <div class="col-lg-12">
                                    <div class="card-body p-4">
                                        <div class="table-responsive">
                                            <table
                                                class="table table-borderless text-center table-nowrap align-middle mb-0">
                                                <thead>
                                                    <tr class="table-active">
                                                        <th scope="col" style="width: 50px;">#</th>
                                                        <th scope="col" class="text-start">Details</th>
                                                        <th scope="col" class="text-end">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="products-list">
                                                    {{-- <tr>
                                                        <th scope="row">01</th>
                                                        <td class="text-start">
                                                            <span class="fw-medium">Hair Cuting</span>
                                                            <p class="text-muted mb-0">lorem plusa dolor Print Men & Women
                                                            </p>
                                                        </td>
                                                        <td>$19.99</td>
                                                    </tr> --}}
                                                    @forelse ($sale->items as $item)
                                                        @if ($item->type == 'service')
                                                            <tr>
                                                                <th scope="row">{{ $loop->iteration }}</th>
                                                                <td class="text-start ">
                                                                    <span
                                                                        class="fw-medium">{{ $item->serviceItem->service_name }}</span>
                                                                </td>
                                                                <td>{{ $item->price }}</td>
                                                            </tr>
                                                        @endif
                                                        @if ($item->type == 'product')
                                                            <tr>
                                                                <th scope="row">{{ $loop->iteration }}</th>
                                                                <td class="text-start ">
                                                                    <span
                                                                        class="fw-medium">{{ $item->productItem->name }}</span>
                                                                </td>
                                                                <td>{{ $item->price }}</td>
                                                            </tr>
                                                        @endif
                                                        @if ($item->type == 'appointment')
                                                            <tr>
                                                                <th scope="row">{{ $loop->iteration }}</th>
                                                                <td class="text-start ">
                                                                    <span
                                                                        class="fw-medium">{{ $item->appointmentItem->services[0]->service->service_name }}</span>
                                                                </td>
                                                                <td>{{ $item->price }}</td>
                                                            </tr>
                                                        @endif
                                                        @if ($item->type == 'membership')
                                                            <tr>
                                                                <th scope="row">{{ $loop->iteration }}</th>
                                                                <td class="text-start ">
                                                                    <span
                                                                        class="fw-medium">{{ $item->membershipItem->name }}</span>
                                                                </td>
                                                                <td>{{ $item->price }}</td>
                                                            </tr>
                                                        @endif
                                                    @empty
                                                        </tr>
                                                            <td colspan="3">No Items Found</td>
                                                        </tr>
                                                    @endforelse

                                                </tbody>
                                            </table><!--end table-->
                                        </div>
                                        <div class="border-top border-top-dashed mt-2">
                                            <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto"
                                                style="width:250px">
                                                <tbody>
                                                    <tr>
                                                        <td>Sub Total</td>
                                                        <td class="text-end">
                                                            {{ number_format($sale->grand_total / (1 + 2.5 / 100), 2) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Platform Fee</td>
                                                        <td class="text-end">(2.5%)</td>
                                                    </tr>
                                                    {{-- <tr>
                                                        <td>Discount <small class="text-muted">(VELZON15)</small></td>
                                                        <td class="text-end">- $53.99</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shipping Charge</td>
                                                        <td class="text-end">$65.00</td>
                                                    </tr> --}}
                                                    <tr class="border-top border-top-dashed fs-15">
                                                        <th scope="row">Total Amount</th>
                                                        <th class="text-end">{{ $sale->grand_total }}</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!--end table-->
                                        </div>
                                        <div class="mt-3">
                                            <h6 class="text-muted text-uppercase fw-semibold mb-3">Payment Details:</h6>
                                            {{-- <p class="text-muted mb-1">Payment Method: <span class="fw-medium"
                                                    id="payment-method">Mastercard</span></p>
                                            <p class="text-muted mb-1">Card Holder: <span class="fw-medium"
                                                    id="card-holder-name">David Nichols</span></p>
                                            <p class="text-muted mb-1">Card Number: <span class="fw-medium"
                                                    id="card-number">xxx xxxx xxxx 1234</span></p> --}}
                                            {{-- <p class="text-muted">Total Amount: <span class="fw-medium" id="">$
                                                </span><span id="card-total-amount">755.96</span></p> --}}


                                            <div class="table-responsive">

                                                <table
                                                    class="table table-borderless text-center table-nowrap align-middle mb-0">
                                                    <thead>
                                                        <tr class="table-active">
                                                            <th scope="col" style="width: 50px;">#</th>
                                                            <th scope="col" class="text-start">Payment Date</th>
                                                            <th scope="col" class="text-start">Payment Method</th>
                                                            <th scope="col" class="text-end">Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="products-list">
                                                        @forelse ($sale->payments as $payment)

                                                            <tr>
                                                                <th scope="row">{{ $loop->iteration }}</th>
                                                                <td class="text-start">{{ $payment->payment_date }}</td>
                                                                <td class="text-start">{{ $payment->payment_method }}</td>
                                                                <td>{{ $payment->paid_amount }}</td>
                                                            </tr>
                                                        @empty
                                                            </tr>
                                                            <td colspan="3">No Payments Found</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table><!--end table-->
                                            </div>

                                            <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                                <a href="javascript:window.print()" class="btn btn-success"><i
                                                        class="ri-printer-line align-bottom me-1"></i> Print</a>
                                                <a  id="download-button" class="btn btn-primary"><i
                                                        class="ri-download-2-line align-bottom me-1"></i> Download</a>
                                                {{-- <a href="javascript:void(0);" class="btn btn-primary"><i
                                                        class="ri-download-2-line align-bottom me-1"></i> Download</a> --}}
                                            </div>
                                        </div>
                                        <!--end card-body-->
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div>
                            <!--end card-->
                        </div>
                        <!--end col-->
                    </div>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
        </div>
        <!-- end main content-->


    @endsection
    @section('scripts')

    <script>
        const button = document.getElementById('download-button');

        function generatePDF() {
            // Choose the element that your content will be rendered to.
            const element = document.getElementById('invoice');
            // Choose the element and save the PDF for your user.
            html2pdf().from(element).save();
        }

        button.addEventListener('click', generatePDF);
    </script>
    @endsection
