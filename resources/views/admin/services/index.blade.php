@extends('admin.layout.app')
{{-- @section('style')
    <link href="{{ asset('back/assets/js/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <style>
        :root {
            --dt-row-selected: 255, 255, 255;
            --dt-row-selected-text: 0, 0, 0;
        }

        .dataTables_paginate {
            display: none;
        }

        .dataTables_length {
            display: none;
        }

        .dataTables_info {
            display: none;
        }
    </style>
@endsection --}}
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
                            <h4 class="mb-sm-0"> Services menu</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Services menu</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                @include('admin.layout.errors')
                <div class="row">
                    <div class="col-lg-10 mx-auto col-container">
                        <div class="text-end">
                            <a href="{{route('services.create')}}" class="default-btn py-2 px-3 mb-3">Add Services</a>
                            <a href="#" class="default-btn py-2 px-3 mb-3"  data-bs-target="#exampleModalToggle"
                            data-bs-toggle="modal">Add Category</a>
                        </div>
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
                        @if (!auth()->user()->hasRole('Admin'))
                            <div class="card pb-3 mb-4">
                                <div class="card-header bg-transparent border-0">
                                    <h5 class="mb-0">Services Catalog</h5>
                                    <p class="text-muted mb-0 small">Turn on ready-made categories and services, or manage your own — all in one place.</p>
                                </div>
                                <div class="card-body">
                                    <div class="accordion" id="defaultServicesAccordion">
                                        @foreach ($defaultCategories as $defCat)
                                            @php
                                                $myCat = $myCategoryClones->get($defCat->id);
                                                $catEnabled = (bool) ($myCat && $myCat->is_active);
                                            @endphp
                                            <div class="accordion-item mb-2 border rounded-3 overflow-hidden">
                                                <h2 class="accordion-header d-flex align-items-center" id="heading{{ $defCat->id }}">
                                                    <button class="accordion-button collapsed flex-grow-1" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $defCat->id }}">
                                                        <span class="d-flex flex-column flex-sm-row align-items-sm-center w-100">
                                                            <strong>{{ $defCat->name }}</strong>
                                                            <span class="text-muted small ms-sm-2 d-none d-sm-inline">{{ $defCat->description }}</span>
                                                        </span>
                                                    </button>
                                                    <div class="form-check form-switch mx-3 flex-shrink-0" onclick="event.stopPropagation()">
                                                        <input type="checkbox" role="switch"
                                                            class="form-check-input toggleDefaultCategory"
                                                            data-default-category-id="{{ $defCat->id }}"
                                                            {{ $catEnabled ? 'checked' : '' }}>
                                                    </div>
                                                </h2>
                                                <div id="collapse{{ $defCat->id }}" class="accordion-collapse collapse"
                                                    data-bs-parent="#defaultServicesAccordion">
                                                    <div class="accordion-body p-0">
                                                        <ul class="list-group list-group-flush">
                                                            @forelse ($defCat->services as $defSvc)
                                                                @php
                                                                    $mySvc = $myServiceClones->get($defSvc->id);
                                                                    $svcEnabled = (bool) ($mySvc && $mySvc->is_active);
                                                                @endphp
                                                                <li class="list-group-item d-flex align-items-center justify-content-between flex-wrap gap-2">
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <div class="form-check form-switch mb-0">
                                                                            <input type="checkbox" role="switch"
                                                                                class="form-check-input toggleDefaultService"
                                                                                data-default-service-id="{{ $defSvc->id }}"
                                                                                data-default-category-id="{{ $defCat->id }}"
                                                                                {{ $svcEnabled ? 'checked' : '' }}
                                                                                {{ $catEnabled ? '' : 'disabled' }}>
                                                                        </div>
                                                                        <span>{{ $defSvc->service_name }}</span>
                                                                    </div>
                                                                    <div class="d-none d-md-flex gap-3 text-muted small">
                                                                        <span>{{ $defSvc->duration }} min</span>
                                                                        <span>PKR {{ $defSvc->price }}</span>
                                                                    </div>
                                                                </li>
                                                            @empty
                                                                <li class="list-group-item text-muted small">No default services in this category yet.</li>
                                                            @endforelse
                                                        </ul>

                                                        @if ($myCat && $myCat->services && $myCat->services->count())
                                                            <ul class="list-group list-group-flush border-top">
                                                                <li class="list-group-item bg-light-subtle">
                                                                    <strong class="fs-6">Created by You</strong>
                                                                </li>
                                                                @foreach ($myCat->services as $service)
                                                                    <li class="list-group-item d-flex align-items-center justify-content-between flex-wrap gap-2">
                                                                        <div class="d-flex align-items-center gap-2">
                                                                            <div class="form-check form-switch mb-0">
                                                                                <input type="checkbox" role="switch"
                                                                                    class="form-check-input toggleServiceStatus"
                                                                                    data-service-id="{{ $service->id }}"
                                                                                    {{ $service->is_active ? 'checked' : '' }}>
                                                                            </div>
                                                                            <span>{{ $service->service_name }}</span>
                                                                        </div>
                                                                        <div class="d-flex align-items-center gap-3">
                                                                            <div class="d-none d-md-flex gap-3 text-muted small">
                                                                                <span>{{ $service->duration }} min</span>
                                                                                <span>AED {{ $service->price }}</span>
                                                                            </div>
                                                                            <a href="{{ route('services.edit', $service->id) }}" class="text-muted">
                                                                                <i class="fa fa-pencil"></i>
                                                                            </a>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        @forelse ($categories->whereNull('default_category_id') as $customCat)
                                            <div class="accordion-item mb-2 border rounded-3 overflow-hidden">
                                                <h2 class="accordion-header d-flex align-items-center" id="headingCustom{{ $customCat->id }}">
                                                    <button class="accordion-button collapsed flex-grow-1" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseCustom{{ $customCat->id }}">
                                                        <span class="d-flex flex-column flex-sm-row align-items-sm-center w-100">
                                                            <strong>{{ $customCat->name }}</strong>
                                                            <span class="text-muted small ms-sm-2 d-none d-sm-inline">{{ $customCat->description }}</span>
                                                        </span>
                                                    </button>
                                                    <div class="dropdown mx-2" onclick="event.stopPropagation()">
                                                        <a class="btn btn-secondary bg-transparent border-0 text-dark" role="button"
                                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa-solid fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <a href="#" class="dropdown-item" style="cursor: pointer"
                                                                data-bs-target="#exampleModalToggle{{ $customCat->id }}" data-bs-toggle="modal">
                                                                <i class="fa fa-pencil text-warning me-2"></i>
                                                                Edit Category
                                                            </a>
                                                            <a href="javascript:void(0);" class="dropdown-item">
                                                                <form action="{{ route('services.category.destroy', $customCat->id) }}" method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <i class="fa fa-trash text-danger"></i>
                                                                    <button type="submit" class="btn btn-sm">Delete Category</button>
                                                                </form>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="form-check form-switch mx-3 flex-shrink-0" onclick="event.stopPropagation()">
                                                        <input type="checkbox" role="switch"
                                                            class="form-check-input toggleCategoryStatus"
                                                            data-category-id="{{ $customCat->id }}"
                                                            {{ $customCat->is_active ? 'checked' : '' }}>
                                                    </div>
                                                </h2>
                                                <div id="collapseCustom{{ $customCat->id }}" class="accordion-collapse collapse"
                                                    data-bs-parent="#defaultServicesAccordion">
                                                    <div class="accordion-body p-0">
                                                        <ul class="list-group list-group-flush">
                                                            @forelse ($customCat->services as $service)
                                                                <li class="list-group-item d-flex align-items-center justify-content-between flex-wrap gap-2">
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <div class="form-check form-switch mb-0">
                                                                            <input type="checkbox" role="switch"
                                                                                class="form-check-input toggleServiceStatus"
                                                                                data-service-id="{{ $service->id }}"
                                                                                {{ $service->is_active ? 'checked' : '' }}>
                                                                        </div>
                                                                        <span>{{ $service->service_name }}</span>
                                                                    </div>
                                                                    <div class="d-flex align-items-center gap-3">
                                                                        <div class="d-none d-md-flex gap-3 text-muted small">
                                                                            <span>{{ $service->duration }} min</span>
                                                                            <span>AED {{ $service->price }}</span>
                                                                        </div>
                                                                        <a href="{{ route('services.edit', $service->id) }}" class="text-muted">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </a>
                                                                    </div>
                                                                </li>
                                                            @empty
                                                                <li class="list-group-item text-muted small">No services in this category yet.</li>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="card pb-5">
                                <div class="card-body">

                                    @forelse ($categories as $category)
                                        <div class="category d-flex justify-content-between p-2 mt-3">
                                            <div class="d-flex align-items-center">
                                                <a href="#"
                                                    class=" text-decoration-none flex-shrink-0 align-items-center d-inline-flex text-danger">
                                                    <i class="fa fa-bars -seconadary"></i>
                                                </a>
                                                <strong class="ms-2 pb-1 fs-5">{{ $category->name }}</strong>
                                            </div>
                                            <div class="" style="overflow: visible">
                                                <a class="btn btn-secondary bg-transparent border-0 text-dark" role="button"
                                                    id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-v"></i>
                                                </a>

                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a href="#" class=" dropdown-item" style="cursor: pointer" data-bs-target="#exampleModalToggle{{$category->id}}"
                                                    data-bs-toggle="modal">
                                                        <i class="fa fa-pencil text-warning me-2"></i>
                                                        Edit Category
                                                    </a>
                                                    <a href="javascript:void(0);" class="dropdown-item">
                                                        <form action="{{ route('services.category.destroy', $category->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <i class="fa fa-trash text-danger"></i>

                                                            <button type="submit" class="btn btn-sm">
                                                                Delete Category
                                                            </button>
                                                        </form>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($category->services)
                                            @foreach ($category->services as $service)
                                                <a href="{{ route('services.edit', $service->id) }}" class="text-decoration-none text-dark">
                                                    <div class="services d-flex justify-content-between p-2 mb-1"
                                                        style="border: 1px solid black">
                                                        <div class="d-flex align-items-center">
                                                            <span
                                                                class=" text-decoration-none flex-shrink-0 align-items-center d-inline-flex text-secondary">
                                                                <i class="fa fa-bars"></i>
                                                            </span>
                                                            <strong class="ms-2 pb-1 fs-6">{{ $service->service_name }}</strong>
                                                        </div>
                                                        <div>{{ $service->duration }}</div>
                                                        <div>AED {{ $service->price }}</div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        @endif
                                    @empty
                                        <div class="text-center p-5">
                                            <h3>No Services Found</h3>
                                        </div>
                                    @endforelse


                                </div>
                            </div>
                        @endif


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

    @foreach ($categories as $category)
        <!-- Create Modal STart -->
        <div class="modal fade" id="exampleModalToggle{{ $category->id }}" aria-hidden="true"
            aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h3 class=" pb-2 mb-0" style="width: 57%;">
                            Edit Category
                        </h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('services.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Category Name</label>
                                <input type="text" class="form-control subheading" name="name"
                                    id="exampleFormControlInput1" placeholder="Name" required
                                    value="{{ $category->name }}">
                            </div>
                            <div class="form-group mt-2">
                                <label for="exampleFormControlInput1">Category Icon</label>

                                <input type="file" class="form-control subheading" name="icon"
                                    id="exampleFormControlInput1" placeholder="icon">
                                <span class="text-danger">Icon should be in .svg format</span>
                            </div>

                            <div class="form-group mt-2">
                                <label for="exampleFormControlTextarea1">Description</label>
                                <textarea class="form-control subheading" id="exampleFormControlTextarea1" name="description" rows="3"
                                    required>{{ $category->description }}</textarea>
                            </div>

                            <button class="btn btn btn-success add-btn mt-4">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal End -->
    @endforeach


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

    <script>
        $(document).ready(function() {

            // Default category toggle
            $('.toggleDefaultCategory').on('change', function() {
                var $this = $(this);
                var categoryId = $this.data('default-category-id');
                var enabled = $this.prop('checked');
                var $childSwitches = $('.toggleDefaultService[data-default-category-id="' + categoryId + '"]');

                if (enabled) {
                    $childSwitches.prop('disabled', false);
                } else {
                    $childSwitches.prop('disabled', true).prop('checked', false);
                }

                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    url: '{{ route('services.default-category.toggle') }}',
                    data: {
                        default_category_id: categoryId,
                        enabled: enabled ? 1 : 0,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1200
                        });
                    },
                    error: function(err) {
                        $this.prop('checked', !enabled);
                        if (!enabled) {
                            $childSwitches.prop('disabled', false);
                        } else {
                            $childSwitches.prop('disabled', true).prop('checked', false);
                        }
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong',
                            icon: 'error'
                        });
                    }
                });
            });

            // Default service toggle
            $('.toggleDefaultService').on('change', function() {
                var $this = $(this);
                var serviceId = $this.data('default-service-id');
                var enabled = $this.prop('checked');

                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    url: '{{ route('services.default-service.toggle') }}',
                    data: {
                        default_service_id: serviceId,
                        enabled: enabled ? 1 : 0,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1200
                        });
                    },
                    error: function(err) {
                        $this.prop('checked', !enabled);
                        var msg = (err.responseJSON && err.responseJSON.message) ? err.responseJSON.message : 'Something went wrong';
                        Swal.fire({
                            title: 'Error!',
                            text: msg,
                            icon: 'error'
                        });
                    }
                });
            });

            // Plain category status toggle (custom categories + already-enabled default clones)
            $('.toggleCategoryStatus').on('change', function() {
                var $this = $(this);
                var categoryId = $this.data('category-id');
                var enabled = $this.prop('checked');
                var $accordionItem = $this.closest('.accordion-item');
                var $childSwitches = $accordionItem.find('.toggleServiceStatus');

                if (!enabled) {
                    $childSwitches.prop('checked', false);
                }

                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    url: '{{ url('catalogues/services/category') }}/' + categoryId + '/toggle-status',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1200
                        });
                    },
                    error: function(err) {
                        $this.prop('checked', !enabled);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong',
                            icon: 'error'
                        });
                    }
                });
            });

            // Plain service status toggle (custom services + already-enabled default clones)
            $('.toggleServiceStatus').on('change', function() {
                var $this = $(this);
                var serviceId = $this.data('service-id');
                var enabled = $this.prop('checked');

                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    url: '{{ url('catalogues/services') }}/' + serviceId + '/toggle-status',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1200
                        });
                    },
                    error: function(err) {
                        $this.prop('checked', !enabled);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong',
                            icon: 'error'
                        });
                    }
                });
            });

        });
    </script>
@endsection
