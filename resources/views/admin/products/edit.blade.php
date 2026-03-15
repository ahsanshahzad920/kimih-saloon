@extends('admin.layout.app')
@section('title', 'Edit Product')
@section('upper-styles')
<link rel="stylesheet" href="{{asset('assets_old/dasheets/css/style.css')}}">
<style>
    /* File Upload */

    .variant-section {
        margin-bottom: 20px;
        margin-top: 10px
    }

    .variant-input {
        margin-bottom: 10px;
    }

    .bi-trash3 {
        pointer-events: none;
    }

    .upload__box {
        padding: 10px;
    }

    .upload__inputfile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }

    .upload__btn {
        display: inline-block;
        font-weight: 600;
        /* color: #fff; */
        text-align: center;
        /* min-width: 116px; */
        /* padding: 5px; */
        transition: all 0.3s ease;
        cursor: pointer;
        /* border: 2px solid; */
        /* background-color: #4045ba;
     border-color: #4045ba; */
        /* border-radius: 10px;
     line-height: 26px;
     font-size: 14px; */
    }

    /* .upload__btn:hover {
     background-color: unset;
     color: #4045ba;
     transition: all 0.3s ease;
    } */
    .upload__btn-box {
        margin-bottom: 10px;
    }

    .upload__img-wrap {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
    }

    .upload__img-box {
        width: 90px;
        padding: 0 10px;
        margin-bottom: 12px;
    }

    .upload__img-close {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background-color: rgba(0, 0, 0, 0.5);
        position: absolute;
        top: 10px;
        right: 10px;
        text-align: center;
        line-height: 24px;
        z-index: 1;
        cursor: pointer;
    }

    .upload__img-close:after {
        content: '\2716';
        font-size: 14px;
        color: white;
    }

    .img-bg {
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        position: relative;
        padding-bottom: 100%;
        border-radius: 15%;
    }
    </style>
    <link type="text/css" rel="stylescheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
@endsection

