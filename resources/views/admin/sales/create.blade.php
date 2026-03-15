@extends('admin.layout.app')
@section('title', 'Create Sale')
@section('styles')
    <link href="{{ asset('assets/js/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <style>
        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            background-color: #9a2c47;
            /* Change this color to your desired color */
            border-bottom: 2px solid white;
            /* Optional: Add a border at the bottom */
            color: white !important;
        }

        .tr {
            cursor: pointer;
        }
    </style>

@endsection

@section('content')

    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid booking-cart">
                <div class="row">
                    <div class="col-lg-8" id="toggleDiv">
                        <h2>Add to cart</h2>
                        {{-- <div class="input-group mb-3" style="max-width: 500px;">
                            <input type="text" class="form-control" placeholder=""
                                aria-label="Example text with button addon" aria-describedby="button-addon1">
                            <button class="default-btn py-2" type="button" id="button-addon1">Search</button>
                        </div>
                        <div class=" services-booking-card">
                            <a href="#" class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h5>Head Barber Haircut</h5>
                                            <p>45 mins</p>

                                        </div>
                                        <div class="col-lg-4 text-end">
                                            <h6>£37</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h5>Maintenance (Back and sides)</h5>
                                            <p>20 mins</p>

                                        </div>
                                        <div class="col-lg-4 text-end">
                                            <h6>£15</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h5>Buzz All Over</h5>
                                            <p>30 mins</p>

                                        </div>
                                        <div class="col-lg-4 text-end">
                                            <h6>£25</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h5>Haircut and Beard Trim</h5>
                                            <p>50 mins</p>

                                        </div>
                                        <div class="col-lg-4 text-end">
                                            <h6>£45</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div> --}}
                        <div class="input-group mb-3" style="max-width: 500px;">
                            <input type="text" class="form-control" placeholder=""
                                aria-label="Example text with button addon" aria-describedby="button-addon1">
                            <button class="default-btn py-2" type="button" id="button-addon1">Search</button>
                        </div>
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active text-dark" id="nav-quotations-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-quotations" type="button" role="tab"
                                    aria-controls="nav-quotations" aria-selected="true">
                                    Services
                                </button>
                                <button class="nav-link text-dark" id="nav-sales-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-sales" type="button" role="tab" aria-controls="nav-sales"
                                    aria-selected="true">
                                    Products
                                </button>

                                <button class="nav-link text-dark" id="memebership-tab" data-bs-toggle="tab"
                                    data-bs-target="#memebership" type="button" role="tab" aria-controls="memebership"
                                    aria-selected="true">
                                    Memberships
                                </button>
                                <button class="nav-link text-dark" id="appointment-tab" data-bs-toggle="tab"
                                    data-bs-target="#appointment" type="button" role="tab" aria-controls="appointment"
                                    aria-selected="true">
                                    Appointments
                                </button>

                            </div>
                        </nav>

                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade px-2 show active" id="nav-quotations" role="tabpanel"
                                aria-labelledby="nav-quotations-tab" tabindex="0">
                                <div class="row my-3">
                                    <div class="col-md-6 col-12 mt-2">
                                        {{-- <div class="input-group mb-3" style="max-width: 500px;">
                                            <input type="text" class="form-control" placeholder=""
                                                aria-label="Example text with button addon" aria-describedby="button-addon1">
                                            <button class="default-btn py-2" type="button" id="button-addon1">Search</button>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class=" services-booking-card table">
                                    @forelse ($services as $service)
                                        @php
                                            $service->name = $service->service_name;
                                        @endphp
                                        <div class="card tr" data-details="{{ json_encode($service) }}" data-type="service">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <h5>{{ $service->service_name ?? '' }}</h5>
                                                        <p>{{ $service->duration ?? '' }}</p>

                                                    </div>
                                                    <div class="col-lg-4 text-end">
                                                        <h6>{{ $service->price ?? '' }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="card d-flex justify-content-content p-4">
                                            No Service Found
                                        </div>
                                    @endforelse

                                </div>
                            </div>
                            <div class="tab-pane fade px-2" id="nav-sales" role="tabpanel" aria-labelledby="nav-sales-tab"
                                tabindex="0">
                                <div class="row my-3">
                                    <div class="col-md-6 col-12 mt-2">
                                        {{-- <div class="input-search position-relative">
                                            <input type="text" placeholder="Search Product"
                                                class="form-control rounded-3 subheading" id="custom-filter2" />
                                            <span class="fa fa-search search-icon text-secondary"></span>
                                        </div> --}}
                                    </div>
                                </div>

                                <div class=" services-booking-card table">
                                    @forelse ($products as $product)
                                        @php
                                            $product->price = $product->retail_price ?? '0';
                                        @endphp
                                        <div class="card tr" data-details="{{ json_encode($product) }}" data-type="product">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <h5>{{ $product->name ?? '' }}</h5>
                                                        <p>{{ $service->duration ?? '' }}</p>

                                                    </div>
                                                    <div class="col-lg-4 text-end">
                                                        <h6>{{ $product->retail_price ?? '' }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="card d-flex justify-content-content p-4">
                                            No Product Found
                                        </div>
                                    @endforelse

                                </div>

                            </div>
                            <div class="tab-pane fade px-2" id="memebership" role="tabpanel"
                                aria-labelledby="memebership-tab" tabindex="0">
                                <div class="row my-3">
                                    <div class="col-md-6 col-12 mt-2">
                                        {{-- <div class="input-search position-relative">
                                            <input type="text" placeholder="Search Membership"
                                                class="form-control rounded-3 subheading" id="custom-filter2" />
                                            <span class="fa fa-search search-icon text-secondary"></span>
                                        </div> --}}
                                    </div>
                                </div>

                                <div class="services-booking-card table">
                                    @forelse ($memberships as $membership)
                                        @php
                                            $total_service = explode(',', $membership->services);
                                            $membership->total_service = count($total_service);
                                        @endphp
                                        <div class="card tr" data-details="{{ $membership }}" data-type="membership">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <h5>{{ $membership->name ?? '' }}</h5>
                                                        <p>{{ count($total_service) ?? '' }}</p>

                                                    </div>
                                                    <div class="col-lg-4 text-end">
                                                        <h6>{{ $membership->price ?? '' }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="card d-flex justify-content-content p-4">
                                            No Membership Found
                                        </div>
                                    @endforelse
                                </div>

                            </div>
                            <div class="tab-pane fade px-2" id="appointment" role="tabpanel"
                                aria-labelledby="appointment-tab" tabindex="0">
                                <div class="row my-3">
                                    <div class="col-md-6 col-12 mt-2">

                                    </div>
                                </div>

                                <div class="services-booking-card table">
                                    @forelse ($appointments as $appointment)
                                    @php
                                        $appointment->price = $appointment->grand_total ?? '0';
                                        $appointment->name = $appointment->title ?? '';
                                        $appointment->total_services = count($appointment->services) ?? '0';
                                    @endphp
                                        <div class="card tr" data-details="{{ $appointment }}" data-type="appointment">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <h5>{{ $appointment->title ?? '' }}</h5>
                                                        <p>{{ count($appointment->services) ?? '' }} Services</p>

                                                    </div>
                                                    <div class="col-lg-4 text-end">
                                                        <h6>{{ $appointment->grand_total ?? '' }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="card d-flex justify-content-content p-4">
                                            No Appointment Found
                                        </div>
                                    @endforelse
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4 border-left ">
                        <div class="checkout-box">
                            <div class="form-group mt-2 mb-3">
                                <label for="customers" class="mb-1 fw-bold">Client <span
                                        class="text-danger">*</span></label>
                                <select class="form-control form-select subheading mt-1"
                                    aria-label="Default select example" name="client_id" id="client_id">
                                    <option value="">Select Clients</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->user_id }}">{{ $client->user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="services-wraper cart-list" id="cart-list"
                                style="max-height:300px;overflow-y:auto;">
                                {{-- <div class="card item">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h5>Haircut and Beard Trim</h5>
                                                <p>50 mins - Hussain Mustaf</p>

                                            </div>
                                            <div class="col-lg-4 text-end">
                                                <h6>£45</h6>
                                            </div>
                                        </div>
                                        <div class="buttons">

                                            <a href="#" class="edit-button  p-2" data-bs-target="#exampleModalToggle"
                                                    data-bs-toggle="modal" id="item-edit">
                                                    <i class="bi bi-pencil-square fs-4"></i>
                                                </a>
                                            <a href="#" class="delete-button p-2">
                                                    <i class="bi bi-trash-fill fs-4"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="card item" >
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="d-flex justify-content-between">
                                                <h5>Haircut and Beard Trim</h5>
                                                <div>
                                                    <a href="#" class="" data-bs-target="#exampleModalToggle"
                                                        data-bs-toggle="modal" id="item-edit">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="#" class="ms-2">
                                                        <i class="bi bi-trash-fill text-danger"></i>
                                                    </a>
                                                </div>

                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <span>0.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                            </div>

                            {{-- <div>
                                <div class=" d-flex justify-content-between align-items-center">
                                    <p>Subtotal</p>
                                    <p>PKR 40</p>
                                </div>
                                <div class=" d-flex justify-content-between align-items-center">
                                    <p>Tax</p>
                                    <p>PKR 0</p>
                                </div>
                                <hr>
                                <div class=" d-flex justify-content-between align-items-center">
                                    <p>To pay</p>
                                    <h6>PKR 40</h6>
                                </div>
                                <button class="default-btn w-100">Continue</button>
                            </div> --}}
                            <div class="mt-3">
                                <div class="d-flex justify-content-between align-items-center mb-2" id="subTotalDiv">
                                    <span class="">Subtotal:</span>
                                    <span class="" id="subTotal">$0.00</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="">Tax:</span>
                                    <span class="" id="subTotal">$0.00</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2" id="grandTotalDiv">
                                    <h6>Total:</h6>
                                    <span class=" fw-bold" id="grand_total">$0.00</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center mb-2" id="toPayDiv">
                                    <h6>To pay:</h6>
                                    <span class=" fw-bold" id="toPay">$0.00</span>
                                </div>
                                <div class="mt-2 d-flex justify-content-between align-items-center">
                                    <div class="dropdown">
                                        <button class="btn btn-light dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-list"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                    id="addCartDisModelBtn" data-bs-target="#exampleModalToggle3">Add
                                                    cart discount</a></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    id="addSaleNoteModelBtn" data-bs-target="#exampleModalToggle4">Add
                                                    sale note</a></li>
                                            <li><button class="dropdown-item" id="saveUnpaid">Save unpaid</button></li>
                                            <li><a class="dropdown-item text-danger"
                                                    href="{{ route('sales.index') }}">Cancel sale</a></li>
                                        </ul>
                                    </div>

                                    <button class="btn default-btn text-white" type="button"
                                        id="addPaymentModelBtn">Continue Payment</button>
                                </div>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModalToggle" tabindex="-1" aria-labelledby="exampleModalToggleLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title product-title" id="item-head"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-title">
                        <h4></h4>
                    </div>
                    <div class="modal-body">

                        <div class="card  item p-3"
                            style="border-left: 4px solid #9a2c47;background-color:white; border-radius: 3px;"
                            data-details="${details}">
                            <div class="d-flex justify-content-between">
                                <h5 id="item_name">Item Name</h5>
                                <span id="item_price">$0.00</span>

                            </div>
                            <div class="d-flex justify-content-between">
                                <span id="item_info">50min</span>

                            </div>

                        </div>
                        {{-- <div class="card item" >
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="d-flex justify-content-between">
                                                <h5>Haircut and Beard Trim</h5>
                                                <div>
                                                    <a href="#" class="" data-bs-target="#exampleModalToggle"
                                                        data-bs-toggle="modal" id="item-edit">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="#" class="ms-2">
                                                        <i class="bi bi-trash-fill text-danger"></i>
                                                    </a>
                                                </div>

                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <span>0.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product_price" class="mb-1 fw-bold">Price</label>
                                    <input type="text" class="form-control subheading" id="product_price"
                                        value="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="qty" class="mb-1 fw-bold">Quantity</label>
                                    <input type="number" class="form-control subheading" id="qty" value="1"
                                        min="1" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tax_type" class="mb-1 fw-bold">Discount</label>
                                    <select class="form-control form-select subheading"
                                        aria-label="Default select example" id="discount">
                                        {{-- <option value="" disabled selected>Select Tax Type</option> --}}
                                        <option>No Discount</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="team_member" class="mb-1 fw-bold">Team Member</label>
                                    <select name="team_member" id="team_member"
                                        class="form-control form-select subheading" aria-label="Default select example">
                                        <option value="" disabled>Select Team Member</option>
                                        @foreach ($team_members as $team_member)
                                            <option value="{{ $team_member->id ?? '' }}"> {{ $team_member->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn save-btn" data-product-item="" id="saveChangesButton">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for cart discount -->
    <div class="modal fade" id="exampleModalToggle3" tabindex="-1" aria-labelledby="exampleModalToggle3Label"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title product-title" id="item-head">Add cart discount</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-title">
                    </div>
                    <h6 class="">Taxes will be recalculated after the discount has been applied.</h6>
                    <div class="modal-body">

                        <div class="row mt-2">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="product_price" class="mb-1 fw-bold">Amount</label>
                                    <input type="number" class="form-control subheading" id="discount_amount"
                                        value="0" />
                                </div>
                            </div>
                            <div class="col-md-4" style="margin-top: 32px;">
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" checked type="radio" name="flexRadioDefault"
                                            id="percentageRadio">
                                        <label class="form-check-label" for="percentageRadio">
                                            <i class="bi bi-percent fw-bold"></i>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="currencyRadio">
                                        <label class="form-check-label" for="currencyRadio">
                                            <i class="bi bi-currency-dollar fw-bold"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 d-flex justify-content-between">
                            <h6>Total after discount</h6>
                            <h6 id="totalAfterDiscount">$</h6>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn save-btn" data-product-item="" id="saveDiscountChangesButton">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal for cart discount -->
    <!-- Start Modal for sale note -->
    <div class="modal fade" id="exampleModalToggle4" tabindex="-1" aria-labelledby="exampleModalToggle4Label"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title product-title" id="item-head">Add a note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row mt-2">
                        <div class="form-group">
                            <label for="sale_note" class="form-label">Sale Note</label>
                            <textarea class="form-control" placeholder="Leave a comment here" id="sale_note" style="height: 150px"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn btn-success add-btn" data-product-item=""
                        id="saveSaleNoteChangesButton">Add</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal for sale note -->
    <!-- Start Modal for continue payment -->
    {{-- <div class="modal fade" id="exampleModalToggle5" tabindex="-1" aria-labelledby="exampleModalToggle5Label"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title product-title" id="item-head">Continue Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="modal-body">

                        <div class=" mt-2">
                            <div class="form-group">
                                <label for="sale_note" class="form-label">Payment Method</label>
                                <select name="payment_method" id="payment_method" class="form-select">
                                    <option value="Card">Card</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sale_note" class="form-label">Paying Amount</label>
                                <input type="text" id="paying_amount" class="form-control" placeholder="0.00"
                                    disabled>
                            </div>
                            <div id="cashDiv" style="display: none">
                                <div class="form-group">
                                    <label for="sale_note" class="form-label">Cash Received</label>
                                    <input type="text" id="cash_received" class="form-control" placeholder="0.00"
                                        value="0">
                                </div>
                                <div class="form-group">
                                    <label for="sale_note" class="form-label">Cash Return </label>
                                    <input type="text" id="cash_return" class="form-control" placeholder="0.00"
                                        value="0">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn btn-success add-btn" id="saveAddPaymentChangesButton">Add
                        Payment</button>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- End Modal for sale note -->
    <!-- Start Modal for cash payment -->
    <div class="modal fade" id="exampleModalToggle6" tabindex="-1" aria-labelledby="exampleModalToggle5Label"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title product-title" id="item-head">Add cash amount</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="modal-body">

                        <div class=" mt-2">
                            <input type="hidden" id="payment_method" value="Cash">
                            <div class="form-group mb-2">
                                <label for="sale_note" class="form-label">Paying Amount</label>
                                <input type="text" id="paying_amount" class="form-control" placeholder="0.00"
                                    readonly>
                            </div>

                            <div id="cashDiv">
                                <div class="form-group mb-2">
                                    <label for="sale_note" class="form-label">Cash Received</label>
                                    <input type="text" id="cash_received" class="form-control" placeholder="0.00"
                                        value="0">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="sale_note" class="form-label">Left to pay </label>
                                    <input type="text" id="due" class="form-control" name="due"
                                        placeholder="0.00" value="0" readonly>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="sale_note" class="form-label">Cash Return </label>
                                    <input type="text" id="cash_return" class="form-control" placeholder="0.00"
                                        value="0" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="sale_note" class="form-label">Cash received by</label>
                                    <select name="cash_received_by" id="cash_received_by" class="form-control">
                                        @foreach ($team_members as $team_member)
                                            <option value="{{ $team_member->id }}">{{ $team_member->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn btn-success add-btn" id="saveCashPaymentBtn">Add
                        Payment</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal for sale note -->

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // $('#payment_method').change(function() {
            //     if ($(this).val() == 'Cash') {
            //         $('#cashDiv').show();
            //     } else {
            //         $('#cashDiv').hide();
            //     }
            // });

            // $('#cash_received').on('input', function() {
            //     const grandTotal = parseFloat(document.getElementById('toPay').textContent.replace(
            //         '$', ''));
            //     const cashReceived = parseFloat($(this).val());
            //     // const cashReceived = parseFloat($('#cash_received').val());
            //     const cashReturn = cashReceived - grandTotal;
            //     if (cashReturn < 0) {
            //         $('#cash_return').val(0);
            //         return;
            //     }
            //     $('#cash_return').val(cashReturn);
            // });
            // $('#addCashPaymentModelBtn').click(function() {
            //     alert('clicl');
            //     const grandTotal = parseFloat(document.getElementById('toPay').textContent.replace('$',
            //         ''));
            //     console.log(grandTotal);
            //     $('#paying_amount').val(grandTotal);
            //     $('#cash_received').val(grandTotal);
            // });
            $('#addPaymentModelBtn').click(function() {
                let item = $('#cart-list .item');
                if (item.length == 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please add item to cart',
                    });
                    return;
                }
                let paymentDiv =
                    `

                <h2><span class="m-2 fs-2"><a href="/sales/create" class="text-brand"><i class="las la-arrow-left"></i></a></span> Select payment</h2>
                  <p>
                     Choose the payment method you want to use for this booking
                  </p>
                  <div class="row">
                     <div class="col-lg-3">
                     <div class="services">
                        <label>
                           <input type="radio" value="Paypal" name="payment_method"/>
                           <span>Paypal</span>
                        </label>
                     </div>
                     </div>
                     <div class="col-lg-3">
                     <div class="services">
                        <label>
                           <input type="radio" value="Cash" name="payment_method"data-bs-toggle="modal" data-bs-target="#exampleModalToggle6" id="addCashPaymentModelBtn"/>
                           <span>Cash</span>
                        </label>
                     </div>
                     </div>
                     <div class="col-lg-3">
                     <div class="services">
                        <label>
                           <input type="radio" value="Others" name="payment_method"/>
                           <span>Others</span>
                        </label>
                     </div>
                     </div>
                  </div>
                `;

                // Show the spinner for 1 seconds
                $('#toggleDiv').html(`
                    <div class="d-flex justify-content-center align-items-center " style="height:400px;">
                        <div class="spinner-border text-danger" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                `);

                setTimeout(() => {
                    // After 3 seconds, replace the spinner with the paymentDiv content
                    $('#toggleDiv').html(paymentDiv);
                }, 1000);
            })



            // Remove existing handlers to prevent duplicate bindings
            $(document).off("click", ".qty-minus-btn").on("click", ".qty-minus-btn", function() {
                var input = $(this).siblings(".qty-input");
                var currentValue = parseInt(input.val());
                if (currentValue > 1) {
                    input.val(currentValue - 1).change();
                }
            });

            $(document).off("click", ".qty-plus-btn").on("click", ".qty-plus-btn", function() {
                var input = $(this).siblings(".qty-input");
                var currentValue = parseInt(input.val());
                input.val(currentValue + 1).change();
            });

            // Handle changes in quantity
            $(document).on('change', '.qty-input', function() {
                const quantity = $(this).val();
                const stock = $(this).closest('tr').find('td:nth-child(5)').text();
                if (quantity > parseFloat(stock)) {
                    toastr.success('Quantity exceeded');
                    $(this).val(parseFloat(stock));
                }
                const price = $(this).closest('tr').find('td:nth-child(4)').text();
                const subtotal = parseInt(quantity) * parseFloat(price);
                $(this).closest('tr').find('td:nth-child(9)').text(subtotal.toFixed(2));
                calculateTotal();
            });

            // Event listeners for discount, shipping, and order tax inputs
            $('#discount, #shipping, #order_tax').on('input', calculateTotal);


        });

        function calculateTotal() {
            let subtotal = 0;
            $('.table tbody tr').each(function() {
                subtotal += parseFloat($(this).find('td:nth-child(9)').text() || 0);
            });

            // Assume `orderTax` is a percentage value from an input field

            const orderTax = parseFloat($('#order_tax').val() == '' ? 0 : $('#order_tax').val()) / 100;
            const taxAmount = subtotal * orderTax;

            const discountValue = parseFloat($('#discount').val() == '' ? 0 : $('#discount').val());

            const shipping = parseFloat($('#shipping').val() == '' ? 0 : $('#shipping').val());

            const grandTotal = subtotal + taxAmount - discountValue + shipping;

            // Update the UI
            $('#order_tax_display').text(`$${taxAmount.toFixed(2)} (${orderTax * 100}%)`);
            $('#discount_display').text(`$${discountValue.toFixed(2)}`);
            $('#shipping_display').text(`$${shipping.toFixed(2)}`);
            $('#grand_total').text(`$${grandTotal.toFixed(2)}`);
            if ($('#payment_status').val() == 'paid') {
                $('#amount_pay').val(grandTotal);
                $('#amount_recieved').val(grandTotal);
            }

        }


        $(document).ready(function() {
            $('#createSaleForm').on('submit', function(e) {
                e.preventDefault();

                // Collect form data
                let formData = {
                    date: $(this).find('[type=date]').val(),
                    customer_id: $('#customers').val(),
                    ntn_no: $('#ntn_no').val(),
                    order_tax: $('#order_tax').val(),
                    discount: $('#discount').val(),
                    shipping: $('#shipping').val(),
                    status: $('#status').val(),
                    payment_status: $('#payment_status').val(),
                    payment_method: $('#payment_method').val(),
                    amount_recieved: $('#amount_recieved').val(),
                    amount_pay: $('#amount_pay').val(),
                    change_return: $('#change_return').text(),
                    note: $('#notes').val(),
                    invoice_id: $('#invoice_input_id').val(),
                    warehouse_id: $('#warehouse_id').val(),
                    grand_total: parseFloat(document.getElementById('grand_total').textContent.replace(
                        '$', '')),
                    //amount_due will be result of grand total - amount_recieved
                    amount_due: parseFloat(document.getElementById('grand_total').textContent.replace(
                        '$', '')) - parseFloat($('#amount_recieved').val()) || 0,

                    order_items: []
                };

                // Collect order items
                $('#mainTable tbody tr').each(function() {
                    let item = {
                        id: $(this).find('td:nth-child(10) .item-edit').data('product').id,
                        quantity: $(this).find('td:nth-child(6) input').val(),
                        discount: $(this).find('td:nth-child(7)').text(),
                        discount_type: $(this).find('td:nth-child(10) .item-edit').data(
                            'product').discount_type,
                        tax_type: $(this).find('td:nth-child(10) .item-edit').data('product')
                            .tax_type,
                        order_tax: $(this).find('td:nth-child(8)').text(),
                        sale_unit: $(this).find('td:nth-child(5) span').data('converted-unit'),
                        price: $(this).find('td:nth-child(4)').text(),
                        subtotal: $(this).find('td:nth-child(9)').text(),
                        stock: $(this).find('td:nth-child(5)').text(),
                    };
                    if (item.quantity == 0) {
                        toastr.error("Please increment quantity!");
                        die;
                    }
                    formData.order_items.push(item);

                });

                // AJAX request to server
                $.ajax({
                    url: '{{ route('sales.store') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    success: function(response) {
                        console.log(response);
                        toastr.success('Sale created successfully!');
                        window.location.href = "{{ route('sales.index') }}";
                        console.log('Success:', response);
                    },

                    error: function(xhr) {
                        if (xhr.status === 422) { // If validation fails
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                toastr.error(value[0]); // Display first error message
                            });
                        } else {
                            toastr.error('An error occurred while processing your request.');
                        }
                    }
                });
            });
        });


        $(document).ready(function() {
            // Add click event handler to all table rows
            $('.table .tr').click(function() {
                var details = $(this).data('details');
                var type = $(this).data('type');
                console.log(details);
                // return;
                details['type'] = type;
                // Check if the cartItem already exists in the cart-list
                var exists = false;
                $('#cart-list .item').each(function() {
                    var existingDetails = $(this).data('details');
                    if (existingDetails.id === details.id && existingDetails.type === type) {
                        exists = true;
                        return false; // Break the loop
                    }
                });
                // console.log(details);
                if (exists) {
                    alert('Item already exists in the cart');
                    return;
                }

                let cartItem;
                if (type == "service") {
                    cartItem = `

                    <div class="card item" data-details='${JSON.stringify(details)}'>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="d-flex justify-content-between">
                                                <h5>${details.name ?? ''}</h5>
                                                <div>
                                                    <a href="#" class="edit-btn" data-bs-target="#exampleModalToggle"
                                                        data-bs-toggle="modal" id="item-edit">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="#" class="ms-2 trash-btn" style="cursor:pointer;">
                                                        <i class="bi bi-trash-fill text-danger"></i>
                                                    </a>
                                                </div>

                                            </div>
                                            <div class="d-flex justify-content-between">
                            <span>${details.duration ?? ''}</span>
                            <span>$${details.price}</span>
                        </div>
                                        </div>
                                    </div>
                                </div>
                    `;
                } else if (type == 'product') {
                    cartItem = `

                                <div class="card item" data-details='${JSON.stringify(details)}'>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="d-flex justify-content-between">
                                                <h5>${details.name ?? ''}</h5>
                                                <div>
                                                    <a href="#" class="edit-btn" data-bs-target="#exampleModalToggle"
                                                        data-bs-toggle="modal" id="item-edit">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="#" class="ms-2 trash-btn" style="cursor:pointer;">
                                                        <i class="bi bi-trash-fill text-danger"></i>
                                                    </a>
                                                </div>

                                            </div>
                                            <div class="d-flex justify-content-between">
                                            <span>${details.barcodes[0]['code'] ?? ''}</span>
                                            <span>$${details.price}</span>
                                        </div>
                                        </div>
                                    </div>
                                </div>



                                `;
                }
                else if (type == 'membership') {
                    cartItem = `
                                <div class="card item" data-details='${JSON.stringify(details)}'>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="d-flex justify-content-between">
                                                <h5>${details.name ?? ''}</h5>
                                                <div>
                                                    <a href="#" class="edit-btn" data-bs-target="#exampleModalToggle"
                                                        data-bs-toggle="modal" id="item-edit">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="#" class="ms-2 trash-btn" style="cursor:pointer;">
                                                        <i class="bi bi-trash-fill text-danger"></i>
                                                    </a>
                                                </div>

                                            </div>
                                            <div class="d-flex justify-content-between">
                                            <span>${details.no_of_session+" sessions" ?? ''} . ${details.total_service+" services" ?? ''}</span>
                                            <span>$${details.price}</span>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                `;
                }
                else if (type == 'appointment') {
                    cartItem = `
                                <div class="card item" data-details='${JSON.stringify(details)}'>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="d-flex justify-content-between">
                                                <h5>${details.name ?? ''}</h5>
                                                <div>
                                                    <a href="#" class="edit-btn" data-bs-target="#exampleModalToggle"
                                                        data-bs-toggle="modal" id="item-edit">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="#" class="ms-2 trash-btn" style="cursor:pointer;">
                                                        <i class="bi bi-trash-fill text-danger"></i>
                                                    </a>
                                                </div>

                                            </div>
                                            <div class="d-flex justify-content-between">
                                            <span>${details.total_services+" services" ?? ''}</span>
                                            <span>$${details.price}</span>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                `;
                }

                // Append the cart item to the cart-list div
                $('#cart-list').append(cartItem);
                calculate()
            });

            // Add click event handler to trash buttons within the cart items
            $('#cart-list').on('click', '.trash-btn', function() {
                // Find the parent cart item and remove it
                $(this).closest('.item').remove();
                calculate();
            });


            $('#cart-list').on('click', '.edit-btn', function() {
                var dataDetails = $(this).closest('.item').data('details');
                // console.log("det"+ dataDetails);
                $('#item-head').text(`Edit ${dataDetails.type}`);
                $('#item_name').text(dataDetails.name);
                $('#item_price').text(`$${dataDetails.price}`);

                if (dataDetails.type == 'service') {
                    $('#item_info').text(dataDetails.duration);
                    $('#qty').prop('disabled', false);
                } else if (dataDetails.type == 'product') {
                    $('#item_info').text(dataDetails.barcodes[0]['code']);
                    $('#qty').prop('disabled', false);
                } else if (dataDetails.type == 'membership') {
                    $('#item_info').text(dataDetails.no_of_session + " sessions . " + dataDetails
                        .total_service + " services");
                    $('#qty').prop('disabled', true);
                }
                else if(dataDetails.type == 'appointment'){
                    $('#item_info').text(dataDetails.total_services + " services");
                    $('#qty').prop('disabled', true);
                }
                // $('#item_info').text();
                if (dataDetails.updatedPrice) {
                    $('#product_price').val(dataDetails.updatedPrice);
                    $('#qty').val(dataDetails.saleQuantity);
                } else {
                    $('#product_price').val(dataDetails.price);
                    $('#qty').val(1);
                }

                $('#saveChangesButton').attr('data-details', JSON.stringify(dataDetails));
            });

            $('#saveChangesButton').click(function() {
                const details = JSON.parse($('#saveChangesButton').attr('data-details'));
                console.log(details);

                const updatedPrice = parseFloat($('#product_price').val());
                const saleQuantity = parseInt($('#qty').val());
                const team_member = $('#team_member').val();
                $('.item').each(function() {
                    if ($(this).data('details').id == details.id && $(this).data('details').type ==
                        details.type) {
                        $(this).data('details').updatedPrice = updatedPrice;
                        $(this).data('details').saleQuantity = saleQuantity;
                        $(this).data('details').team_member = team_member;

                        if ($(this).data('details').price != updatedPrice) {
                            $(this).find('span').eq(1).text(`$${updatedPrice}`);
                        }
                        if ($(this).data('details').saleQuantity != 1) {
                            $(this).find('span').eq(1).text(`${saleQuantity}x $${updatedPrice}`);
                        }
                        // $(this).find('span').eq(0).text(`${saleQuantity}x $${updatedPrice}`);
                    }
                });

                calculate();
                $('#exampleModalToggle .btn-close').trigger('click');

            });

            $('#addCartDisModelBtn').click(function() {
                $('#discount_amount').val(0);
                $('#totalAfterDiscount').text(`$${parseFloat($('#subTotal').text().replace('$', ''))}`);
            });

            $('#discount_amount').on('input', function() {
                if ($('#percentageRadio').is(':checked')) {
                    const discountAmount = $(this).val();
                    // formula to calculate discount  percentage
                    // Discounted Price = Original Price - (Original Price * Discount Amount / 100)
                    const totalAfterDiscount = parseFloat($('#subTotal').text().replace('$', '')) - (
                        discountAmount / 100) * $('#subTotal').text().replace('$', '');
                    $('#totalAfterDiscount').text(`$${totalAfterDiscount.toFixed(2)}`);
                } else {
                    const discountAmount = parseFloat($(this).val());
                    const totalAfterDiscount = parseFloat($('#subTotal').text().replace('$', '')) -
                        discountAmount;
                    $('#totalAfterDiscount').text(`$${totalAfterDiscount.toFixed(2)}`);
                }

            });

            $('#saveDiscountChangesButton').click(function() {
                let discountAmount = $('#subTotal').text().replace('$', '') - $('#totalAfterDiscount')
                    .text().replace('$', '');
                let newDiv =
                    `
                    <div class="d-flex justify-content-between" id="discountDiv">
                        <span class="">Discount:</span>
                        <span class="" id="discountedAmount">- $${discountAmount.toFixed(2)}</span>
                    </div>
                `;
                if ($('#discountDiv').length) {
                    $('#discountDiv').remove();
                }
                $('#subTotalDiv').after(newDiv);
                const totalAfterDiscount = $('#totalAfterDiscount').text().replace('$', '');
                $('#toPay').text(`$${totalAfterDiscount}`);
                $('#grand_total').text(`$${totalAfterDiscount}`);
                $('#exampleModalToggle3 .btn-close').trigger('click');
            });

            $('#saveSaleNoteChangesButton').click(function() {

                $('#exampleModalToggle4 .btn-close').trigger('click');
            })



        });

        function calculate() {
            var grand_total = 0;
            var total = 0;
            $('.item').each(function() {
                if (parseFloat($(this).data('details').price)) {
                    let price = parseFloat($(this).data('details').price);
                    let quantity = 1;
                    // if($(this).data('details').)
                    if (parseFloat($(this).data('details').updatedPrice)) {
                        price = parseFloat($(this).data('details').updatedPrice);
                        quantity = parseFloat($(this).data('details').saleQuantity);
                    }

                    total += price * quantity;

                    // console.log(parseFloat($(this).data('details').price));
                }

                grand_total = total;
                $('#toPay').text(`$${total}`);
                if (parseFloat(parseFloat($(this).data('details').price) && $(this).data('details').fee)) {
                    grand_total = total + parseFloat($(this).data('details').fee);
                }

            });
            $('#subTotal').text(`$${total}`);
            $('#grand_total').text(`$${grand_total}`);
            if ($('#discountedAmount').length) {
                grand_total = grand_total - parseFloat($('#discountedAmount').text().replace('- $', ''));
                $('#toPay').text(`$${grand_total}`);
                $('#grand_total').text(`$${grand_total}`);

            }
        }

        // $(document).ready(function() {
        //     // Add click event handler to all table rows
        //     $('table tr').click(function() {
        //         var details = $(this).data('details');
        //         var type = $(this).data('type');
        //         // var details = JSON.parse($(this).attr('data-details'));
        //         // var type = JSON.parse($(this).attr('data-type'));
        //         // details = JSON.parse(details);
        //         // details["type"] = type;
        //         console.log(details);

        //         // Create the HTML snippet for the cart item
        //         // var cartItem =
        //         //     '<div class="p-2 item mt-2" style="border-left: 2px solid black;background-color:aliceblue" data-details="' +
        //         //     JSON.stringify(details) + '">' +
        //         //     '<div class="d-flex justify-content-between">' +
        //         //     '<div>'+ details.name +'</div>' +
        //         //     '<div>' +
        //         //     '<a href="#" class="edit-btn" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" id="item-edit">' +
        //         //     '<i class="bi bi-pencil-square"></i>' +
        //         //     '</a>' +
        //         //     '<a class="ms-2  trash-btn" style="cursor:pointer;">' +
        //         //     '<i class="bi bi-trash-fill text-danger"></i>' +
        //         //     '</a>' +
        //         //     '</div>' +
        //         //     '</div>' +
        //         //     '<div class="d-flex justify-content-end">' +
        //         //     '<span>$'+details.price+'</span>' +
        //         //     '</div>' +
        //         //     '</div>';

        //         let cartItem;
        //         if (type == "service") {
        //             cartItem = `
    //             <div class="p-2 item mt-2" style="border-left: 2px solid black;background-color:aliceblue" data-details="${JSON.stringify(details)}">
    //                 <div class="d-flex justify-content-between">
    //                     <div>${details.name ?? ''}</div>
    //                     <div>
    //                         <a href="#" class="item-edit edit-btn" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" id="item-edit">
    //                             <i class="bi bi-pencil-square"></i>
    //                         </a>
    //                         <a class="ms-2 trash-btn" style="cursor:pointer;">
    //                             <i class="bi bi-trash-fill text-danger"></i>
    //                         </a>
    //                     </div>
    //                 </div>
    //                 <div class="d-flex justify-content-between">
    //                     <span>${details.duration ?? ''}</span>
    //                     <span>$${details.price}</span>
    //                 </div>
    //             </div>`;
        //         } else if (type == 'product') {
        //             cartItem = `
    //                     <div class="p-2 item mt-2" style="border-left: 2px solid black;background-color:aliceblue" data-details="${details}">
    //                                 <div class="d-flex justify-content-between">
    //                                     <div>${details.name ?? ''}</div>
    //                                     <div>
    //                                         <a href="#" class="item-edit edit-btn" data-bs-target="#exampleModalToggle"
    //                                             data-bs-toggle="modal" id="item-edit">
    //                                             <i class="bi bi-pencil-square"></i>
    //                                         </a>
    //                                         <a class="ms-2 trash-btn" style="cursor:pointer;">
    //                                             <i class="bi bi-trash-fill text-danger"></i>
    //                                         </a>
    //                                     </div>

    //                                 </div>
    //                                 <div class="d-flex justify-content-between">
    //                                     <span>${details.barcodes[0]['code'] ?? ''}</span>
    //                                     <span>$${details.price}</span>
    //                                 </div>

    //                         </div>`;
        //         } else if (type == 'membership') {
        //             cartItem = `<div class="p-2 item mt-2" style="border-left: 2px solid black;background-color:aliceblue" data-details="${details}">
    //                                 <div class="d-flex justify-content-between">
    //                                     <div>${details.name ?? ''}</div>
    //                                     <div>
    //                                         <a href="#" class="item-edit edit-btn" data-bs-target="#exampleModalToggle"
    //                                             data-bs-toggle="modal" id="item-edit">
    //                                             <i class="bi bi-pencil-square"></i>
    //                                         </a>
    //                                         <a class="ms-2 trash-btn" style="cursor:pointer;">
    //                                             <i class="bi bi-trash-fill text-danger"></i>
    //                                         </a>
    //                                     </div>

    //                                 </div>
    //                                 <div class="d-flex justify-content-between">
    //                                     <span>${details.no_of_session+" sessions" ?? ''} . ${details.total_service+" services" ?? ''}</span>
    //                                     <span>$${details.price}</span>
    //                                 </div>

    //                         </div>`;
        //         }

        //         // Append the cart item to the cart-list div
        //         $('#cart-list').append(cartItem);
        //     });

        //     // Add click event handler to trash buttons within the cart items
        //     $('#cart-list').on('click', '.trash-btn', function() {
        //         // Find the parent cart item and remove it
        //         $(this).closest('.item').remove();
        //     });



        //     // Add click event handler to edit buttons within the cart items
        //     // $('#cart-list').on('click', '.edit-btn', function() {
        //     //     // Get the details from the cart item
        //     //     var details = $(this).closest('.item').data('details');
        //     //     console.log(details);
        //     //     // console.log(JSON.parse(details));
        //     //     // Populate the modal with the details
        //     //     // $('#product_price').val(details.price);
        //     // });

        //     $('#cart-list').on('click', '.edit-btn', function() {
        //         // Get the details from the cart item
        //         var details = $(this).closest('.item').data('details');
        //         // var details = $(this).closest('.item').attr('data-details');

        //         // console.log(JSON.stringify(details, null, 2)); // Log details object
        //         // details = JSON.parse(details);
        //         console.log(details);
        //     });

        // });
        $(document).on('click', '#addCashPaymentModelBtn', function() {
            const grandTotal = parseFloat(document.getElementById('toPay').textContent.replace('$',
                ''));
            console.log(grandTotal);
            $('#paying_amount').val(grandTotal);
            $('#cash_received').val(grandTotal);
        });
        $(document).on('input', '#cash_received', function() {

            var payingAmount = parseFloat($('#paying_amount').val());
            var cashReceived = parseFloat($(this).val());

            if (isNaN(cashReceived)) {
                cashReceived = 0;
            }

            var leftToPay = payingAmount - cashReceived;
            var cashReturn = 0;

            if (leftToPay < 0) {
                cashReturn = Math.abs(leftToPay);
                leftToPay = 0;
            }

            $('#due').val(leftToPay.toFixed(2));
            $('#cash_return').val(cashReturn.toFixed(2));
        });

        $(document).on('click', '#saveCashPaymentBtn', function() {
            // alert("cash");
            var payingAmount = parseFloat($('#paying_amount').val());
            var cashReceived = parseFloat($('#cash_received').val());
            var dueAmount = parseFloat($('#due').val());
            var cashReturn = parseFloat($('#cash_return').val());
            console.log(cashReceived);
            if (cashReceived < payingAmount) {
                let cashDiv =
                    `
                <hr id="cashDivHr">
                <div class="d-flex justify-content-between align-items-center mb-2 mt-2" id="cashAmountDiv">
                    <p>Cash:</p>
                    <span class=" fw-bold" id="cash_amount_received">$${cashReceived}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2 mt-2" id="dueAmountDiv">
                    <p>Left to pay:</p>
                    <span class=" fw-bold" id="due_amount_span">$${dueAmount}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2 mt-2" id="returnAmountDiv">
                    <p>Cash Return:</p>
                    <span class=" fw-bold" id="return_amount_span">$${cashReturn}</span>
                </div>
                `;
                if ($('#cashAmountDiv').length) {
                    $('#cashDivHr').remove();
                    $('#cashAmountDiv').remove();
                    $('#dueAmountDiv').remove();
                    $('#returnAmountDiv').remove();
                }
                $('#grandTotalDiv').after(cashDiv);
                if ($('#toPayDiv').css('visibility', 'hidden')) {
                    $('#toPayDiv').css('visibility', 'visible')
                }
                if ($('#fullPaymentAddedHeading')) {
                    $('#fullPaymentAddedHeading').remove();
                }
                $('#toPayDiv span').css('visibility', 'hidden');
                $('#toPayDiv').append(`<span class="fw-bold" id="dueAmountSpan">$${dueAmount}</span>`);
                $('#addPaymentModelBtn').text('Submit');
                $('#addPaymentModelBtn').attr('id', 'submitSaleBtn');
                $('#exampleModalToggle6 .btn-close').trigger('click');
            } else {
                let cashDiv =
                    `
                <hr id="cashDivHr">
                <div class="d-flex justify-content-between align-items-center mb-2 mt-2" id="cashAmountDiv">
                    <p>Cash:</p>
                    <span class=" fw-bold" id="cash_amount_received">$${cashReceived}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2 mt-2" id="dueAmountDiv">
                    <p>Left to pay:</p>
                    <span class=" fw-bold" id="due_amount_span">$${dueAmount}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2 mt-2" id="returnAmountDiv">
                    <p>Cash Return:</p>
                    <span class=" fw-bold" id="return_amount_span">$${cashReturn}</span>
                </div>
                `;
                if ($('#cashAmountDiv').length) {
                    $('#cashDivHr').remove();
                    $('#cashAmountDiv').remove();
                    $('#cashAmountDiv').remove();
                    $('#dueAmountDiv').remove();
                    $('#returnAmountDiv').remove();
                }
                $('#grandTotalDiv').after(cashDiv);
                // if($('#toPayDiv #dueAmountSpan')){
                //     $('#toPayDiv #dueAmountSpan').remove();
                // }
                // $('#toPayDiv span').css('visibility', 'visible');
                $('#toPayDiv').css('visibility', 'hidden');
                if ($('#fullPaymentAddedHeading')) {
                    $('#fullPaymentAddedHeading').remove();
                }
                $('#toPayDiv').after(`<h5 id="fullPaymentAddedHeading">Full Payment Added<h5>`);
                $('#addPaymentModelBtn').text('Submit');
                $('#addPaymentModelBtn').attr('id', 'submitSaleBtn');
                $('#exampleModalToggle6 .btn-close').trigger('click');
            }
        })

        $(document).on('click', '#submitSaleBtn', function() {
            const cashRecieved = parseFloat($('#cash_received').val());
            const grandTotal = parseFloat(document.getElementById('toPay').textContent.replace('$',
                ''));
            // const cashReturn = parseFloat($('#cash_return').val());
            // const paymentMethod = $('#payment_method').val();
            // const saleNote = $('#sale_note').val();
            // if (cashRecieved < grandTotal) {
            //     alert('Received amount is less than paying amount!');
            //     return;
            // }
            // if ($('#client_id').val() == '') {
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Oops...',
            //         text: 'Please select a client!',
            //     })
            // }

            let formData = {
                client_id: $('#client_id').val(),
                sub_total: parseFloat($('#subTotal').text().replace('$', '')),
                grand_total: parseFloat($('#grand_total').text().replace('$', '')),
                discount: parseFloat($('#discountedAmount').text().replace('- $', '')) || 0,
                // payment_method: $('input[name="payment_method"]:checked').val() || 0,
                payment_method: $('#payment_method').val(),
                cash_received: parseFloat($('#cash_amount_received').text().replace('$', '')) || 0,
                cash_return: parseFloat($('#return_amount_span').text().replace('$', '')) || 0,
                due_amount: parseFloat($('#due_amount_span').text().replace('$', '')) || 0,
                sale_note: $('#sale_note').val() || '',
                cash_received_by: $('#cash_received_by').val() || '',
                order_items: [],
            }

            $('.item').each(function() {
                if ($(this).data('details').price) {
                    let item = {
                        item_id: $(this).data('details').id,
                        type: $(this).data('details').type,
                        team_member: $(this).data('details').team_member,
                        quantity: $(this).data('details').saleQuantity ? $(this).data(
                            'details').saleQuantity : 1,
                        price: $(this).data('details').updatedPrice ? $(this).data(
                            'details').updatedPrice : $(this).data('details').price,
                        sub_total: $(this).data('details').updatedPrice ?
                            $(this).data('details').updatedPrice * ($(this).data('details')
                                .saleQuantity ? $(this).data('details').saleQuantity : 1) : $(this)
                            .data('details').price * ($(this).data('details')
                                .saleQuantity ? $(this).data('details').saleQuantity : 1),
                    };
                    formData.order_items.push(item);
                }
            });


            // AJAX request to server
            $.ajax({
                url: "{{ route('sales.store') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                success: function(response) {
                    console.log(response);
                    if (response.status) {
                        Swal.fire({
                            title: "Success!",
                            text: response.message,
                            icon: "success"
                        });

                        // Refresh

                        window.location.href = "{{ route('sales.index') }}";
                    }

                    // console.log('Success:', response);
                },
                error: function(xhr, status, error) {
                    // console.log('Error:', error);
                    // if (error.status === 422) {
                    //     var errors = error.responseJSON.errors;
                    //     $.each(errors, function(key, value) {
                    //         toastr.error(value[0]);
                    //     });
                    // } else {
                    //     toastr.error('An error occurred while processing your request.');
                    // }
                    var errors = xhr.responseJSON.message;

                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                html: errors
                            });
                }
            });

        })
        $(document).on('click', '#saveUnpaid', function() {

            let formData = {
                client_id: $('#client_id').val(),
                sub_total: parseFloat($('#subTotal').text().replace('$', '')),
                grand_total: parseFloat($('#grand_total').text().replace('$', '')),
                discount: parseFloat($('#discountedAmount').text().replace('- $', '')) || 0,
                payment_method: '',
                // payment_method: $('#payment_method').val(),
                cash_received: 0.00,
                cash_return: 0.00,
                due_amount: parseFloat($('#grand_total').text().replace('$', '')) || 0.00,
                sale_note: $('#sale_note').val() || '',
                status:"Unpaid",
                // cash_received_by: $('#cash_received_by').val() || '',
                order_items: [],
            }

            $('.item').each(function() {
                if ($(this).data('details').price) {
                    let item = {
                        item_id: $(this).data('details').id,
                        type: $(this).data('details').type,
                        team_member: $(this).data('details').team_member,
                        quantity: $(this).data('details').saleQuantity ? $(this).data(
                            'details').saleQuantity : 1,
                        price: $(this).data('details').updatedPrice ? $(this).data(
                            'details').updatedPrice : $(this).data('details').price,
                        sub_total: $(this).data('details').updatedPrice ?
                            $(this).data('details').updatedPrice * ($(this).data('details')
                                .saleQuantity ? $(this).data('details').saleQuantity : 1) : $(this)
                            .data('details').price * ($(this).data('details')
                                .saleQuantity ? $(this).data('details').saleQuantity : 1),
                    };
                    formData.order_items.push(item);
                }
            });


            // AJAX request to server
            $.ajax({
                url: "{{ route('sales.store') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                success: function(response) {
                    console.log(response);
                    if (response.status) {
                        Swal.fire({
                            title: "Success!",
                            text: response.message,
                            icon: "success"
                        });

                        // Refresh

                        window.location.href = "{{ route('sales.index') }}";
                    }

                    // console.log('Success:', response);
                },
                error: function(xhr, status, error) {
                    // console.log('Error:', error);
                    // if (error.status === 422) {
                    //     var errors = error.responseJSON.errors;
                    //     $.each(errors, function(key, value) {
                    //         toastr.error(value[0]);
                    //     });
                    // } else {
                    //     toastr.error('An error occurred while processing your request.');
                    // }
                    var errors = xhr.responseJSON.message;

                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                html: errors
                            });
                }
            });

        })
        // Event delegation for dynamically added radio buttons
        $(document).on('change', 'input[name="payment_method"]', function() {
            var selectedValue = $('input[name="payment_method"]:checked').val();
            console.log('Selected payment method (on change):', selectedValue);
        });
    </script>

@endsection
