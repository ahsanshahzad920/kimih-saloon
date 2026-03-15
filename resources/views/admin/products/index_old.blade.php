@extends('admin.layout.app')
@section('style')
    <link href="{{ asset('assets/js/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
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
@endsection
@section('title', 'Client')
@section('content')

    <div class="content">

        <div class="container-fluid pt-4 px-4 mb-5">
            <div class="border-bottom">
                <h3 class="all-adjustment text-center pb-2 mb-0 w-25">
                    Products
                </h3>
            </div>

            @include('admin.layout.errors')


            <div class="card card-shadow border-0 mt-3 rounded-3 p-2">
                <div class="card-header bg-white border-0 rounded-3">
                    <div class="row my-3">
                        <div class="col-md-4 col-12">
                            <div class="input-search position-relative">
                                <input type="text" placeholder="Search Customer"
                                    class="form-control rounded-3 subheading" id="custom-filter" />
                                <span class="fa fa-search search-icon text-secondary"></span>
                            </div>
                        </div>

                        <div class="col-md-8 col-12 text-end">

                            <a href="{{route('brands.index')}}" class="btn create-btn rounded-3 mt-2" >Add Brand <i class="bi bi-plus-lg"></i>
                            </a>
                            <a href="{{ route('categories.index') }}" class="btn create-btn rounded-3 mt-2" >Add Category <i
                                    class="bi bi-plus-lg"></i>
                            </a>
                            <a href="{{ route('suppliers.index') }}" class="btn create-btn rounded-3 mt-2" >Add Supplier <i
                                    class="bi bi-plus-lg"></i>
                            </a>
                            <a href="{{route('products.create')}}" class="btn create-btn rounded-3 mt-2" >Add Product <i class="bi bi-plus-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>



                <div class="table-responsive">
                    <div class="alert alert-danger p-2 text-end" id="deletedAlert" style="display: none">
                        <div style="display: flex;justify-content:space-between">
                            <span><span id="deleteRowCount">0</span> rows selected</span>
                            <button class="btn btn-sm btn-danger" id="deleteRowTrigger">Delete</button>
                        </div>
                    </div>
                    <table class="table " id="example">
                        <thead class="fw-bold">
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
                                <th class="text-secondary">Image</th>
                                <th class="text-secondary">Name</th>
                                <th class="text-secondary">Barcode</th>
                                <th class="text-secondary">Category</th>
                                <th class="text-secondary">Supplier</th>
                                <th class="text-secondary">Quantity</th>
                                <th class="text-secondary">Retail Price</th>
                                <th class="text-secondary">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td class="align-middle">
                                        <label for="select-checkbox" class="checkbox">
                                            <input class="checkbox__input select-checkbox deleteRow" type="checkbox"
                                                id="select-checkbox" data-id="{{ $product->id }}" />
                                            <svg class="checkbox__icon" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 22 22">
                                                <rect width="21" height="21" x=".5" y=".5" fill="#FFF"
                                                    stroke="rgba(76, 73, 227, 1)" rx="3" />
                                                <path class="tick" stroke="rgba(76, 73, 227, 1)" fill="none"
                                                    stroke-linecap="round" stroke-width="3" d="M4 10l5 5 9-9" />
                                            </svg>
                                        </label>
                                    </td>
                                    <td class="align-middle">
                                        @if (count($product->images) > 0)
                                            <img src="{{ asset('/storage' . $product->images[0]['img_path']) }}"
                                                alt="No" style="width: 70px">
                                            <span
                                                class="badge bg-primary rounded-pill">+{{ count($product->images) - 1 }}</span>
                                        @else
                                            <img src="{{ asset('assets/image/no-image.png') }}" alt=""
                                                class="" style=" width: 70px" />
                                        @endif

                                    </td>
                                    <td class="align-middle">
                                        {{ $product->name }}
                                    </td>
                                    <td class="align-middle">{{ $product->barcodes[0]['code'] ?? '' }}</td>
                                    <td class="align-middle">{{ $product->category->name ?? 'N/A'}}</td>
                                    <td class="align-middle">{{ $product->supplier->name ?? 'N/A'}}</td>
                                    <td class="align-middle">{{ $product->current_stock_quantity ?? '' }}</td>
                                    <td class="align-middle">{{ $product->retail_price ?? 'N/A' }}</td>

                                    <td class="align-middle">
                                        <div class="dropdown">
                                            <a class="btn btn-secondary bg-transparent border-0 text-dark" role="button"
                                                id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu " aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item"
                                                    href="">
                                                    <img src="{{ asset('assets/dasheets/img/menu.svg') }}"
                                                        class="img-fluid me-1" alt="" />
                                                    Product Detail
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{route('products.edit',$product->id)}}">
                                                    <img src="{{ asset('assets/dasheets/img/menu.svg') }}"
                                                        class="img-fluid me-1" alt="" />
                                                    Edit Product
                                                </a>

                                                <form class=""
                                                    action="{{route('products.destroy',$product->id)}}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item confirm-text">
                                                        <img src="{{ asset('assets/dasheets/img/menu.svg') }}"
                                                            class="img-fluid me-1" alt="">
                                                        Delete Product
                                                    </button>
                                                </form>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
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
                                    <a class="rounded-end paginate_button page-item next" style="cursor: pointer"> ❯
                                    </a>
                                </div>
                            </div>
                        </div>
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
        <div div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h3 class="all-adjustment text-center pb-2 mb-0" style="width: 57%;">
                        Create Category
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('services.category.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Category Name</label>
                            <input type="text" class="form-control subheading" name="name"
                                id="exampleFormControlInput1" placeholder="Name" required>
                        </div>

                        <div class="form-group mt-2">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control subheading" id="exampleFormControlTextarea1" name="description" rows="3"
                                required></textarea>
                        </div>

                        <button class="btn btn btn-success add-btn mt-4">Done</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->
    <!-- Create Modal STart -->
    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h3 class="all-adjustment text-center pb-2 mb-0" style="width: 57%;">
                        Create Brand
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('services.category.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Brand Name</label>
                            <input type="text" class="form-control subheading" name="name"
                                id="exampleFormControlInput1" placeholder="Name" required>
                        </div>

                        <div class="form-group mt-2">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control subheading" id="exampleFormControlTextarea1" name="description" rows="3"
                                required></textarea>
                        </div>

                        <button class="btn btn btn-success add-btn mt-4">Done</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->


@endsection
@section('scripts')
    <script src="{{ asset('assets/js/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

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


        });
    </script>
@endsection
