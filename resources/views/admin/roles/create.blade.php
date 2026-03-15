@extends('admin.layout.app')

@section('title', 'Create Role')
@section('content')

    {{-- <div class="content">

        <div class="container-fluid pt-4 px-4 mb-5">
            <div class="border-bottom">
                <h3 class="all-adjustment text-center pb-2 mb-0 w-25">
                    Create Roles
                </h3>
            </div>

            @include('admin.layout.errors')

            <div class="card card-shadow border-0 mt-3 rounded-3 p-2">
                <div class="card-header bg-white border-0 rounded-3">
                    <div class="row my-4">

                        <form action="{{ route('roles.store') }}" method="POST" class="row g-3">
                            @csrf
                            <div class=" col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Name:</label>

                                    <input type="text" name="name" placeholder="Name" class="form-control">
                                </div>
                            </div>
                            <div class=" col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Permission:</label>
                                    <br />
                                    @foreach ($permission as $value)
                                        <label for="myCheckbox09" class="checkbox">
                                            <input class="checkbox__input" name="permission[]" value="{{ $value->id }}"
                                                type="checkbox" id="myCheckbox09" />
                                            <svg class="checkbox__icon" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 22 22">
                                                <rect width="21" height="21" x=".5" y=".5" fill="#FFF"
                                                    stroke="rgba(76, 73, 227, 1)" rx="3" />
                                                <path class="tick" stroke="rgba(76, 73, 227, 1)" fill="none"
                                                    stroke-linecap="round" stroke-width="3" d="M4 10l5 5 9-9" />
                                            </svg>
                                        </label>
                                        {{ $value->name }}
                                        <br />
                                    @endforeach
                                </div>
                            </div>
                            <div class=" mt-3 col-md-12">
                                <button type="submit" class="btn btn btn-success add-btn me-2">Submit</button>
                            </div>

                        </form>


                    </div>
                </div>

            </div>
        </div>
    </div> --}}

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">All Roles</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="listjs-table" id="customerList">
                            <div class="row g-4 mb-3">
                                <form action="{{ route('roles.store') }}" method="POST" class="row g-3">
                                    @csrf
                                    <div class=" col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="form-label">Name:</label>

                                            <input type="text" name="name" placeholder="Name" class="form-control">
                                        </div>
                                    </div>
                                    <div class=" col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="form-label">Permission:</label>
                                            <br />
                                            @foreach ($permission as $value)
                                                {{-- <label for="myCheckbox09" class="checkbox">
                                                    <input class="checkbox__input" name="permission[]" value="{{ $value->id }}"
                                                    type="checkbox" id="myCheckbox09" />
                                                    <svg class="checkbox__icon" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 22 22">
                                                        <rect width="21" height="21" x=".5" y=".5" fill="#FFF"
                                                            stroke="rgba(76, 73, 227, 1)" rx="3" />
                                                        <path class="tick" stroke="rgba(76, 73, 227, 1)" fill="none"
                                                            stroke-linecap="round" stroke-width="3" d="M4 10l5 5 9-9" />
                                                    </svg>
                                                </label> --}}
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="permission[]" value="{{ $value->id }}>
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        {{ $value->name }}
                                                    </label>
                                                  </div>

                                                <br />
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class=" mt-3 col-md-12">
                                        <button type="submit" class="btn btn-primary text-white me-2">Submit</button>
                                    </div>

                                </form>

                            </div>


                        </div>
                    </div><!-- end card -->
                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>




@endsection
