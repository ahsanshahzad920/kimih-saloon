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
@endsection
@section('content')

    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">All Sales</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="listjs-table" id="customerList">
                            <div class="row g-4 mb-3">
                                <div class="col-sm">
                                    <div class="d-flex ">
                                        <div class="search-box ms-2">
                                            <input type="text" class="form-control search" placeholder="Search..."
                                                id="custom-filter">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-auto justify-content-sm-end">
                                    <div>
                                        <a href="{{ route('sales.create') }}"
                                            class="btn btn-success add-btn ">Add Sales <i
                                                class="bi bi-plus-lg mt-0"></i>
                                        </a>

                                    </div>
                                </div>

                            </div>

                            <div class="table-responsive table-card mt-3 mb-1">
                                <div class="alert alert-danger p-2 text-end" id="deletedAlert" style="display: none">
                                    <div style="display: flex;justify-content:space-between">
                                        <span><span id="deleteRowCount">0</span> rows selected</span>
                                        <button class="btn btn-sm btn-danger" id="deleteRowTrigger">Delete</button>
                                    </div>
                                </div>
                                <table class="table align-middle table-nowrap" id="example">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" style="width: 50px;">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="checkAll"
                                                        value="option">
                                                </div>
                                            </th>
                                            <th class="sort">Sale Date</th>
                                            <th class="sort">Client</th>
                                            {{-- <th class="sort">Payment Method</th> --}}
                                            <th class="sort">Paid</th>
                                            <th class="sort">Due</th>
                                            <th class="sort">Gross Total</th>
                                            <th class="sort">Status</th>
                                            <th class="sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach ($sales as $sale)
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="chk_child">
                                                    </div>
                                                </th>
                                                <td class="align-middle">{{ $sale->date }}</td>
                                                <td class="align-middle">{{ $sale->client->name ?? 'N/A' }}</td>
                                                {{-- <td class="align-middle">{{ $sale->payment_method ?? 'N/A' }}</td> --}}
                                                <td class="align-middle">{{ $sale->cash_received ?? '0.00' }}</td>
                                                <td class="align-middle">{{ $sale->due_amount ?? '0.00' }}</td>
                                                <td class="align-middle">{{ $sale->grand_total ?? '0.00' }}</td>
                                                <td class="align-middle">
                                                    <span
                                                        class="badges green-border text-center">{{ $sale->status ?? '' }}</span>
                                                </td>

                                                <td>
                                                    {{-- <div class="d-flex gap-2">
                                                        <div class="edit">
                                                            <a href="{{ route('sales.edit', $sale->id) }}"
                                                                class="btn btn-sm btn-success edit-item-btn">Edit</a>
                                                        </div>

                                                        <button type="button"
                                                            class="btn btn-sm btn-danger remove-item-btn delSubBtn"
                                                            data-id="{{ $sale->id }}">
                                                            Remove
                                                        </button>

                                                    </div> --}}
                                                    <div class="" style="overflow: visible">
                                                        <a class="btn btn-secondary bg-transparent border-0 text-dark" role="button"
                                                            id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="fa-solid fa-ellipsis-v"></i>
                                                        </a>

                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            @if ($sale->due_amount != 0 && ($sale->status == 'Unpaid' || $sale->status == 'Part Paid'))
                                                                <a href="#" class=" dropdown-item payNowbtn" style="cursor: pointer" data-bs-target="#exampleModalToggle5"
                                                                data-bs-toggle="modal" id="payNowbtn" data-sale="{{$sale}}">
                                                                    <i class="fa fa-doller text-warning me-2"></i>
                                                                    Pay now
                                                                </a>

                                                            @endif
                                                            <a href="#" class=" dropdown-item" style="cursor: pointer" >
                                                                <i class="fa fa-doller text-warning me-2"></i>
                                                                Refund items
                                                            </a>
                                                            <a href="javascript:void(0);" class="dropdown-item">

                                                                    <i class="fa fa-pencil text-danger"></i>

                                                                    <button type="submit" class="btn btn-sm">
                                                                        Edit sale Details
                                                                    </button>
                                                                </form>
                                                            </a>
                                                            <a href="{{route('sales.show',$sale->id)}}" class="dropdown-item">
                                                                    <i class="fa fa-eye text-danger"></i>

                                                                    <button type="submit" class="btn btn-sm">
                                                                        Invoice
                                                                    </button>
                                                                </form>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="noresult" style="display: none">
                                    <div class="text-center">
                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                            colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                        </lord-icon>
                                        <h5 class="mt-2">Sorry! No Result Found</h5>
                                        <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any
                                            orders for you search.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <div class="pagination-wrap hstack gap-2">
                                    <a class="page-item pagination-prev" href="javascript:void(0)" id="prevPage">
                                        Previous
                                    </a>
                                    <ul class="pagination listjs-pagination mb-0"></ul>
                                    <a class="page-item pagination-next" href="javascript:void(0);" id="nextPage">
                                        Next
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card -->
                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
    <!-- end main content-->

