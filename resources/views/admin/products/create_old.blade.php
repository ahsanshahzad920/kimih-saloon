@extends('admin.layout.app')
@section('title', 'Add Product')
@section('style')
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    {{-- <link type="text/css" rel="stylesheet" href="{{ asset('back/assets/css/image-uploader.css') }}"> --}}

    <style>
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
@endsection
@section('content')
    <div class="content">
        @if (count($errors) > 0)
            <div class="mt-5 alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="mt-5 alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ session('error') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="mt-2 alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="container-fluid py-5 px-4 bg-light">
            <div class="border-bottom">
                <h3 class="all-adjustment text-center pb-2 mb-0">Create Product</h3>
            </div>
            <form action="{{ route('products.store') }}" id="productForm" method="POST" enctype="multipart/form-data">
                @csrf
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
                                                placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category_id">Category</label>
                                            <select class="form-control form-select subheading mt-1"
                                                aria-label="Default select example" name="category_id" id="category_id">
                                                <option>Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="product_name">Product Short Description</label>
                                            <input type="text" class="form-control mt-2" name="product_short_description"
                                                id="product_short_description" placeholder="">
                                        </div>

                                    </div>

                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Product Description</label>
                                            <textarea class="form-control subheading mt-1" id="description" name="description" rows="3"></textarea>
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
                                                <option value="milliliters">Milliliters (ml)</option>
                                                <option value="liters">Liters (l)</option>
                                                <option value="fluid_ounces">Fluid ounces (Fl. oz.)</option>
                                                <option value="grams">Grams (g)</option>
                                                <option value="kilograms">Kilograms (kg)</option>
                                                <option value="gallons">Gallons (gal)</option>
                                                <option value="ounces">Ounces (oz)</option>
                                                <option value="pounds">Pounds (lb)</option>
                                                <option value="centimeters">Centimeters (cm)</option>
                                                <option value="feet">Feet (ft)</option>
                                                <option value="inches">Inches (in)</option>
                                                <option value="whole">A whole product</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="order_tax">Amount</label>
                                            <input type="text" class="form-control subheading " placeholder="0%"
                                                id="amount" name="amount" />
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
                                                id="supply_price" placeholder="0.00">
                                        </div>
                                    </div>
                                </div>
                                <h6>Retail sales</h6>
                                <span class="text-secondary">Allow sales of this product at checkout.</span>
                                <div class="row mt-2">
                                    {{-- <div class="form-check ps-5">
                                        <input class="form-check-input" type="checkbox" value="1"
                                            name="retail_sales" id="retail_sales">
                                        <label class="form-check-label" for="retail_sales">
                                            Enable retail sales
                                        </label>
                                    </div> --}}
                                    <div class="d-flex align-items-center">
                                        <label class="switch mt-2">
                                            <input type="checkbox" name="retail_sales"
                                                id="retail_sales" value="1">
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
                                                placeholder="e.g. 0.00" name="retail_price" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="retail_price" class="mb-1">Marked</label>
                                            <input type="text" class="form-control subheading" id="marked"
                                                placeholder="e.g. 0.00" name="marked" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3 " id="retail-option-tax" style="display: none">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="notify_days" class="mb-1">Tax (Included in price) </label>
                                            <select name="sales_tax" id="sales_tax" class="form-control subheading">
                                                <option disabled>Select an Option</option>
                                                <option value="No Tax">No Tax</option>
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
                                                    id="team_memeber_commission" value="1">
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
                                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
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
                                                        id="track_stock_quantity" value="1" checked>
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
                                                id="current_stock_quantity" name="current_stock_quantity" />
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
                                                <input type="number" class="form-control subheading " placeholder="0"
                                                    id="low_stock_level" name="low_stock_level" />
                                                <span class="text-secondary">The level to get notified to reorder</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="order_tax">Reorder quantity </label>
                                                <input type="number" class="form-control subheading " placeholder="0"
                                                    id="reorder_quantity" name="reorder_quantity" />
                                                <span class="text-secondary">The default amount to order</span>
                                            </div>
                                        </div>
                                </div>
                                <div class="track-div">
                                    <div class="d-flex align-items-center">
                                        <label class="switch mt-2">
                                            <input type="checkbox" name="low_stock_noti" id="low_stock_noti"
                                                value="1">
                                            <span class="slider"></span>
                                        </label>
                                        <p class="m-0">Receive low stock notification</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card rounded-3 mt-4">
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
                                        <img src="{{ asset('assets/dasheets/img/upload-btn.svg') }}"
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
                                <div class="upload__img-wrap"></div>
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
            $('#productForm').on('submit', function(e) {
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




        var units = {{ collect() }};
        $('#product_unit').change(function() {
            var unitId = $(this).val();

            // Filter the units based on the selected product unit
            var childUnits = units.filter(function(unit) {
                return unit.parent_id == unitId;
            });

            // Clear the "Sale Unit" and "Purchase Unit" dropdowns
            $('#sale_unit').empty();
            $('#purchase_unit').empty();

            // Populate the "Sale Unit" and "Purchase Unit" dropdowns
            childUnits.forEach(function(unit) {
                $('#sale_unit').append('<option value="' + unit.id + '">' + unit.name + '</option>');
                $('#purchase_unit').append('<option value="' + unit.id + '">' + unit.name + '</option>');
            });
        });





        document.addEventListener('DOMContentLoaded', function() {

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

            let product_type = document.getElementById('product_type');
            let variant_form = document.querySelector('.variant-form')
            product_type.addEventListener('change', function() {
                if (this.value == 'variable') {
                    variant_form.style.display = 'flex';
                    // document.getElementById('purchase_price').style.display = 'none';
                    // document.getElementById('sell_price').style.display = 'none';
                    document.querySelectorAll('.unit-display').forEach(element => element.style.display =
                        'block');
                    document.getElementById('stock_alert').style.display = 'block';
                } else if (this.value == 'service') {
                    document.getElementById('sell_price').style.display = 'block';
                    document.getElementById('purchase_price').style.display = 'none';
                    document.querySelectorAll('.unit-display').forEach(element => element.style.display =
                        'none');
                    $('#product_unit').val('');
                    $('#sale_unit').val('');
                    $('#purchase_unit').val('');
                    $('.variant-input-fields').val('');
                    variant_form.style.display = 'none';
                    document.getElementById('stock_alert').style.display = 'none';
                } else {
                    $('.variant-input-fields').val('');
                    variant_form.style.display = 'none';
                    document.getElementById('purchase_price').style.display = 'block';
                    document.getElementById('sell_price').style.display = 'block';
                    document.querySelectorAll('.unit-display').forEach(element => element.style.display =
                        'block');
                    document.getElementById('stock_alert').style.display = 'block';
                }
            });

            const variantsContainer = document.querySelector('.variants-container');
            const addVariantButton = document.querySelector('.add-variant');
            const variantNameInput = document.querySelector('.variant-name-input');
            let sectionIndex = 0;

            addVariantButton.addEventListener('click', function() {
                const variantName = variantNameInput.value.trim();
                if (variantName !== '') {
                    const newSection = document.createElement('div');
                    newSection.classList.add('variant-section');
                    newSection.dataset.sectionIndex = sectionIndex;
                    newSection.innerHTML = `
                    <h4>Variant: <span class="variant-name">${variantName}</span></h4>
                    <div class="variant-inputs">
                        <!-- Variant inputs will be added here -->

                        <div class="row">
                            <div class="w-20 subheading mt-2"><b>Variant Name</b></div>
                            <div class="w-20 subheading mt-2"><b>Variant Code</b></div>
                            <div class="w-20 subheading mt-2"><b>Variant Cost</b></div>
                            <div class="w-20 subheading mt-2"><b>Variant Price</b></div>
                        </div>
                    </div>
                    <button class="add-variant-input btn btn-success btn-sm" type="button">Add</button>
                    <button class="remove-section btn btn-danger btn-sm" type="button">Remove Section</button>
                `;
                    variantsContainer.appendChild(newSection);
                    addVariantInput(newSection, sectionIndex, 0);
                    variantNameInput.value = '';
                    sectionIndex++;
                } else {
                    alert('Please enter a variant name.');
                }
            });

            variantsContainer.addEventListener('click', function(event) {
                const target = event.target;
                if (target.classList.contains('add-variant-input')) {
                    const variantSection = target.closest('.variant-section');
                    const sectionIdx = variantSection.dataset.sectionIndex;
                    const optionIndex = variantSection.querySelectorAll('.variant-input').length;
                    addVariantInput(variantSection, sectionIdx, optionIndex);
                } else if (target.classList.contains('remove-variant-input')) {
                    target.closest('.variant-input').remove();
                } else if (target.classList.contains('remove-section')) {
                    target.closest('.variant-section').remove();
                }
            });

            function addVariantInput(variantSection, sectionIdx, optionIndex) {
                const variantInputs = variantSection.querySelector('.variant-inputs');
                const newVariantInput = document.createElement('div');
                newVariantInput.classList.add('variant-input', 'form-group', 'row', 'mb-3');
                newVariantInput.innerHTML = `
                <input class="form-control subheading mt-2 w-100 variant-input-fields" type="hidden" name="variants[${sectionIdx}][name]" value="${variantSection.querySelector('.variant-name').textContent}">
                <div class="w-20"><input class="form-control subheading mt-2 w-100 variant-input-fields" type="text" name="variants[${sectionIdx}][options][${optionIndex}][code]" placeholder="Variant Code"></div>
                <div class="w-20"><input class="form-control subheading mt-2 w-100 variant-input-fields" type="text" name="variants[${sectionIdx}][options][${optionIndex}][sub_name]" placeholder="Sub Variant Name"></div>
                <div class="w-20"><input class="form-control subheading mt-2 w-100 variant-input-fields" type="text" name="variants[${sectionIdx}][options][${optionIndex}][cost]" placeholder="Variant Cost"></div>
                <div class="w-20"><input class="form-control subheading mt-2 w-100 variant-input-fields" type="text" name="variants[${sectionIdx}][options][${optionIndex}][price]" placeholder="Variant Price"></div>
                <a class="w-20 remove-variant-input btn text-danger border-danger" type="button"><i class="bi bi-trash3"></i></a>
            `;
                variantInputs.appendChild(newVariantInput);
            }
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
