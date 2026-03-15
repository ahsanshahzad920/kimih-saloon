@extends('user.layouts.app')

@section('top-styles')
    <!-- App Css-->
    <link href="{{ asset('dash-assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    {{-- <link href="{{ asset('dash-assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" /> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
    <!-- CSS Notify -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.css" />

<!-- JS CSS Notify -->
<script src="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.min.js"></script>
@endsection

@section('content')
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="container-fluid">

        <div class="position-relative ">
            <div class="profile-wid-bg profile-setting-img">
                <img src="dash-assets/images/profile-bg.jpg" class="profile-wid-img" alt="">
                <div class="overlay-content">
                    <div class="text-end p-3">

                    </div>
                </div>
            </div>
        </div>

        @include('admin.layout.errors')

        <div class="row mt-2">
            <div class="col-xxl-3">
                <div class="card ">
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
                                        <input id="profile-img-file-input" type="file" class="profile-img-file-input"
                                            name="img">
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

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-0">Links</h5>
                            </div>

                        </div>
                        <div class="mb-3 d-flex">
                            <div class="avatar-xs d-block flex-shrink-0 me-3">
                                <span class="avatar-title rounded-circle fs-16 bg-body text-body">
                                    <i class="ri-facebook-fill"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="facebook" id="gitUsername"
                                placeholder="www.facebook.com" value="">
                        </div>
                        <div class="mb-3 d-flex">
                            <div class="avatar-xs d-block flex-shrink-0 me-3">
                                <span class="avatar-title rounded-circle fs-16 bg-body text-body">
                                    <i class="ri-github-fill"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="github" id="gitUsername"
                                placeholder="www.github.com" value="">
                        </div>
                        <div class="mb-3 d-flex">
                            <div class="avatar-xs d-block flex-shrink-0 me-3">
                                <span class="avatar-title rounded-circle fs-16 bg-body text-body">
                                    <i class="ri-twitter-fill"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="twitter" id="gitUsername"
                                placeholder="www.twitter.com" value="">
                        </div>
                        <div class="mb-3 d-flex">
                            <div class="avatar-xs d-block flex-shrink-0 me-3">
                                <span class="avatar-title rounded-circle fs-16 bg-body text-body">
                                    <i class="ri-youtube-fill"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="youtube" id="gitUsername"
                                placeholder="www.youtube.com" value="">
                        </div>


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
                                <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
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

                        </ul>
                    </div>
                    <div class="card-body p-4">
                        <div class="tab-content">
                            <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                <form action="{{ route('user-profile.update', auth()->id()) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group fw-bold mb-3">
                                                <label for="exampleFormControlSelect1">Full Name
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control subheading mt-2"
                                                    placeholder="Full Name" id="exampleFormControlInput1" name="name"
                                                    value="{{ auth()->user()->name ?? '' }}" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="emailInput" class="form-label">Email
                                                    Address</label>
                                                <input type="email" class="form-control mt-2" id="emailInput"
                                                    placeholder="Enter your email" name="email"
                                                    value="{{ auth()->user()->email ?? '' }}" readonly>
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
                                                <label for="birth_date" class="form-label">Date of birth</label>
                                                <input type="date" class="form-control" id="birth_date"
                                                    placeholder="Birthday" value="{{ $client->birth_date ?? '' }}"
                                                    name="birth_date" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="gender" class="form-label">Gender</label>
                                                <select name="gender" id="gender" class="form-control">
                                                    <option disabled> Select Gender</option>
                                                    <option value="Female"> Female</option>
                                                    <option value="Male"> Male</option>
                                                    <option value="Other"> Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="countryInput" class="form-label">Country</label>
                                                <input type="text" class="form-control" id="countryInput"
                                                    placeholder="Country" value="{{ auth()->user()->country ?? '' }}"
                                                    name="country" />
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3 pb-2">
                                                <label for="exampleFormControlTextarea" class="form-label">Address</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea" name="address" placeholder="Enter your address"
                                                    rows="3">{{ auth()->user()->address ?? '' }}</textarea>
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
                                                <button type="submit" class="default-btn">Updates</button>
                                                <a href="/" class="default-btn">Cancel</a>
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
                                                <input type="password" class="form-control" id="confirmpasswordInput"
                                                    placeholder="Confirm password" name="password_confirmation">
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

                            </div>
                            <!--end tab-pane-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
                            //     Swal.fire({
                            //     icon: 'success',
                            //     title: 'Profile Image Updated Successfully',
                            //     showConfirmButton: false,
                            //     timer: 1500
                            // });
                            // for success - green box
                            // toastr.success('Profile Image Updated Successfully');
                            new Notify({
                                status: 'success',
                                title: 'Success',
                                text: `Profile Image Updated Successfully`,
                                effect: 'fade',
                                speed: 300,
                                customClass: '',
                                customIcon: '',
                                showIcon: true,
                                showCloseButton: true,
                                autoclose: true,
                                autotimeout: 3000,
                                notificationsGap: null,
                                notificationsPadding: null,
                                type: 'outline',
                                position: 'right top',
                                customWrapper: '',
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
@endsection
