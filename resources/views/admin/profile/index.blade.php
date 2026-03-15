@extends('admin.layout.app')

@section('styles')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .ui-auticomplete {
            width: 440px !important;
            z-index: 999999999999;
        }
    </style>
@endsection

@section('content')
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <div class="position-relative mx-n4 mt-n4">
                    <div class="profile-wid-bg profile-setting-img">
                        <img src="dash-assets/images/profile-bg.jpg" class="profile-wid-img" alt="">
                        <div class="overlay-content">
                            <div class="text-end p-3">
                                {{-- <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                                                   <input id="profile-foreground-img-file-input" type="file" class="profile-foreground-img-file-input">
                                                   <label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light">
                                                       <i class="ri-image-edit-line align-bottom me-1"></i> Change Cover
                                                   </label>
                                               </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xxl-3">
                        <div class="card mt-n5">
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <form action="/profile-image-update/{{ auth()->id() }}" method="POST"
                                        enctype="multipart/form-data" id="uploadImageForm">
                                        @csrf
                                        @method('PUT')
                                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                            <img src="{{ isset(auth()->user()->image) ? asset('/storage' . auth()->user()->image) : asset('dash-assets/images/users/avatar-1.jpg') }}"
                                                class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                                alt="user-profile-image">
                                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                <input id="profile-img-file-input" type="file"
                                                    class="profile-img-file-input" name="img">
                                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-light text-body">
                                                        <i class="ri-camera-fill"></i>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </form>
                                    <h5 class="fs-17 mb-1">{{ auth()->user()->name }}</h5>
                                    <p class="text-muted mb-0">{{ auth()->user()->getRoleNames()->first() }}</p>
                                </div>
                            </div>
                        </div>


                        {{-- Social media links --}}
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-0">Links</h5>
                                    </div>
                                </div>
                                <form action="{{ route('user.update.links') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3 d-flex">
                                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                                            <span class="avatar-title rounded-circle fs-16 bg-body text-body">
                                                <i class="ri-facebook-fill"></i>
                                            </span>
                                        </div>

                                        <div>
                                            <input type="text"
                                                class="form-control @error('facebook_link') is-invalid @enderror"
                                                name="facebook_link" placeholder="www.facebook.com"
                                                value="{{ old('facebook_link', auth()->user()->facebook_link) }}" />
                                            @error('facebook_link')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 d-flex">
                                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                                            <span class="avatar-title rounded-circle fs-16 bg-body text-body">
                                                <i class="ri-instagram-fill"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <input type="text"
                                                class="form-control @error('instagram_link') is-invalid @enderror"
                                                name="instagram_link"
                                                value="{{ old('instagram_link', auth()->user()->instagram_link) }}">
                                            @error('github_link')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 d-flex">
                                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                                            <span class="avatar-title rounded-circle fs-16 bg-body text-body">
                                                <i class="ri-twitter-fill"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <input type="text"
                                                class="form-control @error('twitter_link') is-invalid @enderror"
                                                name="twitter_link"
                                                value="{{ old('twitter_link', auth()->user()->twitter_link) }}">
                                            @error('twitter_link')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 d-flex">
                                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                                            <span class="avatar-title rounded-circle fs-16 bg-body text-body">
                                                <i class="ri-youtube-fill"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <input type="text"
                                                class="form-control @error('linkedin_link') is-invalid @enderror"
                                                name="linkedin_link"
                                                value="{{ old('linkedin_link', auth()->user()->linkedin_link) }}">
                                            @error('linkedin_link')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 d-flex">
                                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                                            <span class="avatar-title rounded-circle fs-16 bg-body text-body">
                                                <i class="ri-vimeo-fill"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <input type="text"
                                                class="form-control @error('vimo_link') is-invalid @enderror"
                                                name="vimo_link"
                                                value="{{ old('vimo_link', auth()->user()->vimo_link) }}">
                                            @error('vimo_link')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Links</button>
                                </form>
                            </div>
                        </div>


                        <!--end card-->
                    </div>
                    <!--end col-->
                    <div class="col-xxl-9">
                        <div class="card mt-xxl-n5">
                            <div class="card-header">
                                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails"
                                            role="tab">
                                            <i class="fas fa-home"></i>
                                            Personal Details
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                            <i class="far fa-user"></i>
                                            Change Password
                                        </a>
                                    </li>
                                    @role('Business User')
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#experience" role="tab">
                                                <i class="far fa-envelope"></i>
                                                Business Details
                                            </a>
                                        </li>
                                    @endrole
                                </ul>
                            </div>
                            <div class="card-body p-4">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                        <form action="{{ route('profile.update', auth()->id()) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                @php
                                                    $fullName = auth()->user()->name;

                                                    // Split the full name into an array of first and last names
                                                    $nameArray = explode(' ', $fullName);

                                                    // Get the first name
                                                    $firstName = $nameArray[0];

                                                    // Get the last name
                                                    $lastName = isset($nameArray[1]) ? $nameArray[1] : '';
                                                @endphp
                                                <div class="col-md-6">
                                                    <div class="form-group fw-bold mb-3">
                                                        <label for="exampleFormControlSelect1">First Name
                                                            <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control subheading mt-2"
                                                            placeholder="First Name" id="exampleFormControlInput1"
                                                            name="first_name" value="{{ $firstName ?? '' }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group fw-bold mb-3">
                                                        <label for="exampleFormControlSelect1">Last Name
                                                            <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control subheading mt-2"
                                                            placeholder="Last Name" id="exampleFormControlInput1"
                                                            name="last_name" value="{{ $lastName ?? '' }}" />
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="phonenumberInput" class="form-label">Phone
                                                            Number</label>
                                                        <input type="text" class="form-control" id="phonenumberInput"
                                                            placeholder="Enter your phone number" name="phone"
                                                            value="{{ auth()->user()->phone ?? '' }}">
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="emailInput" class="form-label">Email
                                                            Address</label>
                                                        <input type="email" class="form-control" id="emailInput"
                                                            placeholder="Enter your email" name="email"
                                                            value="{{ auth()->user()->email ?? '' }}" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="websiteInput1" class="form-label">Website</label>
                                                        <input type="text" class="form-control" id="websiteInput1"
                                                            placeholder="www.example.com" value=""
                                                            name="website" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="countryInput" class="form-label">Country</label>
                                                        <input type="text" class="form-control" id="countryInput"
                                                            placeholder="Country"
                                                            value="{{ auth()->user()->country ?? '' }}" name="country" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="mb-3 pb-2">
                                                        <label for="exampleFormControlTextarea"
                                                            class="form-label">Description</label>
                                                        <textarea class="form-control" id="exampleFormControlTextarea" name="description"
                                                            placeholder="Enter your description" rows="3"></textarea>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-12">
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <button type="submit" class="default-btn">Update</button>
                                                        <a href="{{ route('dashboard') }}" class="default-btn">Cancel</a>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </form>
                                    </div>
                                    <!--end tab-pane-->
                                    <div class="tab-pane" id="changePassword" role="tabpanel">
                                        <form action="{{ route('profile.password.update') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="row g-2">
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label for="oldpasswordInput" class="form-label">Old
                                                            Password*</label>
                                                        <input type="password" class="form-control" id="oldpasswordInput"
                                                            placeholder="Enter current password" name="current_password">
                                                        @error('current_password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label for="newpasswordInput" class="form-label">New
                                                            Password*</label>
                                                        <input type="password" class="form-control" id="newpasswordInput"
                                                            placeholder="Enter new password" name="password">
                                                        @error('password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label for="confirmpasswordInput" class="form-label">Confirm
                                                            Password*</label>
                                                        <input type="password" class="form-control"
                                                            id="confirmpasswordInput" placeholder="Confirm password"
                                                            name="password_confirmation">
                                                        @error('password_confirmation')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="text-end">
                                                        <button type="submit" class="default-btn">Change
                                                            Password</button>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </form>
                                        {{-- <div class="mt-4 mb-3 border-bottom pb-2">
                                            <div class="float-end">
                                                <a href="javascript:void(0);" class="link-primary">All Logout</a>
                                            </div>
                                            <h5 class="card-title">Login History</h5>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="flex-shrink-0 avatar-sm">
                                                <div class="avatar-title bg-light text-primary rounded-3 fs-18">
                                                    <i class="ri-smartphone-line"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6>iPhone 12 Pro</h6>
                                                <p class="text-muted mb-0">Los Angeles, United States - March 16 at
                                                    2:47PM</p>
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);">Logout</a>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="flex-shrink-0 avatar-sm">
                                                <div class="avatar-title bg-light text-primary rounded-3 fs-18">
                                                    <i class="ri-tablet-line"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6>Apple iPad Pro</h6>
                                                <p class="text-muted mb-0">Washington, United States - November 06
                                                    at 10:43AM</p>
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);">Logout</a>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="flex-shrink-0 avatar-sm">
                                                <div class="avatar-title bg-light text-primary rounded-3 fs-18">
                                                    <i class="ri-smartphone-line"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6>Galaxy S21 Ultra 5G</h6>
                                                <p class="text-muted mb-0">Conneticut, United States - June 12 at
                                                    3:24PM</p>
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);">Logout</a>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-sm">
                                                <div class="avatar-title bg-light text-primary rounded-3 fs-18">
                                                    <i class="ri-macbook-line"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6>Dell Inspiron 14</h6>
                                                <p class="text-muted mb-0">Phoenix, United States - July 26 at
                                                    8:10AM</p>
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);">Logout</a>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <!--end tab-pane-->
                                    @role('Business User')
                                        <div class="tab-pane" id="experience" role="tabpanel">
                                            <form action="{{ route('businesses.update', auth()->id()) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div id="newlink">
                                                    <div id="1">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="mb-3">
                                                                    <label for="jobTitle" class="form-label">Business
                                                                        Name</label>
                                                                    <input type="text" class="form-control" id="jobTitle"
                                                                        placeholder="Job title" name="business_name"
                                                                        value="{{ auth()->user()->businessUser->business_name ?? '' }}">
                                                                </div>
                                                            </div>
                                                            <!--end col-->
                                                            <div class="col-lg-12">
                                                                <div class="mb-3">
                                                                    <label for="companyName" class="form-label">Business
                                                                        Images</label>
                                                                    <input type="file"
                                                                        class="form-control @error('image*') is-invalid @enderror"
                                                                        name="image[]" multiple id="companyName"
                                                                        placeholder="Company name">
                                                                    <span class="text-danger">
                                                                        @error('image*')
                                                                            {{ $message }}
                                                                        @enderror
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="mb-3">
                                                                    <label for="companyName" class="form-label">About
                                                                        Us</label>
                                                                    <textarea class="form-control @error('about_us') is-invalid @enderror" name="about_us" id="companyName"
                                                                        placeholder="About Us" cols="30" rows="5">{{ auth()->user()->businessUser->about_us ?? '' }}</textarea>
                                                                    <span class="text-danger">
                                                                        @error('about_us')
                                                                            {{ $message }}
                                                                        @enderror
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="mb-3">
                                                                    <label for="addressInput"
                                                                        class="form-label">Location</label>
                                                                    <input type="text"
                                                                        class="form-control @error('location') is-invalid @enderror"
                                                                        name="location" id="addressInput"
                                                                        placeholder="Location"
                                                                        value="{{ auth()->user()->businessUser->location ?? '' }}">

                                                                </div>
                                                            </div>
                                                            <div id="suggestionsContainer"></div>

                                                            <div class="mapouter mt-3 mb-3">
                                                                <div class="gmap_canvas">
                                                                    <iframe class="gmap_iframe" width="100%"
                                                                        frameborder="0" scrolling="no" marginheight="0"
                                                                        marginwidth="0"
                                                                        src="https://maps.google.com/maps?q={{ auth()->user()->businessUser->latitude ?? '31.5994529' }},{{ auth()->user()->businessUser->longitude ?? '74.3379943' }}&t=k&z=15&ie=UTF8&iwloc=&output=embed"
                                                                        id="map"></iframe>
                                                                    <a href="https://embed-googlemap.com">embed google maps in
                                                                        website</a>
                                                                </div>
                                                                <style>
                                                                    .mapouter {
                                                                        position: relative;
                                                                        text-align: right;
                                                                        width: 100%;
                                                                        height: 400px;
                                                                    }

                                                                    .gmap_canvas {
                                                                        overflow: hidden;
                                                                        background: none !important;
                                                                        width: 100%;
                                                                        height: 400px;
                                                                    }

                                                                    .gmap_iframe {
                                                                        height: 400px !important;
                                                                    }
                                                                </style>

                                                            </div>
                                                            <input type="hidden" name="latitude" id="latitude">
                                                            <input type="hidden" name="longitude" id="longitude">
                                                            <!--end col-->

                                                        </div>
                                                        <!--end row-->
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="hstack gap-2">
                                                        <button type="submit" class="default-btn">Update</button>

                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </form>
                                        </div>
                                    @endrole

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

            </div>
            <!-- container-fluid -->
        </div><!-- End Page-content -->


    </div>
    <!-- end main content-->
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#uploadImageForm').on('submit', (function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Profile Image Updated Successfully',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    },
                    error: function(data) {
                        console.log("error");
                        console.log(data);
                    }
                });
            }));
            $('#profile-img-file-input').on('change', function() {
                var file = $(this)[0].files[0];
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.user-profile-image').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
                // let image = $(this).val();
                $('#uploadImageForm').submit();

            });

            // var formData = new FormData();
            //     formData.append('img', file);
            //     $.ajax({
            //         type: "PUT",
            //         url: "/profile-image-update/{{ auth()->id() }}",
            //         headers:{
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         },
            //         data: formData,
            //         success: function (response) {
            //             if(response.status){
            //                     Swal.fire({
            //                     icon: 'success',
            //                     title: 'Profile Image Updated Successfully',
            //                     showConfirmButton: false,
            //                     timer: 1500
            //                 });
            //             }
            //         },
            //         error: function (error) {
            //             console.log(error);
            //         }
            //     });
        });
    </script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            var suggestionsContainer = $("#suggestionsContainer");
            $("#addressInput").autocomplete({
                source: function(request, response) {
                    var searchTerm = request.term;
                    performAddressSearch(searchTerm, response);
                },
                minLength: 1,
                select: function(event, ui) {
                    $("#addressInput").val(ui.item.value);
                    var selectedAddress = ui.item.value;
                    console.log("location:" + ui.item.latitude + " long:" + ui.item.longitude);
                    // getCoordinates(selectedAddress);

                    event.preventDefault();
                },
                appendTo: "#suggestionsContainer"
            }).autocomplete("instance")._renderItem = function(ul, item) {
                return $("<li>").append("<div>" + item.label + "</div>").appendTo(ul);
            };


            function performAddressSearch(searchTerm, response) {
                console.log("perfome");
                var apiUrl = "https://nominatim.openstreetmap.org/search?format=json&limit=10&q=" +
                    encodeURIComponent(
                        searchTerm);
                $.ajax({
                    url: apiUrl,
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        var suggestions = [];
                        for (var i = 0; i < data.length; i++) {
                            suggestions.push({
                                value: data[i].display_name,
                                label: data[i].display_name,
                                latitude: parseFloat(data[i].lat),
                                longitude: parseFloat(data[i].lon),
                            });
                            // console.log(data[1])
                        }

                        response(suggestions);
                    },
                    error: function() {}
                });
            }

            var latitude;
            var longitude;

            $("#addressInput").on('autocompleteselect', function(event, ui) {
                latitude = ui.item.latitude;
                longitude = ui.item.longitude;
                city = ui.item.city;
                state = ui.item.state;
                country = ui.item.country;
                countryCode = ui.item.countryCode;
                $('#latitude').val(latitude);
                $('#longitude').val(longitude);
                // Update map iframe
                $('.gmap_iframe').attr('src', 'https://maps.google.com/maps?q=' + latitude + ',' +
                    longitude + '&t=k&z=16&ie=UTF8&iwloc=&output=embed');

            });

            // $("#dntHaveAddress").change(function() {
            //     if ($(this).is(":checked")) {
            //         $("#addressInput").prop("disabled", true);
            //         $("#addressInput").val("");
            //         $("#suggestionsContainer").hide();
            //         $('.mapouter').hide();
            //         $('#latitude').val("");
            //         $('#longitude').val("");
            //     } else {
            //         $("#addressInput").prop("disabled", false);
            //         $("#suggestionsContainer").show();
            //         $('.mapouter').show();
            //         $('#latitude').val(latitude);
            //         $('#longitude').val(longitude);
            //     }
            // });

        });
    </script>
@endsection
