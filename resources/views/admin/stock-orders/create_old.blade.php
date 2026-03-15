@extends('admin.layout.app')
@section('title', 'Categories')
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
                <h3 class="all-adjustment text-center pb-2 mb-0">Stock Order</h3>
            </div>
            <form class="container-fluid" action="{{ route('stock-orders.store') }}" method="POST" id="createSaleForm">
                @csrf
                <div class="card card-shadow rounded-3 border-0 mt-5">
                    <div class="card-body">


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1" class="mb-1 fw-bold">Expected Date <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control subheading" type="date" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1" class="mb-1 fw-bold">Select Supplier <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control form-select subheading mt-1"
                                        aria-label="Default select example" name="supplier_id" id="suppliers">
                                        <option value="">Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1" class="mb-1 fw-bold">Select Supplier <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control form-select subheading mt-1"
                                        aria-label="Default select example" name="customer_id" id="suppliers">
                                        <option value="">Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}

                        </div>

                        <div class="form-group mt-2">
                            <label for="exampleFormControlSelect1" class="mb-1 fw-bold">Manage products for order </label>
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
                                    <th class="align-middle">Barcode</th>
                                    <th class="align-middle">Category</th>
                                    <th class="align-middle">Unit cost</th>
                                    <th class="align-middle">Order Qty.</th>
                                    <th class="align-middle">Total cost</th>
                                    <th class="align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-2 px-3">
                        <div class="col-md-8"></div>
                        <div class="col-md-4 border rounded-2 pt-2">
                            <div class="row border-bottom subheading">
                                <div class="col-md-6 col-6">Subtotal</div>
                                <div class="col-md-6 col-6" id="subtotal">$0.00</div>
                            </div>

                            <div class="row border-bottom">
                                <div class="col-md-6 col-6">Fees</div>
                                <div class="col-md-6 col-6" id="total_fees">$0.00</div>
                            </div>

                            <div class="row disabled-bg">
                                <div class="col-md-6 col-6">Grand Total</div>
                                <div class="col-md-6 col-6" id="grand_total">$0.00</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Input Fields -->
                <!-- Input Fields -->
                <div class="card card-shadow rounded-3 border-0 mt-4 p-2">
                    <div class="card-body">
                        <div class="row">

                            <a href="#" data-fees="" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" id="addFeeBtn">Add Fees</a>

                        </div>
                    </div>
                </div>
                <!-- Input Fields End -->
                <button class="btn btn btn-success add-btn mt-3" type="submit">Submit</button>

            </form>
        </div>

    </div>



    <!-- Create Modal STart -->
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h3 class="all-adjustment text-center pb-2 mb-0" style="width: 57%;">
                        Manage fees
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    {{-- <div class="row mt-2 d-flex align-items-center">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Fee Name</label>
                                <input type="text" class="form-control subheading" name="fee_name[]" id="fee_name"
                                    placeholder="Name" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Fee Name</label>
                                <input type="text" class="form-control subheading" name="fee_name[]" id="fee_name"
                                    placeholder="Name" required>
                            </div>
                        </div>
                        <div class="col-md-2 mt-4">
                            <div class="form-group">
                                <button >Remove</button>
                            </div>
                        </div>

                    </div> --}}



                    <div class=" mt-4">
                        <div id="fees-container">
                            <!-- Initial input fields -->
                            <div class="fee-row row mt-2">
                                <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Fee Name</label>
                                <input type="text" class="form-control subheading fee-name" name="fee_name[]" id="fee_name"
                                    placeholder="Name" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Fee Amount</label>
                                <input type="text" class="form-control subheading fee-amount" name="fee_amount[]" id="fee_amount"
                                    placeholder="0.00" required>
                            </div>
                        </div>
                        <div class="col-md-2 mt-4">
                            <div class="form-group">
                                <button class="remove-fee btn btn-danger btn-sm">Remove</button>
                            </div>
                        </div>


                            </div>
                        </div>
                        <button id="add-more-fees" class="btn btn-sm btn-dark mt-2">Add More</button>
                    </div>

                    <hr>
                    <button class="btn btn btn-success add-btn mt-4" id="save-btn">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const productCodeInput = document.getElementById("product_code");
            let prodCount = 1;

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
                            .barcodes[0]['code']) {
                            // alert('Duplicate product cannot be added!');

                            toastr.error('Duplicate product cannot be added!');
                            alert("Duplicate product cannot be added!")

                            isDuplicate = true;
                        }
                    });

                    if (!isDuplicate) {
                        // Append row code here
                        // Assuming data contains product name, code, etc.
                        // let quantity = ui.item.product.current_stock_quantity;

                        row.innerHTML = `
                            <td class="align-middle">${prodCount}</td>
                            <td class="product_name align-middle ">${ui.item.product.name}</td>
                            <td class=" align-middle ">${ui.item.product.barcodes[0]['code']}</td>
                            <td class="product_sell_price align-middle ">${ui.item.product.category.name}</td>
                            <td class="align-middle">
                                <input
                                type="number"
                                id=""
                                class="product_qty border-0 price-input"
                                value="${ui.item.product.supply_price}" min="0"
                                />
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
                            <td class="product_price align-middle">0.00</td>
                            <td class="align-middle">
                            <div class="d-flex justify-content-center">
                                <a href="#" class="btn btn-plus item-delete" data-product='${JSON.stringify(ui.item.product)}'>
                                    <img src="{{ asset('assets/dasheets/img/plus-circle.svg') }}" alt="" />
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

                $.ajax({
                    url: '/get-product-detail', // Replace with your search route
                    dataType: "json",
                    data: {
                        query: searchTerm,
                    },
                    success: function(data) {
                        console.log(data);
                        var suggestions = [];
                        for (var i = 0; i < data.product.length; i++) {
                            suggestions.push({
                                value: data.product[i].name,
                                label: data.product[i].name,
                                id: data.product[i].id,
                                product: data.product[i]
                            });
                        }
                        response(suggestions);
                    }
                });

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
                const price = $(this).closest('tr').find('td:nth-child(5) input').val();
                const subtotal = parseInt(quantity) * parseFloat(price);
                $(this).closest('tr').find('td:nth-child(7)').text(subtotal.toFixed(2));
                calculateTotal();
            });
            // Handle changes in price
            $(document).on('change', '.price-input', function() {
                const price = $(this).val();
                const quantity = $(this).closest('tr').find('td:nth-child(6) input').val();
                const subtotal = parseFloat(price) * parseInt(quantity);
                $(this).closest('tr').find('td:nth-child(7)').text(subtotal.toFixed(2));
                calculateTotal();
            });

            // Event listeners for discount, shipping, and order tax inputs
            $('#discount, #shipping, #order_tax').on('input', calculateTotal);




        });

        function calculateTotal(fees = null) {
            let subtotal = 0;
            $('.table tbody tr').each(function() {
                subtotal += parseFloat($(this).find('td:nth-child(7)').text() || 0);
            });

            let grandTotal = subtotal;
            let feesTotal = 0.00;
            if (fees != null) {
                // Iterate through fees array and sum up the fee amounts
                fees.forEach(function(fee) {
                    feesTotal += parseFloat(fee.amount);
                });

                // Add fees total to grand total
                grandTotal += feesTotal;
            }


            // Update the UI
            // $('#shipping_display').text(`$${shipping.toFixed(2)}`);
            $('#grand_total').text(`$${grandTotal.toFixed(2)}`);
            $('#total_fees').text(`$${feesTotal.toFixed(2)}`);
            $('#subtotal').text(`$${subtotal.toFixed(2)}`);

        }



        $(document).ready(function() {
            $('#createSaleForm').on('submit', function(e) {
                e.preventDefault();
                // alert('yes');

                // Collect form data
                let formData = {
                    expected_date: $(this).find('[type=date]').val(),
                    supplier_id: $('#suppliers').val(),
                    total_fees: parseFloat(document.getElementById('total_fees').textContent.replace(
                        '$', '')),
                    sub_total: parseFloat(document.getElementById('subtotal').textContent.replace(
                        '$', '')),
                    grand_total: parseFloat(document.getElementById('grand_total').textContent.replace(
                        '$', '')),

                    order_items: [],
                    fees: $('#addFeeBtn').data('fees'),
                };

                // Collect order items
                $('#mainTable tbody tr').each(function() {
                    let item = {
                        product_id: $(this).find('td:nth-child(8) .item-delete').data('product').id,
                        quantity: $(this).find('td:nth-child(6) input').val(),
                        price: $(this).find('td:nth-child(5) input').val(),
                        subtotal: $(this).find('td:nth-child(7)').text(),
                    };
                    formData.order_items.push(item);

                });

                // AJAX request to server
                $.ajax({
                    url: '{{ route('stock-orders.store') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    success: function(response) {
                        console.log(response);
                        toastr.success('Stock order created successfully!');
                        window.location.href = "{{ route('stock-orders.index') }}";
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


        $(document).on('click', '.item-delete', function(e) {
            e.preventDefault();
            $(this).closest('tr').remove();
            calculateTotal();
        });


        $(document).ready(function() {
            // Add More button click event
            $('#add-more-fees').click(function(e) {
                e.preventDefault();
                // Clone the last fee row and append it to the container
                // $('#fees-container .fee-row:last').clone().appendTo('#fees-container');

                // Clone the last fee row and append it to the container
                var clone = $('#fees-container .fee-row:last').clone();
                clone.find('input').val(''); // Clear input values
                clone.appendTo('#fees-container');
            });

            // Remove button click event (delegated for dynamically added elements)
            $('#fees-container').on('click', '.remove-fee', function(e) {
                e.preventDefault();
                // Remove the clicked fee row
                $(this).closest('.fee-row').remove();
            });


            // Save button click event
            $('#save-btn').click(function(e) {
                e.preventDefault();
                var fees = [];
                // Loop through each fee row
                $('.fee-row').each(function() {
                    var feeName = $(this).find('.fee-name').val();
                    var feeAmount = $(this).find('.fee-amount').val();
                    // Add fee details to the fees array
                    fees.push({ name: feeName, amount: feeAmount });
                });
                // // Do something with the fees array, like sending it to the server
                // console.log(fees);
                calculateTotal(fees);
                $('#addFeeBtn').attr('data-fees', JSON.stringify(fees));
                // Hide modal
                $('#exampleModalToggle').modal('hide');

            });
        });
    </script>

@endsection
