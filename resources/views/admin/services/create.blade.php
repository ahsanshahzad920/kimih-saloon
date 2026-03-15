@extends('admin.layout.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>


@endsection
@section('title', 'Create Services')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <!-- start page title -->

            <!-- end page title -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Create Service</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="javascript: void(0);">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active">Add Service</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card card-shadow rounded-3 border-0 mt-4 p-4 pb-5 ">
                        <div class="container-fluid create-product-form rounded">
                            <h5>Basic info</h5>
                            <h6 class="text-secondary">Add a service name and choose the service type.</h6>
                            <!--end breadcrumb-->
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1" class="mb-1">Service Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control subheading" id="exampleFormControlInput1"
                                            placeholder="Service Name" name="service_name" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="service_type" class="mb-1">Service Type <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control subheading" id="service_type"
                                            placeholder="Service Name" name="service_type" required />
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="row my-3">
                                <div class="col-md-12">
                                    <label for="plan_id">Select Plan</label>
                                    <select class="form-select" name="plan_id" id="plan_id">
                                        <option selected disabled>Select Plan</option>
                                        @foreach ($plans as $plan)
                                            <option value="{{ $plan->id ?? '' }}">{{ $plan->name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1" class="mb-1">Service Category <span
                                                class="text-danger">*</span>
                                        </label>
                                        <select name="service_category" class="form-control subheading"
                                            id="service_category" required>
                                            <option disabled>Select an Option</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1" class="mb-1">Service available for </label>
                                        <select class="form-select subheading" id="exampleFormControl" name="available_for">
                                            <option disabled>Select an Option</option>
                                            <option value="Everyone">Everyone</option>
                                            <option value="Male">Male Only</option>
                                            <option value="Female">Female Only</option>
                                        </select>
                                    </div>
                                </div>


                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label mb-1">Service description</label>
                                        <textarea name="service_description" id="address" cols="30" rows="4" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label mb-1">Aftercare description</label>
                                        <textarea name="aftercare_description" id="address" cols="30" rows="4" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card card-shadow rounded-3 border-0 mt-4 p-4 pb-5 ">
                        <div class="container-fluid create-product-form rounded">
                            <h5>Onling Booking</h5>
                            <h6 class="text-secondary">Enable online bookings, choose who the service is available for and
                                add a
                                short description.</h6>
                            <!--end breadcrumb-->
                            <div class="row mt-4">
                                {{-- <div class="d-flex align-items-center">
                                    <label class="switch mt-2">
                                        <input type="checkbox" name="online_bookings" id="online_bookings" value="1">
                                        <span class="slider"></span>
                                    </label>
                                    <p class="m-0">Enable online bookings</p>
                                </div> --}}
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="online_bookings"
                                        id="online_bookings">
                                    <label class="form-check-label" for="online_bookings">
                                        Enable online bookings
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-shadow rounded-3 border-0 mt-4 p-4 pb-5 ">
                        <div class="container-fluid create-product-form rounded">
                            <h5>Team</h5>
                            <h6 class="text-secondary">Assign team members to the service and manage commission</h6>
                            <!--end breadcrumb-->
                            <div class="row mt-4">
                                <label for="">Team Memeber</label>
                                <div class="col-12 col-md-12">
                                    {{-- <select id="choices-multiple-remove-button" placeholder="Select Team Memeber"
                                        name="team_member[]" multiple>
                                        @foreach ($team_members as $team_member)
                                            <option value="{{ $team_member->id }}">{{ $team_member->name }}</option>
                                        @endforeach
                                    </select> --}}
                                    <select id="choices-multiple-remove-button" name="team_member[]" multiple>
                                        @foreach ($team_members as $team_member)
                                            <option value="{{ $team_member->id }}">{{ $team_member->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="container-fluid create-product-form rounded mt-2">
                            <h5>Team member commission</h5>
                            <h6 class="text-secondary">Calculate team member commission when the service is sold.</h6>
                            <!--end breadcrumb-->
                            <div class="row mt-4">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="team_memeber_commission"
                                        id="team_memeber_commission" value="1">
                                    <label class="form-check-label" for="team_memeber_commission">
                                        Enable team member commission
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-shadow rounded-3 border-0 mt-4 p-4 pb-5 ">
                        <div class="container-fluid create-product-form rounded">
                            <h5>Pricing and Duration </h5>
                            <h6 class="text-secondary">Add the pricing options and duration of the service.</h6>
                            <!--end breadcrumb-->
                            <h6 class="mt-4">Pricing option </h6>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="duration" class="mb-1">Duration </label>
                                        <select id="duration" name="duration" class="form-control subheading">
                                            <option disabled>Select an Option</option>
                                            <option value="5min">5min</option>
                                            <option value="10min">10min</option>
                                            <option value="15min">15min</option>
                                            <option value="20min">20min</option>
                                            <option value="25min">25min</option>
                                            <option value="30min">30min</option>
                                            <option value="35min">35min</option>
                                            <option value="40min">40min</option>
                                            <option value="45min">45min</option>
                                            <option value="50min">50min</option>
                                            <option value="55min">55min</option>
                                            <option value="1h">1h</option>
                                            <option value="1h 5min">1h 5min</option>
                                            <option value="1h 10min">1h 10min</option>
                                            <option value="1h 15min">1h 15min</option>
                                            <option value="1h 20min">1h 20min</option>
                                            <option value="1h 25min">1h 25min</option>
                                            <option value="1h 30min">1h 30min</option>
                                            <option value="1h 35min">1h 35min</option>
                                            <option value="1h 40min">1h 40min</option>
                                            <option value="1h 45min">1h 45min</option>
                                            <option value="1h 50min">1h 50min</option>
                                            <option value="1h 55min">1h 55min</option>
                                            <option value="2h">2h</option>
                                            <option value="2h 15min">2h 15min</option>
                                            <option value="2h 30min">2h 30min</option>
                                            <option value="2h 45min">2h 45min</option>
                                            <option value="3h">3h</option>
                                            <option value="3h 15min">3h 15min</option>
                                            <option value="3h 30min">3h 30min</option>
                                            <option value="3h 45min">3h 45min</option>
                                            <option value="4h">4h</option>
                                            <option value="4h 30min">4h 30min</option>
                                            <option value="5h">5h</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="price_type" class="mb-1">Price Type </label>
                                        <select id="price_type" name="price_type" class="form-control subheading">
                                            <option disabled>Select an Option</option>
                                            <option value="Fixed">Fixed</option>
                                            <option value="From">From</option>
                                            <option value="Free">Free</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="price_type" class="mb-1">Price </label>
                                        <input type="text" class="form-control subheading"
                                            id="exampleFormControlInput1" placeholder="e.g. 20.00" name="price" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card card-shadow rounded-3 border-0 mt-4 p-4 pb-5 ">
                        <div class="container-fluid create-product-form rounded">
                            <h5>Notification settings</h5>
                            <h6 class="text-secondary">Manage automated messages sent for this service </h6>
                            <!--end breadcrumb-->
                            <div class="row mt-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="notify"
                                        id="notify-checkbox">
                                    <label class="form-check-label" for="notify-checkbox">
                                        Choose when you whould like to notify your client to rebook this service
                                    </label>
                                </div>
                            </div>
                            <div class="row mt-3 " id="notify-option" style="display: none">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{-- <label for="notify_count" class="mb-1">Price </label> --}}
                                        <input type="text" class="form-control subheading" id="notify_count"
                                            placeholder="e.g. 2" name="notify_count" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{-- <label for="notify_days" class="mb-1">Price </label> --}}
                                        <select name="notify_days" id="notify_days" class="form-control subheading">
                                            <option disabled>Select an Option</option>
                                            <option value="Days after">Days after</option>
                                            <option value="Week after">Week after</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-shadow rounded-3 border-0 mt-4 p-4 pb-5 ">
                        <div class="container-fluid create-product-form rounded">
                            <h5>Sales settings </h5>
                            <h6 class="text-secondary">Set the tax rate </h6>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="notify_days" class="mb-1">Tax (Included in price) </label>
                                    <select name="sales_tax" id="sales_tax" class="form-control subheading">
                                        <option disabled>Select an Option</option>
                                        <option value="No Tax">No Tax</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="btn default-btn mt-2 text-white" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                removeItemButton: true,
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            // $('.ckeditor').ckeditor();

            // var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
            //     removeItemButton: true,
            //     // maxItemCount: 5,
            //     // searchResultLimit: 5,
            //     // renderChoiceLimit: 5
            // });

            $('#notify-checkbox').change(function() {
                if (this.checked) {
                    $('#notify-option').show();
                } else {
                    $('#notify-option').hide();
                }
            });
        });
    </script>
@endsection
