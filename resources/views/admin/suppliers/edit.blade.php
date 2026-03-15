@extends('admin.layout.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>


@endsection
@section('title', 'Edit Supplier')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <!-- start page title -->

            <!-- end page title -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Edit Supplier</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="javascript: void(0);">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="javascript: void(0);">Catalogues</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit Supplier</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('suppliers.update',$supplier->id) }}" id="productForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
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
                                                    id="name" placeholder="" value="{{$supplier->name}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="description">Supplier Description</label>
                                                <textarea class="form-control subheading mt-1" id="description" name="description" rows="3">{{$supplier->description ?? ''}}</textarea>
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

                                                <input type="text" class="form-control" name="first_name" placeholder="e.g. john" value="{{$supplier->first_name ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="form-group">
                                                <label for="description">Last Name</label>

                                                <input type="text" class="form-control" name="last_name" placeholder="e.g. ibrahim" value="{{$supplier->last_name ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="form-group">
                                                <label for="description">Mobile Number</label>

                                                <input type="text" class="form-control" name="phone" placeholder="e.g. 12345678" value="{{$supplier->phone ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="form-group">
                                                <label for="description">Telephone</label>

                                                <input type="text" class="form-control" name="telephone" placeholder="e.g. 2333455665" value="{{$supplier->telephone ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="form-group">
                                                <label for="email">Email</label>

                                                <input type="text" class="form-control" name="email" placeholder="e.g. example@gmail.com" value="{{$supplier->email ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="form-group">
                                                <label for="website">Website</label>

                                                <input type="text" class="form-control" name="website" placeholder="e.g. www.google.com" value="{{$supplier->website ?? ''}}">
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
                                                <input type="text" class="form-control" name="street" placeholder="e.g. 12 Main Street" value="{{$supplier->street ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="form-group">
                                                <label for="suburb">Suburb</label>
                                                <input type="text" class="form-control" name="suburb" placeholder="e.g." id="suburb" value="{{$supplier->suburb ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <input type="text" class="form-control" name="city" placeholder="e.g. Lahore" id="city" value="{{$supplier->city ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <div class="form-group">
                                                <label for="state">State</label>
                                                <input type="text" class="form-control" name="state" placeholder="e.g. Lahore" id="state" value="{{$supplier->state ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="form-group">
                                                <label for="zip_code">Zip / Postal Code</label>
                                                <input type="text" class="form-control" name="zip_code" placeholder="e.g. 02323" id="zip_code" value="{{$supplier->zip_code ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="form-group">
                                                <label for="country">Country</label>
                                                <select  placeholder="Select Country"
                                                    name="country" class="form-control subheading" id="country">
                                                    <option value="Pakistan" {{$supplier->country == "Pakistan" ? 'selected': ''}}>Pakistan</option>
                                                    <option value="India" {{$supplier->country == "India" ? 'selected': ''}}>India</option>
                                                    <option value="USA" {{$supplier->country == "USA" ? 'selected': ''}}>USA</option>
                                                    <option value="UK" {{$supplier->country == "UK" ? 'selected': ''}}>UK</option>
                                                    <option value="Iran" {{$supplier->country == "Iran" ? 'selected': ''}}>Iran</option>
                                                    <option value="Afganistan" {{$supplier->country == "Afganistan" ? 'selected': ''}}>Afganistan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="same_as_postal_address" {{$supplier->same_as_postal_address == 1 ? 'checked': ''}}>
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
