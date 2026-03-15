@extends('admin.layout.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>


@endsection
@section('title', 'Create Supplier')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <!-- start page title -->

            <!-- end page title -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Create Supplier</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="javascript: void(0);">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="javascript: void(0);">Catalogues</a>
                                    </li>
                                    <li class="breadcrumb-item active">Create Supplier</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}
                <form action="{{ route('suppliers.store') }}" id="productForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-4 d-flex justify-content-center">
                        @include('admin.layout.errors')
                        <div class="col-md-6">

                            <div class="card rounded-lg p-2">
                                <div class="card-body">
                                    <h5>Supplier details</h5>

                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="membership_name">Supplier Name</label>
                                                <input type="text" class="form-control mt-2" name="name"
                                                    id="name" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="description">Supplier Description</label>
                                                <textarea class="form-control subheading mt-1" id="description" name="description" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-lg p-2">
                                <div class="card-body">
                                    <h5>Contact info</h5>

                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="description">First Name</label>
                                                {{-- <select  placeholder="Select Services"
                                                    name="sessions" class="form-control subheading" id="sessions">
                                                    <option value="Limited">Limited</option>
                                                    <option value="Unlimited">Unlimited</option>
                                                </select> --}}
                                                <input type="text" class="form-control" name="first_name" placeholder="e.g. john">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="form-group">
                                                <label for="description">Last Name</label>

                                                <input type="text" class="form-control" name="last_name" placeholder="e.g. ibrahim">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="form-group">
                                                <label for="description">Mobile Number</label>

                                                <input type="text" class="form-control" name="phone" placeholder="e.g. 12345678">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="form-group">
                                                <label for="description">Telephone</label>

                                                <input type="text" class="form-control" name="telephone" placeholder="e.g. 2333455665">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="form-group">
                                                <label for="email">Email</label>

                                                <input type="text" class="form-control" name="email" placeholder="e.g. example@gmail.com">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="form-group">
                                                <label for="website">Website</label>

                                                <input type="text" class="form-control" name="website" placeholder="e.g. www.google.com">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-lg p-2">
                                <div class="card-body">
                                    <h5>Physical Address</h5>

                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="street">Street</label>
                                                <input type="text" class="form-control" name="street" placeholder="e.g. 12 Main Street">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="form-group">
                                                <label for="suburb">Suburb</label>
                                                <input type="text" class="form-control" name="suburb" placeholder="e.g." id="suburb">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <input type="text" class="form-control" name="city" placeholder="e.g. Lahore" id="city">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <div class="form-group">
                                                <label for="state">State</label>
                                                <input type="text" class="form-control" name="state" placeholder="e.g. Lahore" id="state">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="form-group">
                                                <label for="zip_code">Zip / Postal Code</label>
                                                <input type="text" class="form-control" name="zip_code" placeholder="e.g. 02323" id="zip_code">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="form-group">
                                                <label for="country">Country</label>
                                                <select  placeholder="Select Country"
                                                    name="country" class="form-control subheading" id="country">
                                                    <option value="Pakistan">Pakistan</option>
                                                    <option value="India">India</option>
                                                    <option value="USA">USA</option>
                                                    <option value="UK">UK</option>
                                                    <option value="Iran">Iran</option>
                                                    <option value="Afganistan">Afganistan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="same_as_postal_address">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                  Same as postal address
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn btn-success add-btn mt-3">Create</button>
                                </div>
                            </div>





                        </div>

                        {{-- <div class="col-md-4">
                            <div class="card shadow border-0 rounded-3">
                                <div class="card-header bg-white p-3">
                                    <p class="m-0">Product Images</p>
                                </div>

                                <div class="card-body upload__box">
                                    <div class="file-upload upload__btn-box">
                                        <label class="upload__btn">
                                            <img src="{{ asset('assets/dasheets/img/upload-btn.svg') }}"
                                                class="img-fluid" alt="">
                                            <p class="mt-2 subheading file-input-div">
                                                Drag and Drop to upload or
                                            </p>

                                            <button type="button" class="btn create-btn mt-2 file-input-div">Select
                                                Image</button>
                                            <input type="file" multiple data-max_length="20" class="file-input"
                                                name="img[]">
                                        </label>
                                    </div>
                                    <div class="upload__img-wrap"></div>
                                </div>

                            </div>



                            <div class="card rounded-3 shadow border-0 mt-3 p-2">
                                <div class="card-header rounded-3 bg-white border-0 m-0">
                                    <p class="m-0">Registered Barcode(s)</p>
                                </div>
                                <div class="card-body p-0 ps-3 m-0">
                                    <p class="m-0" id="barcodeCount">1</p>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')


<script type="text/javascript">
    $(document).ready(function() {
        // $('.ckeditor').ckeditor();

        var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
            removeItemButton: true,
            // maxItemCount: 5,
            // searchResultLimit: 5,
            // renderChoiceLimit: 5
        });

    });
</script>
@endsection