@section('content')

    <div class="main-content">
        <div class="page-content">
            <!-- start page title -->

            <!-- end page title -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Edit Product</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="javascript: void(0);">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit Product</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.update', $product->id) }}" id="productEditForm" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mt-4">
                        @include('admin.layout.errors')
                        <div class="col-md-8">

                            <div class="card rounded-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="product_name">Product Name</label>
                                                <input type="text" class="form-control mt-2" name="name" id="product_name"
                                                    placeholder="" value="{{ $product->name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="category_id">Category</label>
                                                <select class="form-control form-select subheading mt-1"
                                                    aria-label="Default select example" name="category_id" id="category_id">
                                                    <option>Select Category</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="customers">Brand</label>
                                                <select class="form-control form-select subheading mt-1"
                                                    aria-label="Default select example" name="brand_id"id="customers">
                                                    <option>Select Brand</option>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}"
                                                            {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                                            {{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="product_name">Product Short Description</label>
                                                <input type="text" class="form-control mt-2" name="product_short_description"
                                                    id="product_short_description" placeholder=""
                                                    value="{{ $product->product_short_description ?? '' }}">
                                            </div>

                                        </div>

                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="description">Product Description</label>
                                                <textarea class="form-control subheading mt-1" id="description" name="description" rows="3">{{ $product->description ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="card rounded-3 mt-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="order_tax">Measure</label>
                                                <select name="measureType" class="form-control subheading"
                                                    data-qa="select-structure-native-select-measureType"
                                                    data-gtm-form-interact-field-id="31">
                                                    <option value="milliliters"
                                                        {{ $product->measureType == 'milliliters' ? 'selected' : '' }}>
                                                        Milliliters (ml)</option>
                                                    <option value="liters"
                                                        {{ $product->measureType == 'liters' ? 'selected' : '' }}>Liters (l)
                                                    </option>
                                                    <option value="fluid_ounces"
                                                        {{ $product->measureType == 'fluid_ounces' ? 'selected' : '' }}>Fluid
                                                        ounces (Fl. oz.)</option>
                                                    <option value="grams"
                                                        {{ $product->measureType == 'grams' ? 'selected' : '' }}>Grams (g)
                                                    </option>
                                                    <option value="kilograms"
                                                        {{ $product->measureType == 'kilograms' ? 'selected' : '' }}>Kilograms
                                                        (kg)</option>
                                                    <option value="gallons"
                                                        {{ $product->measureType == 'gallons' ? 'selected' : '' }}>Gallons
                                                        (gal)
                                                    </option>
                                                    <option value="ounces"
                                                        {{ $product->measureType == 'ounces' ? 'selected' : '' }}>Ounces (oz)
                                                    </option>
                                                    <option value="pounds"
                                                        {{ $product->measureType == 'pounds' ? 'selected' : '' }}>Pounds (lb)
                                                    </option>
                                                    <option value="centimeters"
                                                        {{ $product->measureType == 'centimeters' ? 'selected' : '' }}>
                                                        Centimeters (cm)</option>
                                                    <option value="feet"
                                                        {{ $product->measureType == 'feet' ? 'selected' : '' }}>Feet (ft)
                                                    </option>
                                                    <option value="inches"
                                                        {{ $product->measureType == 'inches' ? 'selected' : '' }}>Inches (in)
                                                    </option>
                                                    <option value="whole"
                                                        {{ $product->measureType == 'whole' ? 'selected' : '' }}>A whole
                                                        product
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="order_tax">Amount</label>
                                                <input type="text" class="form-control subheading " placeholder="0%"
                                                    id="amount" name="amount" value="{{ $product->amount }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row p-2 mt-2">
                                        <h6>Pricing</h6>
                                        {{-- <hr> --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="product_name">Supply price</label>
                                                <input type="text" class="form-control mt-2" name="supply_price"
                                                    id="supply_price" placeholder="0.00"
                                                    value="{{ $product->supply_price }}">
                                            </div>
                                        </div>
                                    </div>
                                    <h6>Retail sales</h6>
                                    <span class="text-secondary">Allow sales of this product at checkout.</span>
                                    <div class="row mt-2">

                                        <div class="d-flex align-items-center">
                                            <label class="switch mt-2">
                                                <input type="checkbox" name="retail_sales" id="retail_sales" value="1"
                                                    {{ $product->retail_sales == 1 ? 'checked' : '' }}>
                                                <span class="slider"></span>
                                            </label>
                                            <p class="m-0">Enable retail sales</p>
                                        </div>
                                    </div>
                                    <div class="row mt-3 " id="retail-option" style="display: none">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="retail_price" class="mb-1">Retail price</label>
                                                <input type="text" class="form-control subheading" id="retail_price"
                                                    placeholder="e.g. 0.00" name="retail_price"
                                                    value="{{ $product->retail_price ?? '' }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="retail_price" class="mb-1">Marked</label>
                                                <input type="text" class="form-control subheading" id="marked"
                                                    placeholder="e.g. 0.00" name="marked"
                                                    value="{{ $product->marked ?? '' }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3 " id="retail-option-tax" style="display: none">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="notify_days" class="mb-1">Tax (Included in price) </label>
                                                <select name="sales_tax" id="sales_tax" class="form-control subheading">
                                                    <option disabled>Select an Option</option>
                                                    <option value="No Tax"
                                                        {{ $product->sales_tax == 'No Tax' ? 'selected' : '' }}>No Tax</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <hr> --}}
                                    <div class="p-3" id="retail-option-commission" style="display: none">
                                        <h5>Team member commission</h5>
                                        <h6 class="text-secondary">Calculate team member commission when the product is sold.
                                        </h6>
                                        <!--end breadcrumb-->
                                        <div class="row mt-4">
                                            <div class="d-flex align-items-center">
                                                <label class="switch mt-2">
                                                    <input type="checkbox" name="team_memeber_commission"
                                                        id="team_memeber_commission" value="1"
                                                        {{ $product->team_memeber_commission == 1 ? 'checked' : '' }}>
                                                    <span class="slider"></span>
                                                </label>
                                                <p class="m-0">Enable team member commission</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card rounded-3 mt-4">
                                <div class="card-body">
                                    <h6>Inventory</h6>
                                    <span class="text-secondary">
                                        Manage stock levels of this product through our website.
                                    </span>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="order_tax" class="form-label">Select Supplier</label>
                                                <select name="supplier_id" class="form-control subheading">
                                                    <option disabled>Select an option</option>
                                                    @foreach ($suppliers as $supplier)
                                                        <option value="{{ $supplier->id }}"
                                                            {{ $product->supplier_id == $supplier->id ? 'selected' : '' }}>
                                                            {{ $supplier->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="row mt-4">
                                        <h6>Stock Quantity</h1>
                                            <div class="">
                                                <div class="d-flex align-items-center">
                                                    <label class="switch mt-2">
                                                        <input type="checkbox" name="track_stock_quantity"
                                                            id="track_stock_quantity" value="1"
                                                            {{ $product->track_stock_quantity == 1 ? 'checked' : '' }}>
                                                        <span class="slider"></span>
                                                    </label>
                                                    <p class="m-0">Track stock quantity</p>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="row mt-2 track-div">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="order_tax">Current Stock</label>
                                                <input type="text" class="form-control subheading " placeholder="0"
                                                    id="current_stock_quantity" name="current_stock_quantity"
                                                    value="{{ $product->current_stock_quantity ?? '' }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mt-4 track-div">
                                        <h6>Low stock and reordering </h1>
                                            <span class="text-secondary">Fresha will automatically notify you and pre-fill the
                                                reorder quantity set for future stock orders</span>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="order_tax">Low stock level</label>
                                                    <input type="string" class="form-control subheading " placeholder="0"
                                                        id="low_stock_level" name="low_stock_level"
                                                        value="{{ $product->low_stock_level ?? '' }}" />
                                                    <span class="text-secondary">The level to get notified to reorder</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="order_tax">Reorder quantity </label>
                                                    <input type="number" class="form-control subheading " placeholder="0"
                                                        id="reorder_quantity" name="reorder_quantity"
                                                        value="{{ $product->reorder_quantity ?? '' }}" />
                                                    <span class="text-secondary">The default amount to order</span>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="track-div">
                                        <div class="d-flex align-items-center">
                                            <label class="switch mt-2">
                                                <input type="checkbox" name="low_stock_noti" id="low_stock_noti"
                                                    value="1" {{ $product->low_stock_noti ?? '' == 1 ? 'checked' : '' }}>
                                                <span class="slider"></span>
                                            </label>
                                            <p class="m-0">Receive low stock notification</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="card rounded-3 mt-4">
                                <div class="card-body" id="barcodeSection">
                                    <div class="row border-bottom mt-2 barcodeRow" id="barcode1">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="barcodeSymbology1">Barcode Symbology *</label>
                                                <select class="form-control form-select subheading mt-1"
                                                    aria-label="Default select example" id="barcodeSymbology1"
                                                    name="barcodeSymbology1">
                                                    <option value="Code 128">Code 128</option>
                                                    <option value="Code 39">Code 39</option>
                                                    <option value="EAN8">EAN8</option>
                                                    <option value="EAN13">EAN13</option>
                                                    <option value="UPC">UPC</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="productCode">Product Code</label>
                                            <div class="input-group mt-1 subheading">
                                                <input type="text" class="form-control subheading" placeholder="Barcode"
                                                    aria-label="Recipient's username" aria-describedby="basic-addon2"
                                                    name="productCode1" id="productCode" />
                                                <span class="input-group-text" id="basic-addon2 subheading"><i
                                                        class="bi bi-upc-scan"></i></span>
                                            </div>
                                            <p>Scan the barcode or symbology</p>
                                        </div>
                                    </div>

                                    <div class="row mt-4 bg-light align-middle p-3 rounded-3 mx-1" id="barcodeButtonSection">
                                        <div class="col-md-6">
                                            <p>You can scan more than one barcode for a product.</p>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <button type="button" id="addBarcode"
                                                class="text-primary btn btn-light border-0 bg-transparent"
                                                style="cursor: pointer">
                                                Add another barcode
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="card rounded-3 mt-4">
                                <div class="card-body" id="barcodeSection">
                                    {{-- <div class="row border-bottom mt-2" id="barcode1">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="barcodeSymbology1">Barcode Symbology *</label>
                                                <select class="form-control form-select subheading mt-1"
                                                    aria-label="Default select example" id="barcodeSymbology1"
                                                    name="barcode">
                                                    <option value="Code 128" @if ($product->barcode == 'Code 128') selected @endif>
                                                        Code 128</option>
                                                    <option value="Code 39"
                                                        @if ($product->barcode == 'Code 39') selected @endif>Code 39</option>
                                                    <option value="Code 93"
                                                        @if ($product->barcode == 'Code 93') selected @endif>Code 93</option>
                                                    <option value="UPC" @if ($product->barcode == 'UPC') selected @endif>
                                                        UPC</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="productCode1">Product Code</label>
                                            <div class="input-group mt-1 subheading">
                                                <input type="text" class="form-control subheading" placeholder="Barcode"
                                                    name="sku" id="productCode1" readonly value="{{ $product->sku }}">
                                            </div>
                                            <p>Scan the barcode or symbology</p>
                                        </div>


                                    </div> --}}
                                    @foreach ($product->barcodes as $index => $barcode)
                                        <div class="row border-bottom mt-2 barcodeRow" id="barcode{{ $index + 1 }}">
                                            <!-- Barcode Symbology -->
                                            <div class="col-md-5 mb-3">
                                                <div class="form-group">
                                                    <label for="barcodeSymbology{{ $index + 1 }}">Barcode Symbology
                                                        *</label>
                                                    <select class="form-control form-select"
                                                        id="barcodeSymbology{{ $index + 1 }}"
                                                        name="barcodeSymbology{{ $index + 1 }}">
                                                        <option value="Code 128"
                                                            {{ $barcode->symbology == 'Code 128' ? 'selected' : '' }}>Code 128
                                                        </option>
                                                        <option value="Code 39"
                                                            {{ $barcode->symbology == 'Code 39' ? 'selected' : '' }}>Code 39
                                                        </option>
                                                        <option value="Code 93"
                                                            {{ $barcode->symbology == 'Code 93' ? 'selected' : '' }}>Code 93
                                                        </option>
                                                        <option value="UPC"
                                                            {{ $barcode->symbology == 'UPC' ? 'selected' : '' }}>UPC</option>
                                                        <!-- Add other options similarly with conditional selection -->
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Product Code -->
                                            <div class="col-md-5 mb-3">
                                                <label for="productCode{{ $index + 1 }}">Product Code</label>
                                                <input type="text" class="form-control"
                                                    id="productCode{{ $index + 1 }}"
                                                    name="productCode{{ $index + 1 }}" value="{{ $barcode->code }}" />
                                                <!-- ...other elements... -->
                                            </div>
                                            <div class="col-md-2  mb-3">
                                                <div><button
                                                        class="btn text-danger border-danger w-100 subheading mt-4 removeBarcodeBtn"
                                                        type="button"><i class="bi bi-trash3"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="row mt-4 mb-0 pb-0" id="barcodeButtonSection">
                                        <div class="col-md-6">
                                            <p>You can scan more than one barcode for a product.</p>
                                        </div>
                                        <div class="col-md-6 text-end">

                                            <button type="button" id="addBarcode"
                                                class="text-primary btn btn-light border-0 bg-transparent"
                                                style="cursor: pointer">
                                                Add another barcode
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn btn-success add-btn mt-3">Create</button>

                        </div>



                        <div class="col-md-4">
                            <div class="card shadow border-0 rounded-3">
                                <div class="card-header bg-white p-3">
                                    <p class="m-0">Product Images</p>
                                </div>
                                <div class="card-body upload__box">
                                    <div class="file-upload upload__btn-box">
                                        <label class="upload__btn">
                                            <img src="{{ asset('back/assets/dasheets/img/upload-btn.svg') }}"
                                                class="img-fluid" alt="">
                                            <p class="mt-2 subheading file-input-div">
                                                Drag and Drop to upload or
                                            </p>

                                            <button type="button" class="btn create-btn mt-2 file-input-div">Select
                                                Image</button>
                                            <input type="file" multiple data-max_length="20" class="file-input"
                                                name="img[]">
                                        </label>
                                    </div>
                                    <div class="upload__img-wrap">
                                        @foreach ($product->images as $images)
                                            <div class="upload__img-box">
                                                <div style='background-image: url("{{ asset('/storage' . $images->img_path) }}")'
                                                    data-number="{{ $loop->index }}" data-file="{{ $images->img_path }}"
                                                    class='img-bg'>
                                                    <div class='upload__img-close'></div>
                                                </div>
                                                <input type="hidden" name="existing_images[]" value="{{ $images->id }}">
                                            </div>
                                        @endforeach
                                    </div>

                                </div>

                            </div>
                            <div class="card rounded-3 shadow border-0 mt-3 p-2">
                                <div class="card-header rounded-3 bg-white border-0 m-0">
                                    <p class="m-0">Registered Barcode(s)</p>
                                </div>
                                <div class="card-body p-0 ps-3 m-0">
                                    <p class="m-0" id="barcodeCount">1</p>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('back/assets/js/image-uploader.js') }}"></script>

    <script>
        jQuery(document).ready(function() {

            ImgUpload();
            $('#productEditForm').on('submit', function(e) {
                e.preventDefault(); // Prevent standard form submission

                var formData = new FormData(this); // Automatically captures all form data, including files
                console.log($('.file-input')[0].files);
                formData.delete('img[]');

                // Append all selected files to the formData
                $.each(selectedFiles, function(i, file) {
                    formData.append('img[]', file);
                });


                // console.log(formData);
                for (let [key, value] of formData.entries()) {
                    console.log(`${key}: ${value}`);
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        window.location.href = "{{ route('products.index') }}";
                        // Handle success
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
        var selectedFiles = []; // Array to store all selected files

        function ImgUpload() {
            var imgWrap = "";
            var imgArray = [];

            $('.file-input').each(function() {
                $(this).on('change', function(e) {
                    imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                    var maxLength = $(this).attr('data-max_length');

                    var files = e.target.files;
                    var filesArr = Array.prototype.slice.call(files);
                    var iterator = 0;
                    filesArr.forEach(function(f, index) {

                        if (!f.type.match('image.*')) {
                            return;
                        }
                        selectedFiles.push(f);

                        if (imgArray.length > maxLength) {
                            return false
                        } else {
                            var len = 0;
                            for (var i = 0; i < imgArray.length; i++) {
                                if (imgArray[i] !== undefined) {
                                    len++;
                                }
                            }
                            if (len > maxLength) {
                                return false;
                            } else {
                                imgArray.push(f);

                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    var html =
                                        "<div class='upload__img-box'><div style='background-image: url(" +
                                        e.target.result + ")' data-number='" + $(
                                            ".upload__img-close").length + "' data-file='" + f
                                        .name +
                                        "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                    imgWrap.append(html);
                                    iterator++;
                                }
                                reader.readAsDataURL(f);
                            }
                        }
                    });
                });
            });

            $('body').on('click', ".upload__img-close", function(e) {
                var file = $(this).parent().data("file");
                for (var i = 0; i < imgArray.length; i++) {
                    if (imgArray[i].name === file) {
                        imgArray.splice(i, 1);
                        break;
                    }
                }

                $(this).parent().parent().remove();
            });
        }



        document.addEventListener('DOMContentLoaded', function() {

            $(document).ready(function() {
                $('#retail_sales').trigger('change');
                $('#track_stock_quantity').trigger('change');
            });
            $('#retail_sales').change(function() {
                if (this.checked) {
                    $('#retail-option').show();
                    $('#retail-option-tax').show();
                    $('#retail-option-commission').show();
                } else {
                    $('#retail-option').hide();
                    $('#retail-option-tax').hide();
                    $('#retail-option-commission').hide();
                }
            });
            $('#track_stock_quantity').change(function() {
                if (this.checked) {
                    $('.track-div').show();
                } else {
                    $('.track-div').hide();
                }
            });






        });

        // Function to remove barcode row
        function removeBarcodeRow(rowId) {
            var row = document.getElementById(rowId);
            if (row) {
                row.remove();
            }
        }
    </script>
@endsection
