@extends('back.layout.app')
@section('title', 'Edit Sale')
@section('style')
    <link href="{{ asset('back/assets/js/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <style>
        .ui-autocomplete {
            padding: 0 !important;
        }

        .ui-menu .ui-menu-item-wrapper {
            text-align: left;
        }
    </style>
@endsection

@section('content')

    <div class="content">

        <div class="container-fluid pt-4 px-4 mb-5">
            <div class="border-bottom">
                <h3 class="all-adjustment text-center pb-2 mb-0">Edit Sale</h3>
            </div>
            <form class="container-fluid" action="{{ route('sales.update', $sale->id) }}" method="POST" id="createSaleForm">
                @csrf
                @method('PUT')
                <div class="card card-shadow rounded-3 border-0 mt-5">
                    <div class="card-body">


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1" class="mb-1 fw-bold">Date <span
                                            class="text-danger">*</span></label>

                                    <input class="form-control subheading" type="date" value="{{ $sale->date }}" />

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1" class="mb-1 fw-bold">Customer <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control form-select subheading mt-1" required
                                        aria-label="Default select example" name="customer_id" id="customers">
                                        <option>Select customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                data-phone="{{ $customer->user->contact_no }}"
                                                data-email="{{ $customer->user->email }}"
                                                data-name={{ $customer->user->name }}
                                                {{ $customer->id == $sale->customer->id ? 'selected' : '' }}>
                                                {{ $customer->user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1" class="mb-1 fw-bold">Warehouse <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control form-select subheading mt-1"
                                        aria-label="Default select example" name="warehouse_id"id="warehouse_id" disabled>
                                        <option value="">Select Warehouse</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}"
                                                {{ $sale->warehouse->id == $warehouse->id ? 'selected' : '' }}>
                                                {{ $warehouse->users->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <label for="exampleFormControlSelect1" class="mb-1 fw-bold">Product</label>
                            <div class="input-group">
                                <input type="text" class="form-control subheading" placeholder="Product Code / Name"
                                    id="product_code" name="product_code" />
                                <div id="suggestionsContainer"></div>

                                <span class="input-group-text subheading" id="basic-addon2"><i
                                        class="bi bi-upc-scan"></i></span>
                                {{-- <div class="search-dropdown" id="searchDropdown" style=" display: none;"></div> --}}
                            </div>
                            <p class="subheading m-0 p-0">
                                Scan the barcode or enter symbology
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card card-shadow rounded-3 border-0 mt-4 p-3">
                    <div class="table-responsive">
                        <table class="table text-center" id="mainTable">
                            <h3 class="all-adjustment text-center pb-1">Order Items</h3>
                            <thead class="fw-bold">
                                <tr>
                                    <th class="align-middle">#</th>
                                    <th class="align-middle">Product Name</th>
                                    <th class="align-middle">Product Code</th>
                                    <th class="align-middle">Net Unit Price</th>
                                    <th class="align-middle">Stock</th>
                                    <th class="align-middle">Qty</th>
                                    <th class="align-middle">Discount</th>
                                    <th class="align-middle">Tax</th>
                                    <th class="align-middle">Subtotal</th>
                                    <th class="align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sale->productItems as $product)
                                    @php
                                        $warehouse_product = \App\Models\ProductWarehouse::where(
                                            'product_id',
                                            $product->product->id,
                                        )
                                            ->where('warehouse_id', $sale->warehouse_id)
                                            ->first();

                                        $quantity = $warehouse_product->quantity;
                                        $product->product->warehouse_quantity = $quantity;

                                        if ($product->product->product_type != 'service') {
                                            if ($product->product->product_unit != $product->sale_units?->id) {
                                                if ($product->product->unit->parent_id == 0) {
                                                    $expression =
                                                        $warehouse_product->quantity .
                                                        $product->product->unit->operator .
                                                        $product->sale_units?->operator_value;
                                                    $quantity = eval("return $expression;");
                                                }
                                            }
                                        }
                                        // dd($quantity);
                                    @endphp
                                    <tr>
                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                        <td class="product_name align-middle ">{{ $product->product->name }}</td>
                                        <td class=" align-middle ">{{ $product->product->sku }}</td>
                                        <td class="product_sell_price align-middle ">{{ $product->price ?? '' }}</td>
                                        <td class="align-middle">
                                            {{-- <span class="badges bg-darkwarning p-1" data-converted-unit="{{ $product->sale_units?->id ? $product->sale_units?->id : '' }}">{{ $quantity ?? '' }}{{ $product->sale_units?->short_name ? $product->sale_units?->short_name : '' }}</span> --}}
                                            <span class="badges bg-darkwarning p-1"
                                                data-converted-unit="{{ $product->sale_units?->id ? $product->sale_units?->id : '' }}">{{ $quantity ?? '' }}{{ $product->sale_units?->short_name ? $product->sale_units?->short_name : '' }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <div class="quantity d-flex justify-content-center align-items-center">
                                                <button type="button" class="btn qty-minus-btn" id="minusBtn">
                                                    <i class="fa-solid fa-minus"></i>
                                                </button>
                                                <input type="number" id="quantityInput"
                                                    class="product_qty border-0 qty-input "
                                                    value="{{ $product->quantity ?? '' }}" min="0" />
                                                <button type="button" class=" btn qty-plus-btn" id="plusBtn">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td class="align-middle">{{ $product->discount ?? '' }}</td>
                                        <td class="align-middle">{{ $product->order_tax ?? '' }}</td>
                                        <td class="product_price align-middle">{{ $product->sub_total ?? '' }}</td>
                                        <td class="align-middle">
                                            <div class="d-flex justify-content-center">
                                                <a href="#" class="btn item-edit"
                                                    data-product="{{ $product->product ?? '' }}"
                                                    data-productItem-unit="{{ $product->sale_units?->id ? $product->sale_units?->id : false }}"
                                                    data-bs-target="#exampleModalToggle" data-bs-toggle="modal"
                                                    id="item-edit">
                                                    <img src="{{ asset('back/assets/dasheets/img/edit-2.svg') }}"
                                                        alt="" />
                                                </a>
                                                <a href="#" class="btn btn-plus item-delete">
                                                    <img src="{{ asset('back/assets/dasheets/img/plus-circle.svg') }}"
                                                        alt="" />
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-2 px-3">
                        <div class="col-md-8"></div>
                        <div class="col-md-4 border rounded-2">
                            <div class="row border-bottom subheading">
                                <div class="col-md-6 col-6">Order Tax</div>
                                <div class="col-md-6 col-6" id="order_tax_display">AED{{ $sale->order_tax ?? '' }}</div>
                                {{-- <span> (0.00%)</span> --}}
                            </div>

                            <div class="row border-bottom">
                                <div class="col-md-6 col-6">Discount</div>
                                <div class="col-md-6 col-6" id="discount_display">AED{{ $sale->discount ?? '' }}</div>
                            </div>

                            <div class="row border-bottom">
                                <div class="col-md-6 col-6">Shipping</div>
                                <div class="col-md-6 col-6" id="shipping_display">AED{{ $sale->shipping ?? '' }}</div>
                            </div>

                            <div class="row disabled-bg">
                                <div class="col-md-6 col-6">Grand Total</div>
                                <div class="col-md-6 col-6" id="grand_total">AED{{ $sale->grand_total ?? '' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Input Fields -->
                <div class="card card-shadow rounded-3 border-0 mt-4 p-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ntn_no" class="mb-1 fw-bold">Tax ID:</label>
                                    <input type="text" placeholder="e.g: 349887645" class="form-control subheading"
                                        id="ntn_no" value="{{ $sale->ntn ?? '' }}" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="order_tax" class="mb-1 fw-bold">Order Tax</label>
                                    <input type="number" placeholder="0%" class="form-control subheading"
                                        id="order_tax" value="{{ $sale->order_tax ?? '' }}" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="discount" class="mb-1 fw-bold">Discount</label>
                                    <input type="number" placeholder="$0.00" class="form-control subheading"
                                        id="discount" value="{{ $sale->discount ?? '' }}" />

                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="shipping" class="mb-1 fw-bold">Shipping </label>
                                    <input type="number" placeholder="$0.00" class="form-control subheading"
                                        id="shipping" value="{{ $sale->shipping ?? '' }}" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status" class="mb-1 fw-bold">Status <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control form-select subheading"
                                        aria-label="Default select example" id="status">
                                        <option value="completed" {{ $sale->status == 'completed' ? 'selected' : '' }}>
                                            Completed</option>
                                        <option value="pending" {{ $sale->status == 'pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="ordered" {{ $sale->status == 'ordered' ? 'selected' : '' }}>Ordered
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="payment_status" class="mb-1 fw-bold">Payment Status</label>
                                    <select class="form-control form-select subheading"
                                        aria-label="Default select example" id="payment_status">
                                        <option value="paid" {{ $sale->payment_status == 'paid' ? 'selected' : '' }}>
                                            Paid</option>
                                        <option value="partial"
                                            {{ $sale->payment_status == 'partial' ? 'selected' : '' }}>Partial</option>
                                        <option value="pending"
                                            {{ $sale->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2" id="sale-calc"
                            style="display:{{ $sale->payment_status == 'pending' ? 'none' : '' }};">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="payment_method" class="mb-1 fw-bold">Payment Method</label>
                                    <select class="form-control form-select subheading"
                                        aria-label="Default select example" id="payment_method">
                                        <option value="Cash" {{ $sale->payment_method == 'Cash' ? 'selected' : '' }}>
                                            Cash</option>
                                        <option value="Card" {{ $sale->payment_method == 'Card' ? 'selected' : '' }}>
                                            Card</option>
                                        <option value="On Account"
                                            {{ $sale->payment_method == 'On Account' ? 'selected' : '' }}>On Account
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="amount_recieved" class="mb-1 fw-bold">Cash Recieved</label>
                                    <input type="text" placeholder="$0.00" class="form-control subheading"
                                        id="amount_recieved" value="{{ $sale->amount_recieved ?? '' }}" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="amount_pay" class="mb-1 fw-bold">Paying Amount</label>
                                    <input type="text" placeholder="$0.00" class="form-control subheading"
                                        id="amount_pay" {{ $sale->amount_pay ?? '' }} />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="change_return" class="mb-1 fw-bold">Cash Return</label>
                                    <p class="subheading" id="change_return">{{ $sale->change_return ?? '' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <label for="notes" class="mb-1 fw-bold">Note</label>
                            <textarea class="form-control subheading" id="notes" placeholder="Add Note" rows="5">{{ $sale->notes }}</textarea>
                        </div>
                    </div>
                </div>
                <!-- Input Fields End -->
                <button class="btn btn btn-success add-btn mt-3" type="button" data-bs-target="#saleInvoiceModal"
                    data-bs-toggle="modal">Submit</button>

                {{-- Sale Invoice Model --}}
                <div class="modal fade" id="saleInvoiceModal" aria-hidden="true"
                    aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-fullscreen">
                        <div class="modal-content" style="background: rgb(0 0 0 / 79%)">
                            <div class="modal-header border-0">
                                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-5 col-12">
                                            <h3 class="all-adjustment text-center pb-1 text-white sale-generated"
                                                style="width: 40%">
                                                Sale Generated
                                            </h3>
                                            <p class="text-white mt-5">
                                                Sale Generated against the user below for amount of $300,
                                                You can print a paper bill or
                                                <span class="go-green">GO GREEN.</span>
                                            </p>
                                            <p class="text-secondary">
                                                (Going green will send bill by SMS and Email)
                                            </p>

                                            <div class="form-group text-white print-overlay">
                                                <label for="nameInput" class="mb-1 fw-bold">Customer Name</label>
                                                <input type="text" placeholder="Phone No"
                                                    class="form-control subheading text-white" style="background: none"
                                                    id="nameInput" />
                                            </div>
                                            <div class="form-group text-white print-overlay mt-2">
                                                <label for="phoneInput" class="mb-1 fw-bold">Phone No.</label>
                                                <input type="text" placeholder="Phone No"
                                                    class="form-control subheading text-white" style="background: none"
                                                    id="phoneInput" />
                                            </div>
                                            <div class="form-group text-white print-overlay mt-2">
                                                <label for="exampleFormControlSelect1" class="mb-1 fw-bold">Email</label>
                                                <input type="email" placeholder="Phone No"
                                                    class="form-control subheading text-white" style="background: none"
                                                    id="emailInput" />
                                            </div>
                                            {{-- <div class="form-group text-white print-overlay mt-2">
                                                <label for="exampleFormControlSelect1" class="mb-1 fw-bold">Sales Tax ID</label>
                                                <input type="text" placeholder="Phone No"
                                                    class="form-control subheading text-white" style="background: none"
                                                    id="exampleFormControlInput1" />
                                            </div> --}}

                                            <div class="border-bottom pb-5">
                                                <button class="btn print-btn text-white mt-3 px-3" type="button"
                                                    id="print-btn">
                                                    Print
                                                </button>
                                                <input type="hidden" name="go_green" id="go_green_input"
                                                    value="0">
                                                <button class="btn green-btn text-white mt-3 px-3" type="button">
                                                    Go Green
                                                </button>
                                            </div>

                                            <button class="btn newsale-btn text-white mt-3 px-3">
                                                Update Sale
                                            </button>
                                        </div>

                                        <div class="col-md-7" id="invoice_print">
                                            <section class="invoice text-center justify-content-center" id="invoice">

                                                <div class="container">
                                                    <div class="card border-0 rounded-3 card-shadow my-5">
                                                        <div class="card-header bg-white border-0 p-4">
                                                            <div class="row">
                                                                <div class="col-md-6 align-items-center align-middle">
                                                                    <div class="d-flex align-items-center">
                                                                        <img src="dasheets/img/itsol.png"
                                                                            class="img-fluid" alt="" />
                                                                        <div>
                                                                            <h4
                                                                                class="all-adjustment border-0 w-100 fw-bold">
                                                                                {{ auth()->user()->name ?? 'Company Name' }}
                                                                            </h4>
                                                                            <p>Company tag's line here</p>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6 text-end">
                                                                    <p class="my-1">
                                                                        {{ auth()->user()->contact_no ?? '+123456789' }}
                                                                    </p>
                                                                    <p class="my-1">
                                                                        {{ auth()->user()->email ?? 'company@gmail.com' }}
                                                                    </p>
                                                                    <p class="m-0">
                                                                        <span class="fw-bold">TAX ID</span>
                                                                        <span id="txt_modal">123-654-789</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body p-4">
                                                            <div class="mt-5">
                                                                <div class="row text-start">
                                                                    <div class="col-md-2 col-3">
                                                                        <p class="m-0">Invoice:</p>
                                                                    </div>
                                                                    <div class="col-md-6 col-6">
                                                                        <p class="fw-bold m-0" id="invoice_id"></p>
                                                                        <input type="hidden" name="invoice_input_id"
                                                                            id="invoice_input_id">
                                                                    </div>
                                                                </div>

                                                                <div class="row text-start mt-2">
                                                                    <div class="col-md-2 col-3">
                                                                        <p class="m-0">Client:</p>
                                                                    </div>
                                                                    <div class="col-md-6 col-6">
                                                                        <p class="fw-bold m-0" id="customerName">Customer
                                                                            Name
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                                <div class="row text-start mt-2">
                                                                    <div class="col-md-2 col-3"></div>
                                                                    <div class="col-md-6 col-6">
                                                                        <p class="m-0" id="customerPhone">+1 234 675
                                                                            8976</p>
                                                                    </div>
                                                                </div>

                                                                <div class="row text-start mt-2">
                                                                    <div class="col-md-2 col-3"></div>
                                                                    <div class="col-md-6 col-6">
                                                                        <p class="m-0" id="customerEmail">Customer
                                                                            Email</p>
                                                                    </div>
                                                                </div>

                                                                {{-- <div class="row text-start mt-2">
                                                                    <div class="col-md-2 col-3"></div>
                                                                    <div class="col-md-6 col-6">
                                                                        <p class="m-0">
                                                                            <span class="fw-bold">Tax ID</span>
                                                                            <span id="txt_modal">123-654-789</span>
                                                                        </p>
                                                                    </div>
                                                                </div> --}}

                                                                <div class="row text-start mt-2">
                                                                    <div class="col-md-2 col-3">Date:</div>
                                                                    <div class="col-md-6 col-7">
                                                                        <p class="m-0">{{ date('Y-M-D h-i-s') }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="table-responsive mt-3 specific-border pb-3">
                                                                <table class="table" id="modalTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="fw-bold">#</th>
                                                                            <th class="fw-bold">Product Name</th>
                                                                            <th class="fw-bold">Net Unit Price</th>
                                                                            <th class="fw-bold">Qty</th>
                                                                            <th class="fw-bold">Price</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="pt-3">1</td>
                                                                            <td class="pt-3">Banana</td>
                                                                            <td class="pt-3">$3.00</td>
                                                                            <td class="pt-3">2 pc</td>
                                                                            <td class="pt-3">$6.00</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="pt-3">2</td>
                                                                            <td class="pt-3">Pineapple</td>
                                                                            <td class="pt-3">$3.00</td>
                                                                            <td class="pt-3">1 pc</td>
                                                                            <td class="pt-3">$0.00</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="pt-3">3</td>
                                                                            <td class="pt-3">Pineapple</td>
                                                                            <td class="pt-3">$3.00</td>
                                                                            <td class="pt-3">1 pc</td>
                                                                            <td class="pt-3">$0.00</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="pt-3">4</td>
                                                                            <td class="pt-3">Pineapple</td>
                                                                            <td class="pt-3">$3.00</td>
                                                                            <td class="pt-3">1 pc</td>
                                                                            <td class="pt-3">$0.00</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="pt-3">5</td>
                                                                            <td class="pt-3">Pineapple</td>
                                                                            <td class="pt-3">$3.00</td>
                                                                            <td class="pt-3">1 pc</td>
                                                                            <td class="pt-3">$0.00</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="pt-3">6</td>
                                                                            <td class="pt-3">Pineapple</td>
                                                                            <td class="pt-3">$3.00</td>
                                                                            <td class="pt-3">1 pc</td>
                                                                            <td class="pt-3">$0.00</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                            <div class="row mt-3 pb-5 specific-border text-start">
                                                                <div class="col-md-6">
                                                                    <p>Payment:</p>
                                                                    <p class="partially-paid mt-5">Cash Paid</p>
                                                                </div>
                                                                <div class="col-md-6">

                                                                    <div class="row border-bottom p-1">
                                                                        <div class="col-md-6 col-6">Tax</div>
                                                                        <div class="col-md-6 col-6 fw-bold text-secondary"
                                                                            id="order_tax_modal">
                                                                            $0.00 (0.00%)
                                                                        </div>
                                                                    </div>

                                                                    <div class="row border-bottom p-1">
                                                                        <div class="col-md-6 col-6">Discount</div>
                                                                        <div class="col-md-6 col-6 fw-bold text-secondary"
                                                                            id="discount_modal">
                                                                            $0.00 (0.00%)
                                                                        </div>
                                                                    </div>

                                                                    <div class="row border-bottom p-1">
                                                                        <div class="col-md-6 col-6">Shipping</div>
                                                                        <div class="col-md-6 col-6 fw-bold text-secondary"
                                                                            id="shipping_modal">
                                                                            $0.00
                                                                        </div>
                                                                    </div>
                                                                    <div class="row fw-bold p-1 specific-border">
                                                                        <div class="col-md-6 col-6">Grand Total</div>
                                                                        <div class="col-md-6 col-6 fw-bold"
                                                                            id="grand_total_modal">
                                                                            $0.00
                                                                        </div>
                                                                    </div>

                                                                    <div class="row border-bottom mt-4 p-1">
                                                                        <div class="col-md-6 col-6">
                                                                            Amount Recieved
                                                                        </div>
                                                                        <div class="col-md-6 col-6 fw-bold text-secondary"
                                                                            id="amount_recieved_modal">
                                                                            $0.00
                                                                        </div>
                                                                    </div>
                                                                    <div class="row border-bottom p-1">
                                                                        <div class="col-md-6 col-6">
                                                                            Amount Returned
                                                                        </div>
                                                                        <div class="col-md-6 col-6 fw-bold text-secondary"
                                                                            id="change_return_modal">
                                                                            $0.00
                                                                        </div>
                                                                    </div>
                                                                    <div class="row fw-bold p-1">
                                                                        <div class="col-md-6 col-6">
                                                                            Amount Pending
                                                                        </div>
                                                                        <div class="col-md-6 col-6 fw-bold"
                                                                            id="pendind_amount_modal">
                                                                            $0.00
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <p class="my-5 text-start">
                                                                Signature: ______________________
                                                            </p>
                                                        </div>
                                                        <div class="card-footer invoice-footer border-0 m-0 p-4">
                                                            <div
                                                                class="d-flex justify-content-between align-items-center align-middle p-3">
                                                                <p class="fw-bold m-0">Thank You!</p>
                                                                <p class="subheading m-0">www.website.com</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalToggle" tabindex="-1" aria-labelledby="exampleModalToggleLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title product-title" id="exampleModalToggleLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-title">
                            <h4 class="item-head"></h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_price" class="mb-1 fw-bold">Product Price</label>
                                        <input type="text" class="form-control subheading" id="product_price"
                                            value="Product Price *" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tax_type" class="mb-1 fw-bold">Tax Type</label>
                                        <select class="form-control form-select subheading"
                                            aria-label="Default select example" id="tax_type">
                                            <option value="" disabled selected>Select Tax Type</option>
                                            <option value="1">Inclusive</option>
                                            <option value="2">Exclusive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="order_tax_item" class="mb-1 fw-bold">Order Tax</label>
                                        <input type="number" class="form-control subheading" id="order_tax_item"
                                            value="0" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="discount_type" class="mb-1 fw-bold">Discount Type</label>
                                        <select name="discount_type" id="discount_type"
                                            class="form-control form-select subheading"
                                            aria-label="Default select example">
                                            <option value="" disabled selected> Select Discount Type</option>
                                            <option value="fixed">Fixed</option>
                                            <option value="percentage">Percentage</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="discount_item" class="mb-1 fw-bold">Discount</label>
                                        <input type="text" class="form-control subheading" id="discount_item"
                                            value="" placeholder="discount here" />
                                    </div>
                                    <input type="hidden" id="hidden_id">
                                </div>

                                {{-- <div class="col-md-6" id="unit-secton">
                                    <div class="form-group">
                                        <label for="sale_unit_item" class="mb-1 fw-bold">Sale Unit</label>
                                        <select class="form-control form-select subheading"
                                            aria-label="Default select example" id="sale_unit_item">
                                            <option value="kg">kg</option>
                                            <option value="g">g</option>
                                            <option value="l">l</option>
                                            <option value="ml">ml</option>
                                            <option value="pcs">pcs</option>
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-md-6" id="unit_section">
                                    <div class="form-group">
                                        <label for="sale_unit_item" class="mb-1 fw-bold">Sale Unit</label>
                                        <select name="sale_unit_item" id="sale_unit_item"
                                            class="form-control form-select subheading"
                                            aria-label="Default select example">
                                            <option value="" disabled selected>Select Sale Unit</option>
                                            @foreach ($units as $unit)
                                                <option value="{{ $unit->id ?? '' }}"
                                                    data-sale-unit-item="{{ $unit }}"> {{ $unit->name }}
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
                        <button type="button" class="btn btn-primary" data-product-item="" id="saveChangesButton">Save
                            changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const productCodeInput = document.getElementById("product_code");
            let prodCount = {{ count($sale->productItems) + 1 ?? 1 }};

            var suggestionsContainer = $("#suggestionsContainer");
            $("#product_code").autocomplete({
                source: function(request, response) {
                    var searchTerm = request.term;
                    performAddressSearch(searchTerm, response);
                },
                minLength: 2,
                select: function(event, ui) {
                    console.log(ui.item);

                    const tableBody = document.querySelector(".table tbody");
                    const row = document.createElement("tr");
                    let isDuplicate = false;
                    let hasRow = true;
                    document.querySelectorAll('.table tbody tr').forEach(row => {
                        if (row.querySelector('td:nth-child(3)').textContent === ui.item.product
                            .sku) {
                            // alert('Duplicate product cannot be added!');

                            // Select the input element
                            let qtyInput = $(row).find('td:nth-child(6) .qty-input');

                            // Get the current value of the input
                            let currentValue = parseInt(qtyInput.val());

                            // Increment the value and set it to the input
                            qtyInput.val(currentValue + 1).change();

                            isDuplicate = true;
                        }
                    });
                    $('#warehouse_id').prop('disabled', hasRow);
                    if (!isDuplicate) {
                        let quantity = ui.item.product.warehouse_quantity;
                        if (ui.item.product.product_type != 'service') {
                            if (ui.item.product.product_unit != ui.item.product.sale_units.id) {
                                if (ui.item.product.unit.parent_id == 0) {
                                    quantity = eval(
                                        `${ui.item.product.warehouse_quantity}${ui.item.product.unit.operator}${ui.item.product.sale_units.operator_value} `
                                    );
                                }
                            }
                        }

                        // Append row code here

                        // Assuming data contains product name, code, etc.
                        row.innerHTML = `
                            <td class="align-middle">${prodCount}</td>
                            <td class="product_name align-middle ">${ui.item.product.name}</td>
                            <td class=" align-middle ">${ui.item.product.sku}</td>
                            <td class="product_sell_price align-middle ">${ui.item.product.sell_price}</td>
                            <td class="align-middle">
                                <span class="badges bg-darkwarning p-1" product_stock data-converted-unit="${ui.item.product.sale_units?.id ? ui.item.product.sale_units.id : ''}">${quantity}${ui.item.product.sale_units?.short_name ? ui.item.product.sale_units.short_name : '' }</span>
                            </td>
                            <td class="align-middle">
                            <div
                                class="quantity d-flex justify-content-center align-items-center"
                            >
                                <button type="button" class="btn qty-minus-btn" id="minusBtn">
                                <i class="fa-solid fa-minus"></i>
                                </button>
                                <input
                                type="number"
                                id="quantityInput"
                                class="product_qty border-0 qty-input "
                                value="0" min="0"
                                />
                                <button type="button" class=" btn qty-plus-btn" id="plusBtn">
                                <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                            </td>
                            <td class="align-middle">0.00</td>
                            <td class="align-middle">0.00</td>
                            <td class="product_price align-middle">0.00</td>
                            <td class="align-middle">
                            <div class="d-flex justify-content-center">
                                <a href="#" class="btn item-edit" data-product='${JSON.stringify(ui.item.product)}' data-productItem-unit="false"  data-bs-target="#exampleModalToggle" data-bs-toggle="modal">
                                    <img src="{{ asset('back/assets/dasheets/img/edit-2.svg') }}" alt="" />
                                </a>
                                <a href="#" class="btn btn-plus item-delete">
                                    <img src="{{ asset('back/assets/dasheets/img/plus-circle.svg') }}" alt="" />
                                </a>
                            </div>
                            </td>
                        `;

                        tableBody.appendChild(row);
                        prodCount++;
                    }
                },
                appendTo: "#suggestionsContainer"
            }).autocomplete("instance")._renderItem = function(ul, item) {
                return $("<li>").append("<div>" + item.label + "</div>").appendTo(ul);
            };

            function performAddressSearch(searchTerm, response) {
                let warehouse = $('#warehouse_id').val();
                if (!$('#warehouse_id').val()) {
                    toastr.error("Please select warehouse!");
                }
                $.ajax({
                    url: '/get-product-detail-by-warehouse', // Replace with your search route
                    dataType: "json",
                    data: {
                        query: searchTerm,
                        warehouse_id: warehouse,
                    },
                    success: function(data) {
                        console.log(data);
                        var suggestions = [];
                        for (var i = 0; i < data.product.length; i++) {
                            suggestions.push({
                                value: data.product[i].sku,
                                label: data.product[i].name,
                                id: data.product[i].id,
                                product: data.product[i]
                            });
                        }
                        response(suggestions);
                    }
                });

            }


            function handlePaymentStatusChange() {
                var payment_status = document.getElementById('payment_status');
                var grandTotal = parseFloat(document.getElementById('grand_total').textContent.replace('$', ''));
                var amountPayInput = document.getElementById('amount_pay');

                if (payment_status.value == 'paid') {
                    document.getElementById('sale-calc').style.display = 'flex';
                    // grand total value will be set to the amount pay value with disable input and amount_recieved will be set to grand total value
                    document.getElementById('amount_pay').value = grandTotal;
                    document.getElementById('amount_pay').setAttribute('disabled', true);
                    document.getElementById('amount_recieved').value = grandTotal;
                } else if (payment_status.value == 'partial') {
                    document.getElementById('sale-calc').style.display = 'flex';
                    document.getElementById('amount_pay').value = 0;
                    if (amountPayInput.disabled) {
                        amountPayInput.disabled = false;
                    }
                    document.getElementById('amount_recieved').value = 0;
                } else {
                    document.getElementById('sale-calc').style.display = 'none';
                }
            }

            // Call the function on DOM load
            document.addEventListener('DOMContentLoaded', function() {
                handlePaymentStatusChange();
            });

            // Add an event listener for the change event
            var payment_status = document.getElementById('payment_status');
            payment_status.addEventListener('change', handlePaymentStatusChange);

            let amountRecievedInput = document.getElementById('amount_recieved');
            let amountPayInput = document.getElementById('amount_pay');

            // Add event listeners
            amountRecievedInput.addEventListener('input', calculateChangeReturn);
            amountPayInput.addEventListener('input', calculateChangeReturn);

            function calculateChangeReturn() {
                // Parse the input values to floats
                let amountRecieved = parseFloat(amountRecievedInput.value);
                let amountPay = parseFloat(amountPayInput.value);
                // Get the payment status
                let paymentStatus = document.getElementById('payment_status').value;

                // If the payment status is 'partial' and amountPay is greater than amountRecieved, show an error and return
                if (paymentStatus === 'partial' && amountPay > amountRecieved) {
                    alert('Paying amount cannot be greater than received amount for partial payments');
                    amountPayInput.value = amountRecieved;
                    return;
                }
                // Calculate the change return
                let changeReturn = amountRecieved - amountPay;

                // Check if the change return is a valid number (it will be NaN if either input field is empty or non-numeric)
                if (!isNaN(changeReturn)) {
                    // Update the change_return field
                    document.getElementById('change_return').textContent = changeReturn.toFixed(2);
                }
            }

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

            // Get the select element
            const customersSelect = document.getElementById('customers');

            // Add event listener for change event
            customersSelect.addEventListener('change', function() {
                // Get the selected option
                const selectedOption = this.options[this.selectedIndex];

                // Get data attributes from the selected option
                const name = selectedOption.dataset.name;
                const phone = selectedOption.dataset.phone;
                const email = selectedOption.dataset.email;

                // Update the modal with customer details
                document.getElementById('nameInput').value = name;
                document.getElementById('phoneInput').value = phone;
                document.getElementById('emailInput').value = email;
                document.getElementById('customerName').innerHTML = name;
                document.getElementById('customerPhone').innerHTML = phone;
                document.getElementById('customerEmail').innerHTML = email;
                // document.getElementById('salesTaxIdInput').value = salesTaxId;
            });

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

        // When an item-edit button is clicked
        $(document).on('click', '.item-edit', function() {
            $('#exampleModalToggle').show();
            // Parse the product data from the button's data-product attribute
            const product = JSON.parse($(this).attr('data-product'));
            console.log(product);
            // Populate the modal fields with the product data
            $('#exampleModalToggle .product-title').text(product.name);
            $('#exampleModalToggle #product_price').val(product.sell_price || product.price);
            $('#exampleModalToggle #tax_type').val(product.tax_type);
            $('#exampleModalToggle #order_tax_item').val(product.order_tax);
            $('#exampleModalToggle #discount_type').val(product.discount_type ?? "fixed");
            $('#exampleModalToggle #discount_item').val(product.discount ?? '0.00');
            $('#exampleModalToggle #hidden_id').val(product.id);
            if (product.product_type == 'service') {
                $('#exampleModalToggle #unit_section').css('display', 'none');
            } else {
                $('#exampleModalToggle #unit_section').css('display', 'block');
                let productItem_sale_unit = $(this).attr('data-productItem-unit');
                if (productItem_sale_unit != "false") {
                    $('#exampleModalToggle #sale_unit_item').val(productItem_sale_unit);
                } else {
                    $('#exampleModalToggle #sale_unit_item').val(product.sale_units?.id);
                }

            }

            product.discount = 0;
            product.discount_type = "fixed";
            // add product into the data-product-item attribute of #saveChangesButton
            $('#saveChangesButton').attr('data-product-item', JSON.stringify(product));
        });

        $('#saveChangesButton').click(function() {
            // Retrieve and parse updated product data from modal
            const product_details = JSON.parse($('#saveChangesButton').attr('data-product-item'));
            let sale_units;
            if (product_details.product_type != 'service') {
                const selectedOption = $('#exampleModalToggle #sale_unit_item option:selected');
                sale_units = selectedOption.data('sale-unit-item');
            }

            const updatedProduct = {
                // existing code to retrieve data...
                tax_type: parseFloat($('#exampleModalToggle #tax_type').val()),
                order_tax: parseFloat($('#exampleModalToggle #order_tax_item').val()) ? parseFloat($(
                    '#exampleModalToggle #order_tax_item').val()) : 0,
                discount_type: $('#exampleModalToggle #discount_type').val(),
                discount: parseFloat($('#exampleModalToggle #discount_item').val()) ? parseFloat($(
                    '#exampleModalToggle #discount_item').val()) : 0,
                id: parseFloat($('#exampleModalToggle #hidden_id').val()),
                price: parseFloat($('#exampleModalToggle #product_price').val()) ? parseFloat($(
                    '#exampleModalToggle #product_price').val()) : 0,
                sale_units: sale_units ?? '',
            };

            console.log(product_details)

            // var updatedStock = 0;
            var updatedStock = product_details.warehouse_quantity;
            if (product_details.product_type != 'service') {

                if (updatedProduct.sale_units.parent_id != 0) {
                    // big to small unit
                    // alert("large to small")
                    updatedStock = eval(
                        `${product_details.warehouse_quantity}${product_details.unit.operator}${updatedProduct.sale_units.operator_value}`
                    );

                } else {
                    // small to large unit conversion
                    // alert(`small to large ${product_details.quantity}`)
                    updatedStock = product_details.warehouse_quantity;
                }

            }
            updatedProduct.quantity = updatedStock;



            let price = parseFloat(updatedProduct.price);
            if (updatedProduct.tax_type == 2) {
                price += updatedProduct.order_tax;
            } else if (updatedProduct.tax_type == 1) {
                price -= price * (updatedProduct.order_tax / (100 + updatedProduct.order_tax));
            } else {
                price = price;
            }

            if (updatedProduct.discount_type == 'fixed') {
                price -= updatedProduct.discount ? updatedProduct.discount : 0;
            } else if (updatedProduct.discount_type == 'percentage') {
                price -= price * (updatedProduct.discount / 100);
            } else {
                price = price;
            }

            updatedProduct.price = price.toFixed(2);

            // const rowProduct = JSON.parse($(this).attr('data-product-item'));
            console.log(updatedProduct)
            $('#mainTable tbody tr').each(function() {

                const rowProductId = parseInt($(this).find('td:nth-child(10)').find('a').data('product').id);
                if (rowProductId === updatedProduct.id) {
                    // Update the product details in the table
                    $(this).find('td:nth-child(4)').text(updatedProduct.price);
                    $(this).find('td:nth-child(5)').html(
                        `<span class="badges bg-darkwarning p-1" data-converted-unit="${updatedProduct.sale_units?.id ? updatedProduct.sale_units.id : ''}">${updatedStock ?? product_details.warehouse_quantity}${updatedProduct.sale_units?.short_name ? updatedProduct.sale_units.short_name : ''}</span>`
                    );
                    $(this).find('td:nth-child(7)').text(updatedProduct.discount ? updatedProduct.discount :
                        0);
                    $(this).find('td:nth-child(8)').text(updatedProduct.order_tax);
                    // for sub total
                    const quantity = $(this).find('td:nth-child(6)').find('input').val();
                    const subtotal = parseInt(quantity) * parseFloat(updatedProduct.price);
                    $(this).find('td:nth-child(9)').text(subtotal.toFixed(2));
                    // var mergedArray = $.extend({}, product_details, updatedProduct);
                    // Create a new object to hold the merged values
                    var mergedArray = {};

                    // Merge the arrays manually
                    for (var key in product_details) {
                        // Check if the key is "quantity"
                        if (key === 'quantity') {
                            // If it is, retain the value from the first array
                            mergedArray[key] = product_details[key];
                        } else {
                            // If not, check if the key exists in the second array
                            // If it does, use the value from the second array; otherwise, use the value from the first array
                            mergedArray[key] = updatedProduct.hasOwnProperty(key) ? updatedProduct[key] :
                                product_details[key];
                        }
                    }
                    $(this).find('td:nth-child(10)').find('a').attr('data-product', JSON.stringify(mergedArray));
                    $(this).find('td:nth-child(10)').find('a').attr('data-productItem-unit', JSON.stringify(updatedProduct.sale_units?.id));

                    $('#exampleModalToggle .btn-close').trigger('click');

                }
            });

        });

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
                    note: $('#notes').val(),
                    invoice_id: $('#invoice_input_id').val(),
                    warehouse_id: $('#warehouse_id').val(),
                    grand_total: parseFloat(document.getElementById('grand_total').textContent.replace(
                        '$', '')),

                    order_items: []
                };

                // Collect order items
                $('#mainTable tbody tr').each(function() {
                    console.log($(this).find('td:nth-child(10) .item-edit').data('product'));
                    let item = {
                        id: $(this).find('td:nth-child(10) .item-edit').data('product').id,
                        quantity: $(this).find('td:nth-child(6) input').val(),
                        discount: $(this).find('td:nth-child(7)').text(),
                        // discount_type: $(this).find('td:nth-child(10) .item-edit').data('product').discount_type,
                        tax_type: $(this).find('td:nth-child(10) .item-edit').data('product').tax_type,
                        order_tax: $(this).find('td:nth-child(8)').text(),
                        sale_unit: $(this).find('td:nth-child(5) span').data('converted-unit'),
                        price: $(this).find('td:nth-child(4)').text(),
                        subtotal: $(this).find('td:nth-child(9)').text(),
                        stock: $(this).find('td:nth-child(5)').text(),

                    };
                    formData.order_items.push(item);
                });

                // AJAX request to server
                $.ajax({
                    url: "/sales/{{ $sale->id }}",
                    type: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    success: function(response) {
                        console.log(response);
                        // Handle success (maybe redirect or show a success message)
                        toastr.success('Sale updated successfully!');
                        window.location.href = "{{ route('sales.index') }}";

                        console.log('Success:', response);
                    },
                    error: function(error) {
                        // Handle error
                        console.log('Error:', error);
                    }
                });
            });
        });


        $(document).on('click', '.item-delete', function(e) {
            e.preventDefault();
            $(this).closest('tr').remove();
            calculateTotal();
        });


        $(document).ready(function() {

            function populateModalTable() {
                // Get the main table rows
                const mainTableRows = document.querySelectorAll('#mainTable tbody tr');

                // Select the modal table body
                const modalTableBody = document.querySelector('#modalTable tbody');

                modalTableBody.innerHTML = '';

                mainTableRows.forEach((row, index) => {
                    // Get data from specific columns
                    const productName = row.querySelector('.product_name').textContent;
                    const netUnitPrice = row.querySelector('.product_sell_price').textContent;
                    const qty = row.querySelector('.product_qty').value;
                    const price = row.querySelector('.product_price').textContent;


                    const newRow = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${productName}</td>
                            <td>${netUnitPrice}</td>
                            <td>${qty}</td>
                            <td>${price}</td>
                        </tr>
                    `;

                    // Append the new row
                    modalTableBody.innerHTML += newRow;
                });
            }

            function generateInvoiceId() {
                const timestamp = Date.now();
                const randomNum = Math.floor(Math.random() * 9000) + 1000;
                // Concatenate timestamp and random number to create the unique ID
                const invoiceId = `INV-${timestamp}-${randomNum}`;
                return invoiceId;
            }


            function AddDetailsInModal() {
                var getOrderTax = document.getElementById('order_tax_display').innerHTML;
                var discount = document.getElementById('discount_display').innerHTML;
                var shipping = document.getElementById('shipping_display').innerHTML;
                var total = document.getElementById('grand_total').innerHTML;

                var am_pay = document.getElementById('amount_pay').innerHTML;
                var am_recieved = document.getElementById('amount_recieved').value;
                var return_pay = document.getElementById('change_return').innerHTML;

                document.getElementById('order_tax_modal').innerHTML = getOrderTax;
                document.getElementById('discount_modal').innerHTML = discount;
                document.getElementById('shipping_modal').innerHTML = shipping;
                document.getElementById('grand_total_modal').innerHTML = total;

                // document.getElementById('amount_pay_modal').innerHTML = am_pay;
                var payment_status = document.getElementById('payment_status').value;
                if (payment_status == 'partial' || payment_status == 'pending') {
                    document.getElementById('pendind_amount_modal').innerHTML = total;
                }
                // document.getElementById('payment_status').innerHTML = am_recieved;
                document.getElementById('amount_recieved_modal').innerHTML = am_recieved;
                document.getElementById('change_return_modal').innerHTML = return_pay;
                const invoice_id = generateInvoiceId();
                document.getElementById('invoice_id').innerHTML = invoice_id;
                document.getElementById('invoice_input_id').value = invoice_id;
                let ntn = document.getElementById('ntn_no').value;
                document.getElementById('txt_modal').innerHTML = ntn;

                let customer = document.getElementById('customers');
                var selectedOption = customer.options[customer.selectedIndex];
                var name = selectedOption.dataset.name;
                var email = selectedOption.dataset.email;
                var phone = selectedOption.dataset.phone;

                document.getElementById('nameInput').value = name;
                document.getElementById('phoneInput').value = phone;
                document.getElementById('emailInput').value = email;
                document.getElementById('customerName').innerHTML = name;
                document.getElementById('customerPhone').innerHTML = phone;
                document.getElementById('customerEmail').innerHTML = email;

            }

            // Call the function to populate modal table when the modal is shown
            document.getElementById('saleInvoiceModal').addEventListener('shown.bs.modal', function() {
                populateModalTable();
                AddDetailsInModal();
            });


        });
    </script>

    <script>
        // Function to print the specific section
        function printSpecificSection() {
            // Get the content to print
            const contentToPrint = document.getElementById('invoice_print').innerHTML;

            // Open a new window and write the content to it
            const printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Print Invoice</title>');

            printWindow.document.write('<link rel="stylesheet" href="{{ asset('back/assets/css/bootstrap.min.css') }}">');
            printWindow.document.write('<link rel="stylesheet" href="{{ asset('back/assets/css/Printstyle.css') }}">');
            printWindow.document.write('<link rel="stylesheet" href="{{ asset('back/assets/dasheets/css/style.css') }}">');
            printWindow.document.write('</head><body>');
            printWindow.document.write(contentToPrint);
            printWindow.document.write('</body></html>');
            // Print the content in the new window
            printWindow.print();
        }

        // Attach a click event listener to the print button
        document.getElementById('print-btn').addEventListener('click', printSpecificSection);
    </script>
@endsection
