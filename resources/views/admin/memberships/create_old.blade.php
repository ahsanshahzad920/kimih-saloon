@extends('admin.layout.app')
@section('title', 'Add Product')
@section('style')
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
    {{-- <link type="text/css" rel="stylesheet" href="{{ asset('back/assets/css/image-uploader.css') }}"> --}}

    <style>
        .variant-section {
            margin-bottom: 20px;
            margin-top: 10px
        }

        .variant-input {
            margin-bottom: 10px;
        }

        .bi-trash3 {
            pointer-events: none;
        }

        .upload__box {
            padding: 10px;
        }

        .upload__inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }

        .upload__btn {
            display: inline-block;
            font-weight: 600;
            /* color: #fff; */
            text-align: center;
            /* min-width: 116px; */
            /* padding: 5px; */
            transition: all 0.3s ease;
            cursor: pointer;
            /* border: 2px solid; */
            /* background-color: #4045ba;
                 border-color: #4045ba; */
            /* border-radius: 10px;
                 line-height: 26px;
                 font-size: 14px; */
        }

        /* .upload__btn:hover {
                 background-color: unset;
                 color: #4045ba;
                 transition: all 0.3s ease;
                } */
        .upload__btn-box {
            margin-bottom: 10px;
        }

        .upload__img-wrap {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .upload__img-box {
            width: 90px;
            padding: 0 10px;
            margin-bottom: 12px;
        }

        .upload__img-close {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 10px;
            right: 10px;
            text-align: center;
            line-height: 24px;
            z-index: 1;
            cursor: pointer;
        }

        .upload__img-close:after {
            content: '\2716';
            font-size: 14px;
            color: white;
        }

        .img-bg {
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
            padding-bottom: 100%;
            border-radius: 15%;
        }
    </style>
@endsection
@section('content')
    <div class="content">
        @if (count($errors) > 0)
            <div class="mt-5 alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="mt-5 alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ session('error') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="mt-2 alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="container-fluid py-5 px-4 bg-light">
            <div class="border-bottom w-100 text-end">
                <h3 class=" text-center pb-2 mb-0 w-100">Create a membership </h3>
            </div>
            <form action="{{ route('memberships.store') }}" id="productForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mt-4 d-flex justify-content-center">
                    @include('admin.layout.errors')
                    <div class="col-md-8">

                        <div class="card rounded-3">
                            <div class="card-body">
                                <h5>Basic info</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="membership_name">Membership Name</label>
                                            <input type="text" class="form-control mt-2" name="name"
                                                id="membership_name" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Membership Description</label>
                                            <textarea class="form-control subheading mt-1" id="description" name="description" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card rounded-3 mt-2">
                            <div class="card-body">
                                <h5>Services and sessions </h5>
                                <span class="text-seconda">Add the services and sessions included in the membership. </span>
                                <hr>
                                <div class="row mt-4">
                                    <label for="">Included Services</label>
                                    <div class="col-12 col-md-12">
                                        <select id="choices-multiple-remove-button" placeholder="Select Services"
                                            name="services[]" multiple>
                                            @foreach ($services as $service)
                                                <option value="{{$service->id}}">{{$service->service_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description">Sessions</label>
                                            <select  placeholder="Select Services"
                                                name="sessions" class="form-control subheading" id="sessions">
                                                <option value="Limited">Limited</option>
                                                <option value="Unlimited">Unlimited</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="no_of_session">
                                        <div class="form-group">
                                            <label for="description">No of sessions</label>
                                            <input type="text" class="form-control" name="no_of_session"
                                                id="no_of_session" value="5">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card rounded-3 mt-2">
                            <div class="card-body">
                                <h5>Pricing and payment </h5>
                                <span class="text-seconda">Choose how you'd like your clients to pay. </span>
                                <div class="row mt-2">
                                    <hr>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description">Valid For</label>
                                            <select id="" name="valid_for"
                                                class="form-control subheading" >
                                                <option value="7 days">7 days</option>
                                                <option value="14 days">14 days</option>
                                                <option value="1 month">1 month</option>
                                                <option value="2 months">2 months</option>
                                                <option value="3 months">3 months</option>
                                                <option value="4 months">4 months</option>
                                                <option value="6 months">6 months</option>
                                                <option value="8 months">8 months</option>
                                                <option value="1 year">1 year</option>
                                                <option value="18 months">18 months</option>
                                                <option value="2 years">2 years</option>
                                                <option value="5 years">5 years</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description">Price</label>
                                            <input type="text" class="form-control" name="price"
                                                id="price" placeholder="0.00">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <hr>
                                    <h6>Tax Rate</h6>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description">Tax rate</label>
                                            <select  placeholder="Select Services"
                                                name="tax_rate" class="form-control subheading">
                                                <option disabled>Select an Option</option>
                                                <option value="No Tax">No Tax</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card rounded-3 mt-2">
                            <div class="card-body">
                                <h5>Online sales and redemption </h5>
                                <span class="text-seconda">Client can use this membership for the online services booking. </span>
                                <div class="row mt-2">
                                    <hr>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center">
                                            <label class="switch mt-2">
                                                <input type="checkbox" name="online_sale" id="online_sale" value="1">
                                                <span class="slider"></span>
                                            </label>
                                            <p class="m-0">Enable online redemptions</p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="card rounded-3 mt-2">
                            <div class="card-body">
                                <h5>Terms & Conditions </h5>
                                <span class="text-seconda">If there are any rules attached to your membership it's a good place to mention them. </span>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="term_condition">Terms & Conditions (Optional)</label>
                                            <textarea class="form-control subheading mt-1" id="term_condition" name="term_condition" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>



                        <button type="submit" class="btn btn btn-success add-btn mt-3">Create</button>

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

            $('#sessions').change(function() {
                if (this.value == "Unlimited") {
                    $('#no_of_session').hide();
                } else {
                    $('#no_of_session').show();
                }
            });
        });
    </script>
@endsection
