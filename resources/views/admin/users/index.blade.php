@extends('admin.layout.app')
@section('title', 'Users')
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

    {{-- <div class="content">

        <div class="container-fluid pt-4 px-4 mb-5">
            <div class="border-bottom">
                <h3 class="all-adjustment text-center pb-2 mb-0">All Users</h3>
            </div>

            @include('admin.layout.errors')

            <div class="card card-shadow border-0 mt-5 rounded-3">
                <div class="card-header bg-white border-0 rounded-3">
                    <div class="row my-3">
                        <div class="col-md-4 col-12">
                            <div class="input-search position-relative">
                                <input type="text" placeholder="Search User" class="form-control rounded-3 subheading"
                                    id="custom-filter" />
                                <span class="fa fa-search search-icon text-secondary"></span>
                            </div>
                        </div>

                        <div class="col-md-8 col-12 text-end">
                            <a href="#" class="btn create-btn rounded-3 mt-2" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop"
                                aria-controls="staticBackdrop">Filter <i class="bi bi-funnel"></i></a>
                            <a href="#" class="btn border-danger text-danger rounded-3 mt-2 excel-btn"
                                id="download-excel">Excel <i class="bi bi-file-earmark-text"></i></a>
                            <a href="#" class="btn pdf rounded-3 mt-2" id="download-pdf">Pdf <i
                                    class="bi bi-file-earmark"></i></a>
                            <a href="#" class="btn import-customer-btn rounded-3 mt-2">Import Users <i
                                    class="bi bi-download"></i></a>
                            <button class="btn create-btn rounded-3 mt-2" data-bs-target="#exampleModalToggle"
                                data-bs-toggle="modal">
                                Create <i class="bi bi-plus-lg"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive p-2">
                    <div class="alert alert-danger p-2 text-end" id="deletedAlert" style="display: none">
                        <div style="display: flex;justify-content:space-between">
                            <span><span id="deleteRowCount">0</span> rows selected</span>
                            <button class="btn btn-sm btn-danger" id="deleteRowTrigger">Delete</button>
                        </div>
                    </div>
                    <table id="example" class="table mb-0">
                        <thead>
                            <tr>
                                <th>
                                    <label for="myCheckbox09" class="checkbox">
                                        <input class="checkbox__input" type="checkbox" id="myCheckbox09" />
                                        <svg class="checkbox__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22">
                                            <rect width="21" height="21" x=".5" y=".5" fill="#FFF"
                                                stroke="rgba(76, 73, 227, 1)" rx="3" />
                                            <path class="tick" stroke="rgba(76, 73, 227, 1)" fill="none"
                                                stroke-linecap="round" stroke-width="3" d="M4 10l5 5 9-9" />
                                        </svg>
                                    </label>
                                </th>
                                <th class="sorting">Name</th>
                                <th class="sorting">Email </th>
                                <th class="sorting">Roles</th>
                                <th class="sorting">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $user)
                                @if ($user->hasRole(['Admin', 'Manager']))
                                    <tr>
                                        <td class="pt-3">
                                            <label for="select-checkbox" class="checkbox">
                                                <input class="checkbox__input select-checkbox deleteRow" type="checkbox"
                                                    id="select-checkbox" data-id="{{ $user->id }}" />
                                                <svg class="checkbox__icon" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 22 22">
                                                    <rect width="21" height="21" x=".5" y=".5" fill="#FFF"
                                                        stroke="rgba(76, 73, 227, 1)" rx="3" />
                                                    <path class="tick" stroke="rgba(76, 73, 227, 1)" fill="none"
                                                        stroke-linecap="round" stroke-width="3" d="M4 10l5 5 9-9" />
                                                </svg>
                                            </label>
                                        </td>
                                        <td class="productimgname">
                                            {{ $user->name }}
                                        </td>
                                        <td> {{ $user->email }}</td>
                                        <td>
                                            @if (!empty($user->getRoleNames()))
                                                @foreach ($user->getRoleNames() as $v)
                                                    <span>{{ $v }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-start">

                                                <a class=" text-decoration-none btn edit-category-btn"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editUserModel{{ $user->id }}">
                                                    <img src="{{ asset('assets/dasheets/img/edit-2.svg') }}"
                                                        class="p-0 me-2 ms-0" alt="" />
                                                </a>

                                                <form class="d-inline delete-category-form" method="post"
                                                    action="{{ route('users.destroy', $user->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn text-danger btn-outline-light">
                                                        <img src="{{ asset('assets/dasheets/img/plus-circle.svg') }}"
                                                            class="p-0" data-bs-target="#exampleModalToggle2"
                                                            data-bs-toggle="modal" alt="" />
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer bg-white border-0 rounded-3">
                    <div class="d-flex justify-content-between p-0">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <label for="rowsPerPage" class="col-form-label">Rows per page:</label>
                            </div>
                            <div class="col-auto">
                                <select id="rowsPerPage" class="form-select border-0">
                                    <option value="3" selected>3</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                </select>
                            </div>
                        </div>
                        <div class="row align-items-center text-end">
                            <div class="col-auto">
                                <p class="subheading col-form-label " id="dataTableInfo">

                                </p>
                            </div>
                            <div class="col-auto">
                                <div class="new-pagination">
                                    <a class="rounded-start paginate_button" style="cursor: pointer"> ❮ </a>
                                    <a class="rounded-end paginate_button page-item next" style="cursor: pointer"> ❯ </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Create Modal STart -->
        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
            tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h3 class="all-adjustment text-center pb-2 mb-0" style="width: 57%;">
                            Create Users
                        </h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name:</label>
                                <input type="text" name="name" placeholder="Name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email:</label>
                                <input type="text" name="email" placeholder="Email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password:</label>
                                <input type="password" name="password" placeholder="Password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm Password:</label>
                                <input type="password" name="confirm-password" placeholder="Confirm Password"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Role:</label>
                                <select name="roles" class="form-control">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}">{{ $role }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-primary text-white" type="submit">Done</button>
                        </form>





                    </div>
                </div>
            </div>
        </div>
        <!-- Modal End -->

        <!-- Edit Modal STart -->
        @foreach ($data as $user)
            <div class="modal fade" id="editUserModel{{ $user->id }}" aria-hidden="true"
                aria-labelledby="editCategoryModelToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h3 class="all-adjustment text-center pb-2 mb-0" style="width: 57%;">
                                Edit User
                            </h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="{{ route('users.update', $user->id) }}" method="POST">
                                @method('PATCH')
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Name:</label>
                                    <input type="text" name="name" placeholder="Name" class="form-control"
                                        value="{{ $user->name }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email:</label>
                                    <input type="text" name="email" placeholder="Email" class="form-control"
                                        value="{{ $user->email }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password:</label>
                                    <input type="password" name="password" placeholder="Password" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Confirm Password:</label>
                                    <input type="password" name="confirm-password" placeholder="Confirm Password"
                                        class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Role:</label>
                                    <select name="roles" class="form-control">
                                        @php
                                            $userRole = $user->roles->pluck('name', 'name')->all();
                                        @endphp
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}"
                                                @if ($userRole === $role) selected @endif>{{ $role }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary text-white mt-2">Submit</button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        @endforeach


        <div class="offcanvas offcanvas-end" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel"
            style="width: 20rem">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="staticBackdropLabel">Filter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <form action="{{ route('users.filter') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div>
                        <div class="form-group">
                            <label for="name">Username</label>
                            <input type="text" class="form-control mt-2" name="name" id="name"
                                placeholder="Customer Name">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control mt-2" name="phone" id="phone"
                                placeholder="Customer phone">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control mt-2" name="email" id="email"
                                placeholder="Customer Email">
                        </div>

                        <button class="btn btn-primary text-white mt-3" type="submit">Filter <i
                                class="bi bi-funnel"></i></button>

                    </div>
                </form>
            </div>
        </div>

    </div> --}}

    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">All Users</h4>
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
                                        <button type="button" class="btn btn-success add-btn"
                                            data-bs-target="#exampleModalToggle" data-bs-toggle="modal"> Add</button>
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
                                            <th class="sort">Name</th>
                                            <th class="sort">Email</th>
                                            <th class="sort">Contact</th>
                                            <th class="sort">Role</th>
                                            <th class="sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach ($data as $user)
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="chk_child">
                                                    </div>
                                                </th>
                                                {{-- <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#VZ2101</a></td> --}}

                                                {{-- <td class="status"><span
                                                        class="badge bg-success-subtle text-success text-uppercase">Completed</span>
                                                </td> --}}
                                                <td>{{ $user->name ?? '' }}</td>
                                                <td>{{ $user->email ?? '' }}</td>
                                                <td>{{ $user->phone ?? '' }}</td>
                                                <td>
                                                    @if (!empty($user->getRoleNames()))
                                                        @foreach ($user->getRoleNames() as $v)
                                                            <span>{{ $v }}</span>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <div class="edit">
                                                            <button class="btn btn-sm btn-success edit-item-btn"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editUserModel{{ $user->id }}">Edit</button>
                                                        </div>
                                                        {{-- <div class="remove">
                                                            <button class="btn btn-sm btn-danger remove-item-btn"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#deleteRecordModal">Remove</button>
                                                        </div> --}}
                                                        {{-- <form class="d-inline " id="destroyForm"> --}}
                                                        <button type="button"
                                                            class="btn btn-sm btn-danger remove-item-btn delSubBtn"
                                                            data-id="{{ $user->id }}">
                                                            Remove
                                                        </button>
                                                        {{-- </form> --}}
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


    <!-- Create Modal STart -->
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h3 class=" pb-2 mb-0" style="width: 57%;">
                        Create Users
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Name:</label>
                            <input type="text" name="name" placeholder="Name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email:</label>
                            <input type="text" name="email" placeholder="Email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password:</label>
                            <input type="password" name="password" placeholder="Password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm Password:</label>
                            <input type="password" name="confirm-password" placeholder="Confirm Password"
                                class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role:</label>
                            <select name="roles" class="form-control">
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}">{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn btn-success add-btn" type="submit">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->

    <!-- Edit Modal STart -->
    @foreach ($data as $user)
        <div class="modal fade" id="editUserModel{{ $user->id }}" aria-hidden="true"
            aria-labelledby="editCategoryModelToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h3 class=" pb-2 mb-0" style="width: 57%;">
                            Edit User
                        </h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name:</label>
                                <input type="text" name="name" placeholder="Name" class="form-control"
                                    value="{{ $user->name }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email:</label>
                                <input type="text" name="email" placeholder="Email" class="form-control"
                                    value="{{ $user->email }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password:</label>
                                <input type="password" name="password" placeholder="Password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm Password:</label>
                                <input type="password" name="confirm-password" placeholder="Confirm Password"
                                    class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Role:</label>
                                <select name="roles" class="form-control">
                                    @php
                                        $userRole = $user->roles->pluck('name', 'name')->all();
                                        // return $userRole;
                                    @endphp
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}"
                                            @if ($userRole === $role) selected @endif>{{ $role }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="btn btn btn-success add-btn mt-2">Update</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
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
                        url: `users/${dataId}`,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            console.log(response)
                            if (response.status) {
                                Swal.fire({
                                    title: "Info",
                                    text: response.message,
                                    icon: "info"
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
@endsection
