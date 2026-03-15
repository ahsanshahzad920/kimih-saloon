@extends('admin.layout.app')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
    <link rel="stylesheet" href="{{ asset('virtual-select-master/dist/virtual-select.min.css') }}" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.10.1/main.min.css" rel="stylesheet"> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.10.1/main.min.css" rel="stylesheet"> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@5.10.1/main.min.css" rel="stylesheet"> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet"> --}}

    <style>
        .vscomp-wrapper {
            width: 450px !important;
        }
    </style>
@endsection
@section('title', 'Services')
@section('content')

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Calendar</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Apps</a></li>
                                    <li class="breadcrumb-item active">Calendar</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- {{dd($clients)}} --}}
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-xl-3">
                                <div class="card card-h-100">
                                    <div class="card-body">
                                        {{-- <button class="btn btn-primary w-100" id="btn-new-event"><i
                                                class="mdi mdi-plus"></i> Create New appointment </button> --}}

                                                <button class="btn btn-primary w-100" id="btn-new-event" data-bs-toggle="modal" data-bs-target="#event-modal">
                                                    <i class="mdi mdi-plus"></i> Create New Appointment
                                                </button>


                                        {{-- <div id="external-events">
                                            <br>
                                            <p class="text-muted">Drag and drop your appointment or click in the
                                                calendar</p>
                                            <div class="external-event fc-event bg-success-subtle text-success"
                                                data-class="bg-success-subtle">
                                                <i class="mdi mdi-checkbox-blank-circle me-2"></i>New appointment
                                                Planning
                                            </div>
                                            <div class="external-event fc-event bg-info-subtle text-info"
                                                data-class="bg-info-subtle">
                                                <i class="mdi mdi-checkbox-blank-circle me-2"></i>Meeting
                                            </div>
                                            <div class="external-event fc-event bg-warning-subtle text-warning"
                                                data-class="bg-warning-subtle">
                                                <i class="mdi mdi-checkbox-blank-circle me-2"></i>Generating
                                                Reports
                                            </div>
                                            <div class="external-event fc-event bg-danger-subtle text-danger"
                                                data-class="bg-danger-subtle">
                                                <i class="mdi mdi-checkbox-blank-circle me-2"></i>Create
                                                New theme
                                            </div>
                                        </div> --}}

                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-1">Upcoming appointment </h5>
                                    <p class="text-muted">Don't miss scheduled appointment </p>
                                    <div class="pe-2 me-n1 mb-3" data-simplebar style="height: 400px">
                                        <div id="upcoming-event-list"></div>
                                    </div>
                                </div>


                                <!--end card-->
                            </div> <!-- end col-->

                            <div class="col-xl-9">
                                <div class="card card-h-100">
                                    <div class="card-body">
                                        <div id="calendar"></div>
                                    </div>
                                </div>
                            </div><!-- end col -->
                        </div>
                        <!--end row-->

                        <div style='clear:both'></div>

                        <!-- Add New Event MODAL -->
                        <div class="modal fade" id="event-modal" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0">
                                    <div class="modal-header p-3 bg-info-subtle">
                                        <h5 class="modal-title" id="modal-title">Appointment </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-hidden="true"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <form class="needs-validation" name="event-form" id="form-event" novalidate>
                                            {{-- <div class="text-end">
                                                    <a href="#" class="btn btn-sm btn-soft-primary" id="edit-event-btn"
                                                        data-id="edit-event" onclick="editEvent(this)"
                                                        role="button">Edit</a>
                                                </div> --}}

                                            <div class="row event-form">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Type</label>
                                                        <select class="form-select d-none" name="category"
                                                            id="event-category" required>
                                                            <option value="" disabled selected>Select Type</option>
                                                            <option value="bg-danger-subtle">Danger</option>
                                                            <option value="bg-success-subtle">Success</option>
                                                            <option value="bg-primary-subtle">Primary</option>
                                                            <option value="bg-info-subtle">Info</option>
                                                            <option value="bg-dark-subtle">Dark</option>
                                                            <option value="bg-warning-subtle">Warning</option>
                                                        </select>
                                                        <div class="invalid-feedback">Please select a valid
                                                            appointment category</div>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">appointment Name</label>
                                                        <input class="form-control d-none" placeholder="Enter event name"
                                                            type="text" name="title" id="event-title" required
                                                            value="" />
                                                        <div class="invalid-feedback">Please provide a valid
                                                            appointment name</div>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label>appointment Date</label>
                                                        <div class="input-group d-none">
                                                            {{-- <input type="text" id="event-start-date" --}}
                                                            <input type="text" id="event-start-date"
                                                                class="form-control flatpickr flatpickr-input"
                                                                placeholder="Select date" readonly required>
                                                            <span class="input-group-text"><i
                                                                    class="ri-calendar-event-line"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-12" id="event-time">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Start Time</label>
                                                                <div class="input-group d-none">
                                                                    <input id="timepicker1" type="text"
                                                                        class="form-control flatpickr flatpickr-input"
                                                                        placeholder="Select start time" readonly>
                                                                    <span class="input-group-text"><i
                                                                            class="ri-time-line"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">End Time</label>
                                                                <div class="input-group d-none">
                                                                    <input id="timepicker2" type="text"
                                                                        class="form-control flatpickr flatpickr-input"
                                                                        placeholder="Select end time" readonly>
                                                                    <span class="input-group-text"><i
                                                                            class="ri-time-line"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Select Team Member</label>
                                                        <select class="form-select d-none" name="member"
                                                            id="event-member" required>
                                                            <option disabled selected>Select Member</option>
                                                            @foreach ($team_members as $team_member)
                                                                <option value="{{ $team_member->id }}">
                                                                    {{ $team_member->name }} </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">Please select a member</div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Select Client</label>
                                                        <select class="form-select d-none" name="client"
                                                            id="event-client" required>
                                                            <option disabled selected>Select Client</option>
                                                            @foreach ($clients as $client)
                                                                <option value="{{ $client->id }}">{{ $client->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">Please select a client</div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Select Services</label> <br>
                                                        {{-- <select id="choices-multiple-remove-button" class="form-control d-none" placeholder="Select Service"
                                                                name="services[]" multiple>

                                                                @foreach ($services as $service)
                                                                    <option value="{{ $service->id }}" >{{ $service->service_name }}</option>
                                                                @endforeach
                                                            </select> --}}
                                                        {{-- <select id="event-services" class="form-control d-none" placeholder="Select Service"
                                                                name="services[]" multiple>
                                                                @foreach ($services as $service)
                                                                    <option value="{{ $service->id }}" >{{ $service->service_name }}</option>
                                                                @endforeach
                                                            </select> --}}
                                                        <select multiple name="services[]" id="example-select"
                                                            placeholder="Select Services" data-search="false"
                                                            data-silent-initial-value-set="true">

                                                            @foreach ($services as $service)
                                                                <option value="{{ $service->id }}">
                                                                    {{ $service->service_name }}</option>
                                                            @endforeach

                                                        </select>
                                                        <div class="invalid-feedback">Please select a client</div>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="event-location">Location</label>
                                                        <div>
                                                            <input type="text" class="form-control d-none"
                                                                name="event-location" id="event-location"
                                                                placeholder="Event location">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Description</label>
                                                        <textarea class="form-control d-none" id="event-description" placeholder="Enter a description" rows="3"
                                                            spellcheck="false"></textarea>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                            <div class="hstack gap-2 justify-content-end">
                                                {{-- <button type="button" class="btn btn-soft-danger"
                                                        id="btn-delete-event"><i class="ri-close-line align-bottom"></i>
                                                        Delete</button> --}}
                                                <button type="submit" class="btn btn-success" id="btn-save-event">Add
                                                    appointment </button>
                                            </div>
                                        </form>
                                    </div>
                                </div> <!-- end modal-content-->
                            </div> <!-- end modal dialog-->
                        </div> <!-- end modal-->
                        <!-- Add New Event MODAL -->
                        <div class="modal fade" id="event-details-modal" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0">
                                    <div class="modal-header p-3 bg-info-subtle">
                                        <h5 class="modal-title" id="modal-title">Event Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-hidden="true"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="event-details">
                                            <form>
                                                <div id="event-details2">
                                                    <div class="text-end">
                                                        <a href="#" class="btn btn-sm btn-soft-primary"
                                                            id="edit-event-btn" data-id="edit-event" role="button">Edit
                                                        </a>
                                                    </div>
                                                    <div class="d-flex mb-2">
                                                        <div class="flex-grow-1 d-flex align-items-center">
                                                            <div class="flex-shrink-0 me-3">
                                                                <i class="ri-calendar-event-line text-muted fs-16"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="d-block fw-semibold mb-0"
                                                                    id="event-start-date-tag">
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="flex-shrink-0 me-3">
                                                            <i class="ri-time-line text-muted fs-16"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="d-block fw-semibold mb-0"><span
                                                                    id="event-timepicker1-tag"></span> - <span
                                                                    id="event-timepicker2-tag"></span></h6>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="flex-shrink-0 me-3">
                                                            <i class="ri-map-pin-line text-muted fs-16"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="d-block fw-semibold mb-0"> <span
                                                                    id="event-location-tag"></span></h6>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex mb-3">
                                                        <div class="flex-shrink-0 me-3">
                                                            <i class="ri-discuss-line text-muted fs-16"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <p class="d-block text-muted mb-0" id="event-description-tag">
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="eventId" id="eventId">
                                                <div class="row event-form" style="display: none">
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Type</label>
                                                            <select class="form-select" name="category"
                                                                id="update-event-category" required>
                                                                <option value="bg-danger-subtle">Danger</option>
                                                                <option value="bg-success-subtle">Success</option>
                                                                <option value="bg-primary-subtle">Primary</option>
                                                                <option value="bg-info-subtle">Info</option>
                                                                <option value="bg-dark-subtle">Dark</option>
                                                                <option value="bg-warning-subtle">Warning</option>
                                                            </select>
                                                            <div class="invalid-feedback">Please select a valid
                                                                appointment category</div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">appointment Name</label>
                                                            <input class="form-control " placeholder="Enter event name"
                                                                type="text" name="title" id="update-event-title"
                                                                required value="" />
                                                            <div class="invalid-feedback">Please provide a valid
                                                                appointment name</div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label>appointment Date</label>
                                                            <div class="input-group">
                                                                {{-- <input type="text" id="event-start-date" --}}
                                                                <input type="text" id="update-event-start-date"
                                                                    class="form-control flatpickr flatpickr-input"
                                                                    placeholder="Select date" readonly required>
                                                                <span class="input-group-text"><i
                                                                        class="ri-calendar-event-line"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-12" id="event-time">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Start Time</label>
                                                                    <div class="input-group">
                                                                        <input id="update-timepicker1" type="text"
                                                                            class="form-control flatpickr flatpickr-input"
                                                                            placeholder="Select start time" readonly>
                                                                        <span class="input-group-text"><i
                                                                                class="ri-time-line"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">End Time</label>
                                                                    <div class="input-group ">
                                                                        <input id="update-timepicker2" type="text"
                                                                            class="form-control flatpickr flatpickr-input"
                                                                            placeholder="Select end time" readonly>
                                                                        <span class="input-group-text"><i
                                                                                class="ri-time-line"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Select Team Member</label>
                                                            <select class="form-select" name="member"
                                                                id="update-event-member" required>
                                                                <option disabled>Select Member</option>
                                                                @foreach ($team_members as $team_member)
                                                                    <option value="{{ $team_member->id }}">
                                                                        {{ $team_member->name }} </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">Please select a member</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Select Client</label>
                                                            <select class="form-select" name="client"
                                                                id="update-event-client" required>
                                                                <option disabled>Select Client</option>
                                                                @foreach ($clients as $client)
                                                                    <option value="{{ $client->id }}">
                                                                        {{ $client->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">Please select a client</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Select Services</label> <br>

                                                            {{-- <select multiple name="services[]" id="update-example-select"
                                                                placeholder="Select Services" data-search="false"
                                                                data-silent-initial-value-set="true">

                                                                @foreach ($services as $service)
                                                                    <option value="{{ $service->id }}">
                                                                        {{ $service->service_name }}</option>
                                                                @endforeach

                                                            </select> --}}
                                                            {{-- <select id="choices-multiple-remove-button" placeholder="Select Service"
                                                                name="services[]" multiple>
                                                                @foreach ($services as $service)
                                                                    <option value="{{ $service->id }}" >{{ $service->service_name }}</option>
                                                                @endforeach
                                                            </select> --}}
                                                            <select multiple name="services[]" id="update-example-select"
                                                                placeholder="Select Services" data-search="false"
                                                                data-silent-initial-value-set="true">

                                                                @foreach ($services as $service)
                                                                    <option value="{{ $service->id }}">
                                                                        {{ $service->service_name }}</option>
                                                                @endforeach

                                                            </select>
                                                            <div class="invalid-feedback">Please select a client</div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Status</label>
                                                            <select class="form-select" name="update-event-status"
                                                                id="update-event-status" required>
                                                                <option value="Booked">Booked</option>
                                                                <option value="Arrived">Arrived</option>
                                                                <option value="Confirmed">Confirmed</option>
                                                                <option value="Started">Started</option>
                                                                <option value="Completed">Completed</option>
                                                            </select>

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="event-location">Location</label>
                                                            <div>
                                                                <input type="text" class="form-control"
                                                                    name="event-location" id="update-event-location"
                                                                    placeholder="Event location">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Description</label>
                                                            <textarea class="form-control " id="update-event-description" placeholder="Enter a description" rows="3"
                                                                spellcheck="false"></textarea>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->
                                                <div class="hstack gap-2 justify-content-end w-100"
                                                    id="update-event-btn-div" style="display: none">
                                                    <button type="button" class="btn btn-soft-danger"
                                                        id="btn-delete-event"><i class="ri-close-line align-bottom"></i>
                                                        Delete</button>
                                                    <button type="submit" class="btn btn-success"
                                                        id="update-btn-save-event">Update
                                                        appointment </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- end modal-content-->
                            </div> <!-- end modal dialog-->
                        </div>
                        <!-- end modal-->
                        <!-- end modal-->
                    </div>
                </div> <!-- end row-->

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
    <!-- end main content-->




@endsection
@section('bottom-scripts')
    <!-- calendar min js -->
    {{-- <script src="{{ asset('dash-assets/libs/fullcalendar/index.global.min.js') }}"></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales-all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales-all.min.js"></script>

    <!-- App js -->
    <script src="{{ asset('dash-assets/js/app.js') }}"></script>
    <script src="{{ asset('virtual-select-master/dist/virtual-select.min.js') }}"></script>
    <!-- Calendar init -->
    {{-- <script src="{{asset('dash-assets/js/pages/calendar.init.js')}}"></script> --}}
    {{-- <script src="{{asset('dash-assets/js/calendar.js')}}"></script> --}}
    {{-- <script src="{{asset('dash-assets/js/pages/calendar-format.js')}}"></script> --}}

    <!-- JAVASCRIPT -->
    {{-- <script src="{{asset('dash-assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('dash-assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('dash-assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{asset('dash-assets/libs/feather-icons/feather.min.js')}}"></script>
        <script src="{{asset('dash-assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
        <script src="{{asset('dash-assets/js/plugins.js')}}"></script> --}}
    <script src="{{ asset('dash-assets/js/flatpickr.min.js') }}"></script>
    <script src="{{ asset('dash-assets/js/choices.min.js') }}"></script>
    {{-- <script src="{{ asset('back/assets/js/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('back/assets/js/datatable/js/dataTables.bootstrap5.min.js') }}"></script> --}}

    {{-- <script>
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
    </script> --}}




    <!-- Include necessary libraries -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script>
        $(document).ready(function() {
            var teamMembers = @json($team_members);
            var clients = @json($clients);
            var services = @json($services);

            $('#calendar').fullCalendar({
                editable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                dateClick: function(info) {
                    $('#event-modal').modal('show');
                    $('#event-start-date').val(info.dateStr);
                }
            });

            flatpickr("#event-start-date", {
                enableTime: false,
                dateFormat: "Y-m-d"
            });

            flatpickr("#timepicker1", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true
            });

            flatpickr("#timepicker2", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true
            });

            // Populate the team members, clients, and services fields dynamically
            function populateOptions(selectElement, data, key, value) {
                $(selectElement).empty();
                $(selectElement).append('<option disabled>Select</option>');
                data.forEach(function(item) {
                    $(selectElement).append('<option value="' + item[key] + '">' + item[value] + '</option>');
                });
            }

            populateOptions('#event-member', teamMembers, 'id', 'name');
            populateOptions('#event-client', clients, 'user_id', 'name');
            populateOptions('#choices-multiple-remove-button', services, 'id', 'service_name');

            // Handle form submission
            $('#form-event').on('submit', function(event) {
                event.preventDefault();
                var title = $('#event-title').val();
                var start = $('#event-start-date').val() + 'T' + $('#timepicker1').val();
                var end = $('#event-start-date').val() + 'T' + $('#timepicker2').val();
                var description = $('#event-description').val();
                var location = $('#event-location').val();
                var category = $('#event-category').val();

                $('#calendar').fullCalendar('renderEvent', {
                    title: title,
                    start: start,
                    end: end,
                    description: description,
                    location: location,
                    className: category
                }, true);

                $('#event-modal').modal('hide');
            });

            // Show form fields on modal show
            $('#event-modal').on('show.bs.modal', function (e) {
                $('.d-none').removeClass('d-none');
            });

            // Hide form fields on modal hide
            $('#event-modal').on('hide.bs.modal', function (e) {
                $('#form-event')[0].reset();
                $('#form-event .d-none').addClass('d-none');
            });
        });
    </script> --}}


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            VirtualSelect.init({
                ele: '#example-select',
                search: true,
                multiple: true,
            });

            VirtualSelect.init({
                ele: '#update-example-select',
                search: true,
                multiple: true,
                silentInitialValueSet: true
            });
            var teamMembers = @json($team_members);
            var clients = @json($clients);
            var services = @json($services);

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                editable: true,
                eventResizableFromStart: true,
                events: {
                    url: '{{ route('appointments') }}',
                    method: 'GET',
                    failure: function() {
                        alert('there was an error while fetching events!');
                    },
                    success: function(data) {
                        // console.log(data); // For debugging purposes
                    }
                },

                dateClick: function(info) {
                    // populateOptions('#event-member', teamMembers, 'id', 'name');
                    // populateOptions('#event-client', clients, 'id', 'name');
                    // populateOptions('#choices-multiple-remove-button', services, 'id', 'service_name');
                    // populateOptions('#event-services', services, 'id', 'service_name');
                    $('#event-modal').modal('show');
                    $('#event-start-date').val(info.dateStr);
                },
                eventClick: function(info) {
                    // Populate the event details modal with info from the clicked event
                    console.log("start date" + info.event.start)
                    console.log("end date" + info.event.end)
                    console.log(info.event.extendedProps.status)
                    $('#eventId').val(info.event.id);
                    $('#update-event-category').val(info.event.classNames[0]);
                    $('#update-event-title').val(info.event.title);
                    $('#update-event-start-date').val(info.event.start.toISOString().slice(0, 10));

                    // Extract and format the time portion properly
                    let startTime = info.event.start.toTimeString().slice(0, 5);
                    let endTime = info.event.end ? info.event.end.toTimeString().slice(0, 5) : '';
                    $('#update-timepicker1').val(startTime);
                    $('#update-timepicker2').val(endTime);
                    // $('#update-timepicker1').val(info.event.start.toISOString().slice(11, 16));
                    // $('#update-timepicker2').val(info.event.end ? info.event.end.toISOString().slice(11, 16) : '');
                    $('#update-event-location').val(info.event.extendedProps.location);
                    $('#update-event-description').val(info.event.extendedProps.description);
                    $('#update-event-member').val(info.event.extendedProps.team_member.id);
                    $('#update-event-client').val(info.event.extendedProps.client.id);
                    $('#update-event-status').val(info.event.extendedProps.status);

                    // flatpickr("#update-timepicker1").destroy();
                    flatpickr("#update-timepicker1", {
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                        time_24hr: true,
                        defaultDate: startTime
                    });

                    // flatpickr("#update-timepicker2").destroy();
                    flatpickr("#update-timepicker2", {
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                        time_24hr: true,
                        idefaultDate: endTime
                    });

                    // info.event.extendedProps.services.forEach(function(service) {
                    //     // Assuming service ID is stored in 'service.id'
                    //     console.log(service.service_id)
                    //     $('#choices-multiple-remove-button').val(service.service_id).trigger('change');
                    // });
                    const selectedServiceIds = info.event.extendedProps.services.map(service => service
                        .service_id);
                    // Clear existing values and set new values
                    const selectBox = document.querySelector('#update-example-select');
                    VirtualSelect.init({
                        ele: selectBox,
                        search: true,
                        multiple: true,
                        silentInitialValueSet: true
                    });
                    selectBox.setValue(selectedServiceIds);

                    $('#event-start-date-tag').text(info.event.start.toLocaleString());
                    $('#event-timepicker1-tag').text(info.event.start.toLocaleTimeString());
                    $('#event-timepicker2-tag').text(info.event.end.toLocaleTimeString());
                    $('#event-location-tag').text(info.event.extendedProps.location);
                    $('#event-description-tag').text(info.event.extendedProps.description);

                    $('#event-details-modal').modal('show');

                    $('#event-details2').removeClass('d-none');
                    $('#event-details-modal').find('.event-form').css('display', 'none');
                    $('#event-details-modal').find('#modal-title').text('Edit Event');
                    $('#update-event-btn-div').css('display', 'none');
                },
                eventDrop: function(info) {
                    updateEvent(info.event);
                },
                eventResize: function(info) {
                    updateEvent(info.event);
                }
            });

            calendar.render();

            flatpickr("#event-start-date", {
                enableTime: false,
                dateFormat: "Y-m-d"
            });

            flatpickr("#timepicker1", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true
            });

            flatpickr("#timepicker2", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true
            });

            flatpickr("#update-event-start-date", {
                enableTime: false,
                dateFormat: "Y-m-d"
            });

            // Populate the team members, clients, and services fields dynamically
            function populateOptions(selectElement, data, key, value) {
                $(selectElement).empty();
                $(selectElement).append('<option disabled>Select</option>');
                data.forEach(function(item) {
                    $(selectElement).append('<option value="' + item[key] + '">' + item[value] +
                        '</option>');
                });
            }



            // Handle create event
            $('#form-event').on('submit', function(event) {
                event.preventDefault();
                var title = $('#event-title').val();
                var start = $('#event-start-date').val() + 'T' + $('#timepicker1').val();
                var end = $('#event-start-date').val() + 'T' + $('#timepicker2').val();
                var description = $('#event-description').val();
                var location = $('#event-location').val();
                var category = $('#event-category').val();
                var services = $('#example-select').val();
                var team_member = $('#event-member').val();
                var client = $('#event-client').val();

                // console.log(event_title);
                if (title == '' || start == '' || end == '' || description == '' || location == '' ||
                    category == '' || services == '' || team_member == '' || client == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please fill all fields!',
                    })
                    // return;
                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('calendar.store') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            title: title,
                            start: start,
                            end: end,
                            description: description,
                            location: location,
                            color: category,
                            services: services,
                            team_member_id: team_member,
                            client_id: client
                        },
                        success: function(response) {
                            if (response.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                })

                                console.log('title ' + title, 'start ' + start, 'end ' + end,
                                    'description ' + description, 'location ' + location,
                                    'category ' + category, 'services ' + services,
                                    'team_member ' + team_member, 'client ' + client);
                                calendar.addEvent({
                                    id: response.event.id,
                                    title: title,
                                    start: start,
                                    end: end,
                                    description: description,
                                    location: location,
                                    className: category,
                                    services: response.event.services,
                                    team_member: response.event.team_member,
                                    client: response.event.client,
                                    status: response.event.status
                                });
                            }
                        },

                    });
                    $('#event-modal').modal('hide');
                }


            });
            // Handle update event
            $('#update-btn-save-event').on('click', function(event) {
                event.preventDefault();
                var title = $('#update-event-title').val();
                var start = $('#update-event-start-date').val() + 'T' + $('#update-timepicker1').val();
                var end = $('#update-event-start-date').val() + 'T' + $('#update-timepicker2').val();
                var description = $('#update-event-description').val();
                var location = $('#update-event-location').val();
                var category = $('#update-event-category').val();
                var services = $('#update-example-select').val();
                var team_member = $('#update-event-member').val();
                var client = $('#update-event-client').val();
                var eventId = $('#eventId').val();
                var status = $('#update-event-status').val();

                // console.log(eventId);
                // return;
                if (title == '' || start == '' || end == '' || description == '' || location == '' ||
                    category == '' || services == '' || team_member == '' || client == '' || eventId ==
                    '' || status == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please fill all fields!',
                    })
                    // return;
                } else {
                    $.ajax({
                        type: "PUT",
                        url: "/appointments/" + eventId,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            title: title,
                            start: start,
                            end: end,
                            description: description,
                            location: location,
                            color: category,
                            services: services,
                            team_member_id: team_member,
                            client_id: client,
                            status: status
                        },
                        success: function(response) {
                            if (response.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                })

                                let updatedEvent = calendar.getEventById(eventId);
                                if (updatedEvent) {
                                    updatedEvent.setProp('title', title);
                                    updatedEvent.setStart(start);
                                    updatedEvent.setEnd(end);
                                    updatedEvent.setExtendedProp('location', location);
                                    updatedEvent.setExtendedProp('description', description);
                                    updatedEvent.setExtendedProp('services', response.event
                                        .services);
                                    updatedEvent.setExtendedProp('team_member', response.event
                                        .team_member);
                                    updatedEvent.setExtendedProp('client', response.event
                                        .client);
                                    updatedEvent.setExtendedProp('status', response.event
                                        .status);

                                    // Remove old class and add new class for category
                                    updatedEvent.setProp('classNames', [category]);

                                    // Optionally, rerender the event
                                    // updatedEvent.render();
                                }
                            }
                        },

                    });
                    $('#event-details-modal').modal('hide');
                }


            });
            // Handle delete event
            $('#btn-delete-event').on('click', function(event) {
                event.preventDefault();
                var eventId = $('#eventId').val();

                if (eventId == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Some problem with this event!',
                    })
                } else {

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
                                type: "DELETE",
                                url: "/appointments/" + eventId,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                success: function(response) {
                                    if (response.status) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: response.message,
                                            showConfirmButton: false,
                                            timer: 1500
                                        })

                                        let event = calendar.getEventById(eventId);
                                        if (event) {
                                            event.remove();
                                        }
                                    }
                                },

                            });
                            $('#event-details-modal').modal('hide');
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            Swal.fire(
                                'Cancelled',
                                'Your record is safe :)',
                                'error'
                            )
                        }
                    })
                }


            });

            // Show form fields on modal show
            $('#event-modal').on('show.bs.modal', function(e) {
                // populateOptions('#choices-multiple-remove-button', services, 'id', 'service_name');
                $('.d-none').removeClass('d-none');
            });

            // Hide form fields on modal hide
            $('#event-modal').on('hide.bs.modal', function(e) {
                $('#form-event')[0].reset();
                $('#form-event .d-none').addClass('d-none');
            });

            // // Edit event
            $('#edit-event-btn').on('click', function() {

                $('#event-details2').addClass('d-none');
                $('#event-details-modal').find('#event-details2').addClass('d-none');
                $('#event-details-modal').find('.event-form').css('display', 'block');
                $('#event-details-modal').find('#modal-title').text('Edit Event');

                $('#event-details-modal').find('#update-event-btn-div').css('display', 'block');
            });

            function updateEvent(event) {
                console.log(event);
                // return;
                var eventId = event.id;
                var start = event.start.toISOString();
                var end = event.end ? event.end.toISOString() :
                    start; // In case the end date is not provided, use the start date

                $.ajax({
                    type: "PUT",
                    url: "/appointments/" + eventId,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        start: start,
                        end: end
                    },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'An error occurred while updating the event.',
                        })
                    }
                });
            }

        });
    </script>

@endsection
