@extends('admin.layout.app')
@section('title', 'Membership-sold')
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
                        <h4 class="card-title mb-0">Membership Sold</h4>
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
                                            <th class="sort">Name</th>
                                            <th class="sort">Client</th>
                                            <th class="sort">Type</th>
                                            <th class="sort">Start Date</th>
                                            <th class="sort">End Date</th>
                                            <th class="sort">Total Charged</th>
                                            <th class="sort">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach ($paid_plans as $plan)
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="chk_child">
                                                    </div>
                                                </th>
                                                <td class="align-middle">{{ $plan->client->name ?? '' }}</td>
                                                <td class="align-middle">{{ $plan->membership->name ?? 'N/A' }}</td>
                                                <td class="align-middle">{{ $plan->type ?? 'N/A' }}</td>
                                                <td class="align-middle">{{ $plan->start_date ?? 'N/A' }}</td>
                                                <td class="align-middle">{{ $plan->end_date ?? 'N/A' }}</td>

                                                <td class="align-middle">{{ $plan->total_charged ?? 'N/A' }}</td>

                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input changeStatus" {{$plan->status == 1 ?  'checked' : ''}} type="checkbox" role="switch" id="flexSwitchCheckDefault" data-id="{{$plan->id}}">
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



            $('.changeStatus').change(function() {
                var id = $(this).data('id');
                var status = $(this).prop('checked') ? 1 : 0;

                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    url: '{{route('paid-plans.change-status')}}',
                    data: {
                        id: id,
                        status: status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if(response.status){
                            Swal.fire({
                                title: "Success!",
                                text: response.message,
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1000
                            });
                        }
                    },
                    error: function(err) {
                        Swal.fire({
                            title: "Error!",
                            text: "Something went wrong",
                            icon: "error"
                        });
                    }
                });
        });


        });


    </script>
@endsection
