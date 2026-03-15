@extends('admin.layout.app')
@section('title', 'Client')
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


    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">All Clients</h4>
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
                                        <a href="{{ route('clients.create') }}" class="btn btn-success add-btn"> Add</a>
                                        <button class="btn btn-soft-danger" id="download-excel"> Export</button>
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
                                            <th class="sort">Client Name</th>
                                            <th class="sort">Email</th>
                                            <th class="sort">Mobile Number</th>
                                            <th class="sort">Sales</th>
                                            <th class="sort">Created at</th>
                                            <th class="sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach ($clients as $client)
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="chk_child">
                                                    </div>
                                                </th>
                                                <td class="align-middle">{{ $client->user->name ?? '' }}</td>
                                                <td class="align-middle">{{ $client->user->email ?? 'N/A' }}</td>
                                                <td class="align-middle client-phone">{{ $client->user->phone ?? 'N/A' }}
                                                </td>
                                                <td class="align-middle">0.00</td>
                                                <td class="align-middle">{{ $client->created_at->format('d-m-Y') }}</td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <button type="button"
                                                            class="btn btn-outline-primary me-2 send-message-btn"
                                                            data-bs-toggle="modal" data-bs-target="#sendMessageModal">
                                                            Send Message
                                                        </button>
                                                        <div class="edit">
                                                            <a href="{{ route('clients.edit', $client->user->id??'') }}"
                                                                class="btn btn-success edit-item-btn">Edit</a>
                                                        </div>
                                                        <button type="button"
                                                            class="btn btn-sm btn-danger remove-item-btn delSubBtn"
                                                            data-id="{{ $client->user->id??'' }}">
                                                            Remove
                                                        </button>
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

    <!-- Modal -->
    <div class="modal fade" id="sendMessageModal" tabindex="-1" aria-labelledby="sendMessageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="sendMessageModalLabel">Send Message</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('send-sms.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @include('admin.layout.errors')

                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="modalPhone">Phone number (with country code)</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                        name="phone" id="modalPhone" placeholder="Phone number"
                                        value="{{ old('phone') }}" required />
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="message">Message</label>
                            <textarea class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" id="message" name="message"
                                rows="5" placeholder="Message" required>{{ old('message') }}</textarea>
                            @error('message')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success add-btn rounded-3 me-2">Send</button>
                    </form>
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
                        url: `clients/${dataId}`,
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
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var sendMessageModal = document.getElementById('sendMessageModal');
            sendMessageModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget; // Button that triggered the modal
                var row = button.closest('tr'); // Find the closest row
                var phone = row.querySelector('.client-phone').textContent.trim(); // Get the phone number

                // Update the modal's input with the phone number
                var modalPhoneInput = sendMessageModal.querySelector('#modalPhone');
                modalPhoneInput.value = phone;
            });
        });
    </script>

@endsection