{{-- @foreach ($sales as $sale)
    <!-- Start Modal for continue payment -->
    <div class="modal fade" id="exampleModalToggle5{{$sale->id}}" tabindex="-1" aria-labelledby="exampleModalToggle5Label"
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
                                <input type="text"  class="form-control paying_amount" placeholder="0.00" value="{{$sale->due_amount}}" disabled>
                            </div>
                            <div class="cashDiv" style="display: none">
                                <div class="form-group mb-2">
                                    <label for="sale_note" class="form-label">Cash Received</label>
                                    <input type="text" id="cash_received" class="form-control" placeholder="0.00"
                                    value="{{$sale->due_amount}}">
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
                    <button type="button" class="btn btn btn-success add-btn" id="saveAddPaymentButton" data-sale-id="{{$sale->id}}" data-client-id="{{$sale->client_id}}">Add
                        Payment</button>
                </div>
            </div>
        </div>
    </div>
@endforeach --}}

<div class="modal fade" id="exampleModalToggle5" tabindex="-1" aria-labelledby="exampleModalToggle5Label"
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
                        <input type="hidden" id="sale_id" value="">
                        <input type="hidden" id="client_id" value="">
                        <div class="form-group">
                            <label for="sale_note" class="form-label">Paying Amount</label>
                            <input type="text" id="paying_amount"  class="form-control paying_amount" placeholder="0.00" value="" disabled>
                        </div>
                        <div class="cashDiv" id="cashDiv" style="display: none">
                            <div class="form-group mb-2">
                                <label for="sale_note" class="form-label">Cash Received</label>
                                <input type="text" id="cash_received" class="form-control" placeholder="0.00"
                                value="">
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
                <button type="button" class="btn btn btn-success add-btn" id="saveAddPaymentButton" >Add
                    Payment</button>
            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')
    <script src="{{ asset('assets_old/js/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets_old/js/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script> --}}

    <script>
        $(document).ready(function() {
            // $('#example').DataTable();

            // // Custom pagination events
            // $('.prev-page').on('click', function() {
            //     table.page('previous').draw('page');
            // });

            // $('.next-page').on('click', function() {
            //     table.page('next').draw('page');
            // });



            var table = $('#example').DataTable({
                dom: 'Bfrtip',
                select: true,
                select: {
                    style: 'multi'
                },
                buttons: [{
                        extend: 'pdf',
                        footer: true,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'csv',
                        footer: false,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }

                    },
                    {
                        extend: 'excel',
                        footer: false,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    }
                ]
            });

            $('#custom-filter').keyup(function() {
                table.search(this.value).draw();
            });

            $('#download-pdf').on('click', function() {
                table.button('.buttons-pdf').trigger();
            });
            $('#download-excel').on('click', function() {
                table.button('.buttons-excel').trigger();
            });

            // Select all checkbox click handler
            $('#myCheckbox09').on('click', function() {
                var isSelected = $(this).is(':checked'); // Check if checkbox is checked

                // Select/deselect all checkboxes with class 'select-checkbox'
                $('.select-checkbox').prop('checked', isSelected);

                // Optional: Update DataTables selection based on checkbox state
                if (isSelected) {
                    table.rows().select(); // Select all rows in DataTables (adjust if needed)
                    // confirm('Are you sure you want to delete all record?');
                    $('#deletedAlert').css('display', 'block');
                    $('#deleteRowCount').text($('.deleteRow:checked').length);


                } else {
                    table.rows().deselect(); // Deselect all rows in DataTables (adjust if needed)
                    $('#deletedAlert').css('display', 'none');
                }
            });

            table.on('select.dt', function(e, dt, type, indexes) {
                // console.log("slected")
                var row = table.row(indexes[0]); // Get the selected row

                // Find checkbox within the selected row
                var checkbox = row.node().querySelector('.select-checkbox');

                if (checkbox) { // Check if checkbox exists
                    // console.log("slected")
                    checkbox.checked = true; // Check the checkbox
                    $('#deletedAlert').css('display', 'block');
                    $('#deleteRowCount').text($('.deleteRow:checked').length);

                }
            });

            table.on('deselect.dt', function(e, dt, type, indexes) {
                var selectedRows = table.rows('.selected').count();
                var row = table.row(indexes[0]); // Get the selected/deselected row
                var checkbox = row.node().querySelector('.select-checkbox');

                if (checkbox) {
                    // Update checkbox state based on event type
                    checkbox.checked = type === 'select';
                }
                $ // Show/hide delete alert based on selection count
                if (selectedRows === 0) {
                    $('#deletedAlert').css('display', 'none');
                } else {
                    $('#deletedAlert').css('display', 'block');
                    $('#deleteRowCount').text($('.deleteRow:checked').length);
                }
            });

            $('#deleteRowTrigger').on("click", function(event) { // triggering delete one by one
                if (confirm("Are you sure you won't be able to revert this!")) {
                    if ($('.deleteRow:checked').length > 0) { // at-least one checkbox checked
                        var ids = [];
                        $('.deleteRow').each(function() {
                            if ($(this).is(':checked')) {
                                let id = $(this).data('id');
                                ids.push(id);
                            }
                        });
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            type: "POST",
                            url: "{{ route('users.delete') }}",
                            data: {
                                ids
                            },
                            success: function(result) {
                                if (result.status === 200) {
                                    location.reload();
                                }
                            },
                            async: false
                        });
                    }
                }
            });

            // // // Custom pagination events
            // $('.new-pagination .paginate_button').on('click', function() {
            //     if ($(this).hasClass('rounded-start')) {
            //         table.page('previous').draw('page');
            //     } else if ($(this).hasClass('rounded-end')) {
            //         table.page('next').draw('page');
            //     }
            // });

            // // Handle rows per page change
            // $('#rowsPerPage').on('change', function() {
            //     var rowsPerPage = $(this).val();
            //     table.page.len(rowsPerPage).draw();
            // });

            // // Update rows per page select on table draw
            // table.on('draw', function() {

            //     var pageInfo = table.page.info();
            //     var currentPage = pageInfo.page + 1; // Adding 1 to match human-readable page numbering
            //     var totalPages = pageInfo.pages;
            //     var totalRecords = pageInfo.recordsTotal;

            //     // Calculate start and end records for the current page
            //     var startRecord = pageInfo.start + 1;
            //     var endRecord = startRecord + pageInfo.length - 1;
            //     if (endRecord > totalRecords) {
            //         endRecord = totalRecords;
            //     }

            //     $('#rowsPerPage').val(table.page.len());
            //     $('#dataTableInfo').text('Showing ' + startRecord + '-' + endRecord + ' of ' +
            //         totalRecords + ' entries');
            // });

            // table.draw();

            // Custom pagination events
            $('#prevPage').on('click', function() {
                table.page('previous').draw('page');
            });

            $('#nextPage').on('click', function() {
                table.page('next').draw('page');
            });

            // Handle rows per page change
            $('#rowsPerPage').on('change', function() {
                var rowsPerPage = $(this).val();
                table.page.len(rowsPerPage).draw();
            });

            // Update rows per page select on table draw
            table.on('draw', function() {
                $('#rowsPerPage').val(table.page.len());
            });

        });

        $(document).on('click', '.delSubBtn', function(e) {
            // e.preventDefault();
            // var dataId = $(e.originalEvent.submitter).closest('.delSubBtn').data('id');
            // var form = this; // 'this' refers to the form that was submitted
            var dataId = $(this).data('id'); // Get the data-id of the clicked button
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            Swal.fire({
                title: "Are you sure?",
                text: "You will not be able to recover this record!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `sales/${dataId}`,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            console.log(response)
                            if (response.status) {
                                Swal.fire({
                                    title: "Success!",
                                    text: response.message,
                                    icon: "success"
                                });

                                // Refresh Data Table
                                $("#example").load(window.location + " #example");
                            }
                        },
                        error: function(xhr, status, error) {
                            var errors = xhr.responseJSON.message;

                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                html: errors
                            });
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire(
                        'Cancelled',
                        'Your record is safe :)',
                        'error'
                    )
                }
            })
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
        $(document).on('change', '#payment_method', function() {
            if ($(this).val() == 'Cash') {
                $('#cashDiv').show();
            } else {
                $('#cashDiv').hide();
            }
        });
        $(document).on('click','#saveAddPaymentButton',function(){

            // var sale_id = $('#payment_method').val();
            var sale_id = $('#sale_id').val();
            var client_id = $('#client_id').val();

            var client_id = $(this).data('client-id');
            // alert(sale_id);
            // alert(client_id);
            // alert(client_id);
            var payment_method = $('#payment_method').val();
            var paying_amount = $('#paying_amount').val();
            var cash_received = $('#cash_received').val();
            var due = $('#due').val();
            var cash_return = $('#cash_return').val();
            var cash_received_by = $('#cash_received_by').val();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: `{{route('payment-transactions.store')}}`,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    payment_method: payment_method,
                    paying_amount: paying_amount,
                    paid_amount: cash_received,
                    due: due,
                    cash_return: cash_return,
                    cash_received_by: cash_received_by,
                    sale_id,
                    client_id,
                },
                success: function(response) {
                    console.log(response)
                    if (response.status) {
                        Swal.fire({
                            title: "Success!",
                            text: response.message,
                            icon: "success"
                        });

                        // Refresh Data Table
                        // $("#example").load(window.location + " #example");
                        window.location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    var errors = xhr.responseJSON.message;

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        html: errors
                    });
                }
            });
        })
        $(document).on('click','.payNowbtn', function () {

            let sale = $(this).data('sale');
            console.log(sale);
            $('#paying_amount').val(sale.due_amount);
            $('#cash_received').val(sale.due_amount);
            $('#sale_id').val(sale.id);
            $('#client_id').val(sale.client_id);

            $('#exampleModalToggle5').modal('show');

        })
    </script>
@endsection
