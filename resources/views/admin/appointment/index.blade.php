@extends('admin.layout.app')
@section('title', 'Appointment-List')
@section('styles')
    <link href="{{ asset('assets_old/js/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('virtual-select-master/dist/virtual-select.min.css') }}" />
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
                        <h4 class="card-title mb-0">All Appointments</h4>
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
                                            <th class="sort">Ref</th>
                                            <th class="sort">Name</th>
                                            <th class="sort">Client</th>
                                            <th class="sort">Services</th>
                                            <th class="sort">Created by</th>
                                            <th class="sort">Created Date</th>
                                            <th class="sort">Scheduled Date</th>
                                            <th class="sort">Duration</th>
                                            <th class="sort">Team Member</th>
                                            <th class="sort">Price</th>
                                            <th class="sort">Status</th>
                                            <th class="sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach ($appointments as $appointment)
                                            <tr>
                                                {{-- <td class="status"><span
                                                        class="badge bg-success-subtle text-success text-uppercase">Completed</span>
                                                </td> --}}
                                                <td class="align-middle">{{ $appointment->ref ?? 'N/A' }}</td>
                                                <td class="align-middle">{{ $appointment->title ?? 'N/A' }}</td>
                                                <td class="align-middle">{{ $appointment->client->name ?? 'N/A' }}</td>
                                                <td class="align-middle">
                                                    @foreach ($appointment->services as $service)
                                                        {{ $service->service->service_name ?? 'N/A' }} <br>
                                                    @endforeach
                                                </td>
                                                <td class="align-middle">{{ $appointment->userCreatedBy->name ?? 'N/A' }}
                                                </td>
                                                <td class="align-middle">
                                                    {{ $appointment->created_at->format('d-m-Y') ?? 'N/A' }}</td>
                                                <td class="align-middle">{{ $appointment->start ?? 'N/A' }}</td>
                                                @php
                                                    $start = \Carbon\Carbon::parse($appointment->start);
                                                    $end = \Carbon\Carbon::parse($appointment->end);
                                                    $duration = $start->diff($end);
                                                @endphp
                                                <td class="align-middle">{{ $duration ?? 'N/A' }}</td>
                                                <td class="align-middle">{{ $appointment->teamMember->name ?? 'N/A' }}</td>
                                                <td class="align-middle">{{ $appointment->grand_total ?? 'N/A' }}</td>
                                                <td class="status"><span
                                                        class="badge bg-success-subtle text-success text-uppercase">{{ $appointment->status ?? 'N/A' }}</span>
                                                </td>

                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <div class="edit">
                                                            <a href="#" class="btn btn-sm btn-success edit-item-btn"
                                                                data-appointment-details="{{ $appointment }}">Edit</a>
                                                        </div>
                                                        <button type="button"
                                                            class="btn btn-sm btn-danger remove-item-btn delSubBtn"
                                                            data-id="{{ $appointment->id }}">
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

    <!-- Add New Event MODAL -->
    <div class="modal fade" id="event-details-modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header p-3 bg-info-subtle">
                    <h5 class="modal-title" id="modal-title">Edit Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="event-details">
                        <form>
                            <input type="hidden" name="eventId" id="eventId">
                            <div class="row event-form">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Type</label>
                                        <select class="form-select" name="category" id="update-event-category" required>
                                            <option value="bg-danger-subtle">Danger</option>
                                            <option value="bg-success-subtle">Success</option>
                                            <option value="bg-primary-subtle">Primary</option>
                                            <option value="bg-info-subtle">Info</option>
                                            <option value="bg-dark-subtle">Dark</option>
                                            <option value="bg-warning-subtle">Warning</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a valid
                                            appointment category</div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">appointment Name</label>
                                        <input class="form-control " placeholder="Enter event name" type="text"
                                            name="title" id="update-event-title" required value="" />
                                        <div class="invalid-feedback">Please provide a valid
                                            appointment name</div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label>appointment Date</label>
                                        <div class="input-group">
                                            {{-- <input type="text" id="event-start-date" --}}
                                            <input type="text" id="update-event-start-date"
                                                class="form-control flatpickr flatpickr-input" placeholder="Select date"
                                                readonly required>
                                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-12" id="event-time">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label class="form-label">Start Time</label>
                                                <div class="input-group">
                                                    <input id="update-timepicker1" type="text"
                                                        class="form-control flatpickr flatpickr-input"
                                                        placeholder="Select start time" readonly>
                                                    <span class="input-group-text"><i class="ri-time-line"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label class="form-label">End Time</label>
                                                <div class="input-group ">
                                                    <input id="update-timepicker2" type="text"
                                                        class="form-control flatpickr flatpickr-input"
                                                        placeholder="Select end time" readonly>
                                                    <span class="input-group-text"><i class="ri-time-line"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Select Team Member</label>
                                        <select class="form-select" name="member" id="update-event-member" required>
                                            @foreach ($team_members as $team_member)
                                                <option disabled>Select Member</option>
                                                <option value="{{ $team_member->id }}">
                                                    {{ $team_member->name }} </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select a member</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Select Client</label>
                                        <select class="form-select" name="client" id="update-event-client" required>
                                            @foreach ($clients as $client)
                                                <option disabled>Select Client</option>
                                                <option value="{{ $client->id }}">{{ $client->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select a client</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Select Services</label> <br>

                                        <select multiple name="services[]" id="update-example-select"
                                            placeholder="Select Services" data-search="false"
                                            data-silent-initial-value-set="true">

                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}">
                                                    {{ $service->service_name }}</option>
                                            @endforeach

                                        </select>
                                        <div class="invalid-feedback">Please select a client</div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select class="form-select" name="update-event-status" id="update-event-status"
                                            required>
                                            <option value="Booked">Booked</option>
                                            <option value="Arrived">Arrived</option>
                                            <option value="Confirmed">Confirmed</option>
                                            <option value="Started">Started</option>
                                            <option value="Completed">Completed</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="event-location">Location</label>
                                        <div>
                                            <input type="text" class="form-control" name="event-location"
                                                id="update-event-location" placeholder="Event location">
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control " id="update-event-description" placeholder="Enter a description" rows="3"
                                            spellcheck="false"></textarea>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                            <div class="hstack gap-2 justify-content-end w-100" id="update-event-btn-div">

                                <button type="submit" class="btn btn-success" id="update-btn-save-event">Update
                                    appointment </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end modal-content-->
        </div> <!-- end modal dialog-->
    </div>



@endsection
@section('scripts')
    <script src="{{ asset('assets_old/js/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets_old/js/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('virtual-select-master/dist/virtual-select.min.js') }}"></script>
    <script src="{{ asset('dash-assets/js/flatpickr.min.js') }}"></script>
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
                        url: `/appointments/${dataId}`,
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
                                    icon: "success",
                                    showConfirmButton: false,
                                    timer: 1500
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

        $(document).ready(function() {
            VirtualSelect.init({
                ele: '#update-example-select',
                search: true,
                multiple: true,
                silentInitialValueSet: true
            });
        });



        $(document).on('click', '.edit-item-btn', function(e) {
            e.preventDefault();
            var details = $(this).data('appointment-details');
            console.log(details);
            $('#eventId').val(details.id);
            $('#update-event-category').val(details.color);
            $('#update-event-title').val(details.title);
            $('#update-event-start-date').val(details.start);
            $('#update-event-member').val(details.team_member_id);
            $('#update-event-client').val(details.client_id);
            $('#update-event-status').val(details.status);
            $('#update-event-location').val(details.location);
            $('#update-event-description').val(details.description);

            let startTime = details.start.slice(11, 16);
            let endTime = details.end.slice(11, 16);
            $('#update-timepicker1').val(startTime);
            $('#update-timepicker2').val(endTime);
            flatpickr("#update-event-start-date", {
                enableTime: false,
                dateFormat: "Y-m-d"
            });
            // flatpickr("#update-timepicker1").destroy();
            flatpickr("#update-timepicker1", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                defaultDate: startTime
            });

            // flatpickr("#update-timepicker2").destroy();
            flatpickr("#update-timepicker2", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                idefaultDate: endTime
            });

            const selectedServiceIds = details.services.map(service => service.service_id);
            console.log(selectedServiceIds);
            const selectBox = document.querySelector('#update-example-select');
            VirtualSelect.init({
                ele: selectBox,
                search: true,
                multiple: true,
                silentInitialValueSet: true
            });
            selectBox.setValue(selectedServiceIds);

            $('#event-details-modal').modal('show');
        });

        $('#update-btn-save-event').click(function() {
            event.preventDefault();
            var title = $('#update-event-title').val();
            var start = $('#update-event-start-date').val() + 'T' + $('#update-timepicker1').val();
            var end = $('#update-event-start-date').val() + 'T' + $('#update-timepicker2').val();
            var description = $('#update-event-description').val();
            var location = $('#update-event-location').val();
            var category = $('#update-event-category').val();
            var services = $('#update-example-select').val();
            var team_member = $('#update-event-member').val();
            var client = $('#update-event-client').val();
            var eventId = $('#eventId').val();
            var status = $('#update-event-status').val();

            if (title == '' || start == '' || end == '' || description == '' || location == '' || category == '' ||
                services == '' || team_member == '' || client == '' || status == '') {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    html: "All fields are required"
                });
                return;
            } else {
                var data = {
                    title: title,
                    start: start,
                    end: end,
                    description: description,
                    location: location,
                    color: category,
                    services: services,
                    team_member_id: team_member,
                    client_id: client,
                    status: status
                };

                $.ajax({
                    url: `/appointments/${eventId}`,
                    type: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function(response) {
                        console.log(response);
                        if (response.status) {
                            Swal.fire({
                                title: "Success!",
                                text: response.message,
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            // Refresh Data Table
                            $("#example").load(window.location + " #example");
                            $('#event-details-modal').modal('hide');
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

            }



        })
    </script>
@endsection
