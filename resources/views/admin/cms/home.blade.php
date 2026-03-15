@extends('admin.layout.app')

@section('title', 'Services')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <!-- start page title -->

            <!-- end page title -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0"> Home</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">CMS</a></li>
                                    <li class="breadcrumb-item active">Home</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                @include('admin.layout.errors')
                <div class="row">
                    <div class="col-lg-10 mx-auto col-container">
                        {{-- <div class="text-end">
                            <a href="{{route('services.create')}}" class="default-btn py-2 px-3 mb-3">Add Services</a>
                            <a href="#" class="default-btn py-2 px-3 mb-3"  data-bs-target="#exampleModalToggle"
                            data-bs-toggle="modal">Add Category</a>
                        </div> --}}
                        {{-- <div class="card">
                            <div class="card-header">
                                <h5>Hair & styling</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-nowrap">

                                    <tbody>
                                        <tr>
                                            <th scope="row">Hair Color</th>
                                            <td>1h 15min</td>
                                            <td>$21</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="edit">
                                                        <button class="btn btn-sm btn-success edit-item-btn"
                                                            data-bs-toggle="modal" data-bs-target="#showModal">Edit</button>
                                                    </div>
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-danger remove-item-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteRecordModal">Remove</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Blow Dry</th>
                                            <td>1h 15min</td>
                                            <td>$21</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="edit">
                                                        <button class="btn btn-sm btn-success edit-item-btn"
                                                            data-bs-toggle="modal" data-bs-target="#showModal">Edit</button>
                                                    </div>
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-danger remove-item-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteRecordModal">Remove</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Hair Color</th>
                                            <td>1h 15min</td>
                                            <td>$21</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="edit">
                                                        <button class="btn btn-sm btn-success edit-item-btn"
                                                            data-bs-toggle="modal" data-bs-target="#showModal">Edit</button>
                                                    </div>
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-danger remove-item-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteRecordModal">Remove</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Hair Cutting</th>
                                            <td>1h 15min</td>
                                            <td>$21</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="edit">
                                                        <button class="btn btn-sm btn-success edit-item-btn"
                                                            data-bs-toggle="modal" data-bs-target="#showModal">Edit</button>
                                                    </div>
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-danger remove-item-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteRecordModal">Remove</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div> --}}
                        <div class="card pb-5">
                            <div class="card-body">
                                <form action="{{route('landing-page.update',auth()->id())}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group mb-3">
                                        <label for="">Home Title</label>
                                        <input type="text" class="form-control" name="home_title" value="{{$home->home_title ?? ''}}">
                                    </div>
                                    <span class="fw-bold text-secondary mb-3">Section 1</span>
                                    <div class="form-group mb-3 mt-3">
                                        <label for=""> Title</label>
                                        <input type="text" class="form-control" name="section1_title" value="{{$home->section1_title ?? ''}}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for=""> Image</label>
                                        <input type="file" class="form-control" name="section1_image">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for=""> Description</label>
                                        <textarea name="section1_desc" id="" cols="30" rows="5" class="form-control">{{$home->section1_desc ?? ''}}</textarea>
                                    </div>
                                    <span class="fw-bold text-secondary mb-3">Section 2</span>
                                    <div class="form-group mb-3 mt-3">
                                        <label for=""> Title</label>
                                        <input type="text" class="form-control" name="section2_title" value="{{$home->section2_title ?? ''}}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for=""> Video Link</label>
                                        <input type="text" class="form-control" name="section2_video_link" value="{{$home->section2_video_link ?? ''}}">
                                    </div>
                                    <span class="fw-bold text-secondary mb-3">Kimih for Business</span>
                                    <div class="form-group mb-3 mt-3">
                                        <label for=""> Title</label>
                                        <input type="text" class="form-control" name="last_section_title" value="{{$home->last_section_title ?? ''}}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for=""> Image</label>
                                        <input type="file" class="form-control" name="last_section_image" >
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for=""> Description</label>
                                        <textarea name="last_section_desc" id="" cols="30" rows="5" class="form-control">{{$home->last_section_desc ?? ''}}</textarea>
                                    </div>
                                    <button type="submit" class="btn default-btn">Save</button>

                                </form>



                            </div>
                        </div>


                    </div>
                </div>

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>





    <!-- Create Modal STart -->
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h3 class=" pb-2 mb-0" style="width: 57%;">
                        Edit Category
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('services.category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Category Name</label>
                            <input type="text" class="form-control subheading" name="name"
                                id="exampleFormControlInput1" placeholder="Name" required>
                        </div>
                        <div class="form-group mt-2">
                            <label for="exampleFormControlInput1">Category Icon</label>
                            <input type="file" class="form-control subheading" name="icon"
                                id="exampleFormControlInput1" placeholder="icon" {{auth()->user()->hasRole('Admin') ? "required":""}}>
                            <span class="text-danger">File should be in .svg format</span>
                        </div>

                        <div class="form-group mt-2">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control subheading" id="exampleFormControlTextarea1" name="description" rows="3" required></textarea>
                        </div>

                        <button class="btn btn btn-success add-btn mt-4">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->



@endsection
@section('scripts')
    <script src="{{ asset('back/assets/js/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('back/assets/js/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

    <script>
        $(document).ready(function() {

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
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    },
                    {
                        extend: 'csv',
                        footer: false,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }

                    },
                    {
                        extend: 'excel',
                        footer: false,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    }
                ]
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
                            url: "",
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



            $('#custom-filter').keyup(function() {
                table.search(this.value).draw();
            });

            $('#download-pdf').on('click', function() {
                table.button('.buttons-pdf').trigger();
            });
            $('#download-excel').on('click', function() {
                table.button('.buttons-excel').trigger();
            });

            // // Custom pagination events
            $('.new-pagination .paginate_button').on('click', function() {
                if ($(this).hasClass('rounded-start')) {
                    table.page('previous').draw('page');
                } else if ($(this).hasClass('rounded-end')) {
                    table.page('next').draw('page');
                }
            });

            // Handle rows per page change
            $('#rowsPerPage').on('change', function() {
                var rowsPerPage = $(this).val();
                table.page.len(rowsPerPage).draw();
            });

            // Update rows per page select on table draw
            table.on('draw', function() {

                var pageInfo = table.page.info();
                var currentPage = pageInfo.page + 1; // Adding 1 to match human-readable page numbering
                var totalPages = pageInfo.pages;
                var totalRecords = pageInfo.recordsTotal;

                // Calculate start and end records for the current page
                var startRecord = pageInfo.start + 1;
                var endRecord = startRecord + pageInfo.length - 1;
                if (endRecord > totalRecords) {
                    endRecord = totalRecords;
                }

                $('#rowsPerPage').val(table.page.len());
                $('#dataTableInfo').text('Showing ' + startRecord + '-' + endRecord + ' of ' +
                    totalRecords + ' entries');
            });

            table.draw();

        });

        $(document).ready(function() {
            $(document).on('click', '.delete-user-link', function(e) {
                e.preventDefault();
                $(this).find('.delete-user-form').submit();
            });
            $(".delete-user-form").submit(function() {
                var decision = confirm("Are you sure, You want to Delete this user?");
                if (decision) {
                    return true;
                }
                return false;
            });
            // $('.toggle-class-status').change(function() {
            //     var user_id = $(this).data('user-id');
            //     var status = $(this).prop('checked') ? 1 : 0;

            //     $.ajax({
            //         type: 'POST',
            //         dataType: 'JSON',
            //         url: '',
            //         data: {
            //             user_id: user_id,
            //             status: status,
            //             _token: '{{ csrf_token() }}'
            //         },
            //         success: function(response) {
            //             toastr.success(response)
            //         },
            //         error: function(err) {
            //             console.log(err);
            //         }
            //     });
            // });
            // $('.toggle-class-blacklist').change(function() {
            //     var user_id = $(this).data('user-id');
            //     var status = $(this).prop('checked') ? 1 : 0;

            //     $.ajax({
            //         type: 'POST',
            //         dataType: 'JSON',
            //         url: '',
            //         data: {
            //             user_id: user_id,
            //             status: status,
            //             _token: '{{ csrf_token() }}'
            //         },
            //         success: function(response) {
            //             toastr.success(response)
            //         },
            //         error: function(err) {
            //             console.log(err);
            //         }
            //     });
            // });

        });
    </script>
@endsection
