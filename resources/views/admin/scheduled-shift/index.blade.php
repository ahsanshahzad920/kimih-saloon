@extends('admin.layout.app')
@section('title', 'Scheduled Shifts')
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
    {{-- <style>
        .schedule-table {
            width: 100%;
            table-layout: fixed;
        }

        .schedule-table th,
        .schedule-table td {
            border: 1px solid #ddd;
            text-align: center;
            vertical-align: middle;
        }

        .schedule-table th {
            background-color: #f8f9fa;
        }

        .schedule-table td {
            height: 100px;
        }

        .team-member-name {
            width: 150px;
        }
    </style> --}}
@endsection
@section('content')


    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Scheduled Shift</h4>
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
                                        <a href="{{ route('team-members.create') }}" class="btn btn-success add-btn"> Add Member</a>
                                        {{-- <button class="btn btn-soft-danger" id="download-excel"> Export</button> --}}
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
                                            <th class="short">Team Member</th>
                                            <th>Monday</th>
                                            <th>Tuesday</th>
                                            <th>Wednesday</th>
                                            <th>Thursday</th>
                                            <th>Friday</th>
                                            <th>Saturday</th>
                                            <th>Sunday</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach ($teamMembers as $teamMember)
                                            <tr>
                                                <td>{{ $teamMember->name }}</td>
                                                @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                                    @php
                                                        $schedule = $teamMember->schedules->firstWhere(
                                                            'day_of_week',
                                                            $day,
                                                        );
                                                    @endphp
                                                    <td class="align-middle">
                                                        @if ($schedule)
                                                            <div class="" style="overflow: visible">
                                                                @if ($schedule->is_off)
                                                                    <a class="badge text-bg-info fs-6" role="button"
                                                                        id="dropdownMenuLink" data-bs-toggle="dropdown"
                                                                        aria-haspopup="true" aria-expanded="false">
                                                                        Off
                                                                    </a>
                                                                @else
                                                                    <a class="badge text-bg-info fs-6" role="button"
                                                                        id="dropdownMenuLink" data-bs-toggle="dropdown"
                                                                        aria-haspopup="true" aria-expanded="false">
                                                                        {{ \Carbon\Carbon::parse($schedule->start_time)->format('h:iA') }}
                                                                        -
                                                                        {{ \Carbon\Carbon::parse($schedule->end_time)->format('h:iA') }}
                                                                    </a>
                                                                @endif

                                                                <div class="dropdown-menu"
                                                                    aria-labelledby="dropdownMenuLink"
                                                                    data-day="{{$schedule->day_of_week}}"
                                                                    data-id="{{ $teamMember->id }}"
                                                                    data-start-time="{{$schedule->start_time}}"
                                                                    data-end-time="{{$schedule->end_time}}"
                                                                    data-shift-id="{{ $schedule->id }}">
                                                                    <a href="#" class=" dropdown-item editShift"
                                                                        style="cursor: pointer">
                                                                        <i class="fa fa-pencil text-warning me-2"></i>
                                                                        Edit Shift
                                                                    </a>
                                                                    <a href="javascript:void(0);" class="dropdown-item">
                                                                        <i class="fa fa-trash text-danger"></i>
                                                                        <button class="btn btn-sm delSiftBtn">
                                                                            Delete Shift
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <button class="btn btn-sm save-btn addShift"
                                                                data-bs-target="#exampleModalToggle" data-bs-toggle="modal"
                                                                data-day="{{ $day }}"
                                                                data-id="{{ $teamMember->id }}">Add Shift
                                                            </button>
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>


                            </div>
                            {{-- <div class="table-responsive table-card mt-3 mb-1">
                                <div class="alert alert-danger p-2 text-end" id="deletedAlert" style="display: none">
                                    <div style="display: flex;justify-content:space-between">
                                        <span><span id="deleteRowCount">0</span> rows selected</span>
                                        <button class="btn btn-sm btn-danger" id="deleteRowTrigger">Delete</button>
                                    </div>
                                </div>
                                <table class="table align-middle table-nowrap" id="example">
                                    <thead class="table-light">
                                        <tr>

                                            <th class="short">Team Member</th>
                                            @foreach (range(0, 6) as $day)
                                                <th>{{ $startOfWeek->copy()->addDays($day)->format('D, j M') }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach ($teamMembers as $teamMember)
                                            <tr>
                                                <td class="team-member-name">{{ $teamMember->name }}</td>
                                                @foreach (range(0, 6) as $day)
                                                    @php
                                                        $currentDate = $startOfWeek->copy()->addDays($day);

                                                        $date = DateTime::createFromFormat('Y-m-d H:i:s', $currentDate);
                                                        $formattedDate = $date->format('Y-m-d');
                                                        $shift = $teamMember->shifts->firstWhere(
                                                            'shift_date',
                                                            $currentDate->toDateString(),
                                                        );
                                                    @endphp
                                                    <td>
                                                        @if ($shift)
                                                        <div class="" style="overflow: visible">
                                                            <a class="badge text-bg-info fs-6" role="button"
                                                                id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                {{ $shift->pivot->start_time }} - {{ $shift->pivot->end_time }}
                                                            </a>

                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" data-current-date="{{$formattedDate}}" data-id="{{$teamMember->id}}"
                                                                data-start-time="{{$shift->pivot->start_time}}" data-end-time="{{$shift->pivot->end_time}}" data-shift-id="{{$shift->id}}">
                                                                <a href="#" class=" dropdown-item editShift" style="cursor: pointer">
                                                                    <i class="fa fa-pencil text-warning me-2"></i>
                                                                    Edit Shift
                                                                </a>
                                                                <a href="javascript:void(0);" class="dropdown-item">
                                                                    <i class="fa fa-trash text-danger"></i>
                                                                    <button class="btn btn-sm delSiftBtn" >
                                                                        Delete Shift
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        </div>

                                                        @else
                                                            <button class="btn btn-sm save-btn addShift"
                                                                data-bs-target="#exampleModalToggle"
                                                                data-bs-toggle="modal" data-current-data="{{$formattedDate}}" data-id="{{$teamMember->id}}" >Add Shift</button>
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>


                            </div> --}}

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
                    <h3 class="   pb-2 mb-0" style="width: 57%;">
                        Add Shifts
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-6 col-md-6">
                                <div class="form-group">
                                    <label for="start_time">Start Time</label>
                                    <select id="start_time" name="start_time" class="form-control">
                                        <option value="12:00am">12:00am</option>
                                        <option value="12:05am">12:05am</option>
                                        <option value="12:10am">12:10am</option>
                                        <option value="12:15am">12:15am</option>
                                        <option value="12:20am">12:20am</option>
                                        <option value="12:25am">12:25am</option>
                                        <option value="12:30am">12:30am</option>
                                        <option value="12:35am">12:35am</option>
                                        <option value="12:40am">12:40am</option>
                                        <option value="12:45am">12:45am</option>
                                        <option value="12:50am">12:50am</option>
                                        <option value="12:55am">12:55am</option>
                                        <option value="1:00am">1:00am</option>
                                        <option value="1:05am">1:05am</option>
                                        <option value="1:10am">1:10am</option>
                                        <option value="1:15am">1:15am</option>
                                        <option value="1:20am">1:20am</option>
                                        <option value="1:25am">1:25am</option>
                                        <option value="1:30am">1:30am</option>
                                        <option value="1:35am">1:35am</option>
                                        <option value="1:40am">1:40am</option>
                                        <option value="1:45am">1:45am</option>
                                        <option value="1:50am">1:50am</option>
                                        <option value="1:55am">1:55am</option>
                                        <option value="2:00am">2:00am</option>
                                        <option value="2:05am">2:05am</option>
                                        <option value="2:10am">2:10am</option>
                                        <option value="2:15am">2:15am</option>
                                        <option value="2:20am">2:20am</option>
                                        <option value="2:25am">2:25am</option>
                                        <option value="2:30am">2:30am</option>
                                        <option value="2:35am">2:35am</option>
                                        <option value="2:40am">2:40am</option>
                                        <option value="2:45am">2:45am</option>
                                        <option value="2:50am">2:50am</option>
                                        <option value="2:55am">2:55am</option>
                                        <option value="3:00am">3:00am</option>
                                        <option value="3:05am">3:05am</option>
                                        <option value="3:10am">3:10am</option>
                                        <option value="3:15am">3:15am</option>
                                        <option value="3:20am">3:20am</option>
                                        <option value="3:00am">3:25am</option>
                                        <option value="3:30am">3:30am</option>
                                        <option value="3:35am">3:35am</option>
                                        <option value="3:40am">3:40am</option>
                                        <option value="3:45am">3:45am</option>
                                        <option value="3:50am">3:50am</option>
                                        <option value="3:55am">3:55am</option>
                                        <option value="4:00am">4:00am</option>
                                        <option value="4:05am">4:05am</option>
                                        <option value="4:10am">4:10am</option>
                                        <option value="4:15am">4:15am</option>
                                        <option value="4:20am">4:20am</option>
                                        <option value="4:25am">4:25am</option>
                                        <option value="4:30am">4:30am</option>
                                        <option value="4:35am">4:35am</option>
                                        <option value="4:40am">4:40am</option>
                                        <option value="4:45am">4:45am</option>
                                        <option value="4:50am">4:50am</option>
                                        <option value="4:55am">4:55am</option>
                                        <option value="5:00am">5:00am</option>
                                        <option value="5:30am">5:30am</option>
                                        <option value="6:00am">6:00am</option>
                                        <option value="6:30am">6:30am</option>
                                        <option value="7:00am">7:00am</option>
                                        <option value="7:30am">7:30am</option>
                                        <option value="8:00am">8:00am</option>
                                        <option value="8:30am">8:30am</option>
                                        <option value="9:00am">9:00am</option>
                                        <option value="9:30am">9:30am</option>
                                        <option value="10:00am" selected>10:00am</option>
                                        <option value="10:30am">10:30am</option>
                                        <option value="11:00am">11:00am</option>
                                        <option value="11:30am">11:30am</option>
                                        <option value="12:00pm">12:00pm</option>
                                        <option value="12:30pm">12:30pm</option>
                                        <option value="1:00pm">1:00pm</option>
                                        <option value="1:30pm">1:30pm</option>
                                        <option value="2:00pm">2:00pm</option>
                                        <option value="2:30pm">2:30pm</option>
                                        <option value="3:00pm">3:00pm</option>
                                        <option value="4:00pm">4:00pm</option>
                                        <option value="4:30pm">4:30pm</option>
                                        <option value="5:00pm">5:00pm</option>
                                        <option value="5:30pm">5:30pm</option>
                                        <option value="6:00pm">6:00pm</option>
                                        <option value="6:30pm">6:30pm</option>
                                        <option value="7:00pm">7:00pm</option>
                                        <option value="8:00pm">8:00pm</option>
                                        <option value="9:05pm">9:00pm</option>
                                        <option value="10:00pm">10:00pm</option>
                                        <option value="11:00pm">11:00pm</option>
                                        <option value="11:55pm">11:55pm</option>
                                    </select>
                                    {{-- <input type="hidden" name="shift_date"> --}}
                                    <input type="hidden" name="day_of_week" id="day_of_week">
                                </div>
                            </div>
                            <div class="col-6 col-md-6">
                                <div class="form-group">
                                    <label for="end_time">End Time</label>
                                    <select id="end_time" name="end_time" class="form-control">
                                        <option value="12:00am">12:00am</option>
                                        <option value="12:05am">12:05am</option>
                                        <option value="12:10am">12:10am</option>
                                        <option value="12:15am">12:15am</option>
                                        <option value="12:20am">12:20am</option>
                                        <option value="12:25am">12:25am</option>
                                        <option value="12:30am">12:30am</option>
                                        <option value="12:35am">12:35am</option>
                                        <option value="12:40am">12:40am</option>
                                        <option value="12:45am">12:45am</option>
                                        <option value="12:50am">12:50am</option>
                                        <option value="12:55am">12:55am</option>
                                        <option value="1:00am">1:00am</option>
                                        <option value="1:05am">1:05am</option>
                                        <option value="1:10am">1:10am</option>
                                        <option value="1:15am">1:15am</option>
                                        <option value="1:20am">1:20am</option>
                                        <option value="1:25am">1:25am</option>
                                        <option value="1:30am">1:30am</option>
                                        <option value="1:35am">1:35am</option>
                                        <option value="1:40am">1:40am</option>
                                        <option value="1:45am">1:45am</option>
                                        <option value="1:50am">1:50am</option>
                                        <option value="1:55am">1:55am</option>
                                        <option value="2:00am">2:00am</option>
                                        <option value="2:05am">2:05am</option>
                                        <option value="2:10am">2:10am</option>
                                        <option value="2:15am">2:15am</option>
                                        <option value="2:20am">2:20am</option>
                                        <option value="2:25am">2:25am</option>
                                        <option value="2:30am">2:30am</option>
                                        <option value="2:35am">2:35am</option>
                                        <option value="2:40am">2:40am</option>
                                        <option value="2:45am">2:45am</option>
                                        <option value="2:50am">2:50am</option>
                                        <option value="2:55am">2:55am</option>
                                        <option value="3:00am">3:00am</option>
                                        <option value="3:05am">3:05am</option>
                                        <option value="3:10am">3:10am</option>
                                        <option value="3:15am">3:15am</option>
                                        <option value="3:20am">3:20am</option>
                                        <option value="3:00am">3:25am</option>
                                        <option value="3:30am">3:30am</option>
                                        <option value="3:35am">3:35am</option>
                                        <option value="3:40am">3:40am</option>
                                        <option value="3:45am">3:45am</option>
                                        <option value="3:50am">3:50am</option>
                                        <option value="3:55am">3:55am</option>
                                        <option value="4:00am">4:00am</option>
                                        <option value="4:05am">4:05am</option>
                                        <option value="4:10am">4:10am</option>
                                        <option value="4:15am">4:15am</option>
                                        <option value="4:20am">4:20am</option>
                                        <option value="4:25am">4:25am</option>
                                        <option value="4:30am">4:30am</option>
                                        <option value="4:35am">4:35am</option>
                                        <option value="4:40am">4:40am</option>
                                        <option value="4:45am">4:45am</option>
                                        <option value="4:50am">4:50am</option>
                                        <option value="4:55am">4:55am</option>
                                        <option value="5:00am">5:00am</option>
                                        <option value="5:30am">5:30am</option>
                                        <option value="6:00am">6:00am</option>
                                        <option value="6:30am">6:30am</option>
                                        <option value="7:00am" >7:00am</option>
                                        <option value="7:30am">7:30am</option>
                                        <option value="8:00am">8:00am</option>
                                        <option value="8:30am">8:30am</option>
                                        <option value="9:00am">9:00am</option>
                                        <option value="9:30am">9:30am</option>
                                        <option value="10:00am">10:00am</option>
                                        <option value="10:30am">10:30am</option>
                                        <option value="11:00am">11:00am</option>
                                        <option value="11:30am">11:30am</option>
                                        <option value="12:00pm">12:00pm</option>
                                        <option value="12:30pm">12:30pm</option>
                                        <option value="1:00pm">1:00pm</option>
                                        <option value="1:30pm">1:30pm</option>
                                        <option value="2:00pm">2:00pm</option>
                                        <option value="2:30pm">2:30pm</option>
                                        <option value="3:00pm">3:00pm</option>
                                        <option value="4:00pm">4:00pm</option>
                                        <option value="4:30pm">4:30pm</option>
                                        <option value="5:00pm">5:00pm</option>
                                        <option value="5:30pm">5:30pm</option>
                                        <option value="6:00pm">6:00pm</option>
                                        <option value="6:30pm">6:30pm</option>
                                        <option value="7:00pm" selected>7:00pm</option>
                                        <option value="8:00pm">8:00pm</option>
                                        <option value="9:00pm">9:00pm</option>
                                        <option value="10:00pm">10:00pm</option>
                                        <option value="11:00pm">11:00pm</option>
                                        <option value="11:55pm">11:55pm</option>
                                    </select>
                                    {{-- <input type="hidden" name="shift_date" id="shift_date"> --}}
                                    <input type="hidden" name="team_member_id" id="team_member_id">
                                </div>
                            </div>
                        </div>


                        <button class="btn btn btn-success add-btn mt-4" id="addBtn">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->


    <!-- Edit Modal STart -->
    <div class="modal fade" id="exampleModalToggleEdit" aria-hidden="true" aria-labelledby="exampleModalToggleEditLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h3 class="   pb-2 mb-0" style="width: 57%;">
                        Edit Shifts
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-6 col-md-6">
                                <div class="form-group">
                                    <label for="start_time">Start Time</label>
                                    <select id="edit_start_time" name="start_time" class="form-control">
                                        <option value="12:00am">12:00am</option>
                                        <option value="12:05am">12:05am</option>
                                        <option value="12:10am">12:10am</option>
                                        <option value="12:15am">12:15am</option>
                                        <option value="12:20am">12:20am</option>
                                        <option value="12:25am">12:25am</option>
                                        <option value="12:30am">12:30am</option>
                                        <option value="12:35am">12:35am</option>
                                        <option value="12:40am">12:40am</option>
                                        <option value="12:45am">12:45am</option>
                                        <option value="12:50am">12:50am</option>
                                        <option value="12:55am">12:55am</option>
                                        <option value="1:00am">1:00am</option>
                                        <option value="1:05am">1:05am</option>
                                        <option value="1:10am">1:10am</option>
                                        <option value="1:15am">1:15am</option>
                                        <option value="1:20am">1:20am</option>
                                        <option value="1:25am">1:25am</option>
                                        <option value="1:30am">1:30am</option>
                                        <option value="1:35am">1:35am</option>
                                        <option value="1:40am">1:40am</option>
                                        <option value="1:45am">1:45am</option>
                                        <option value="1:50am">1:50am</option>
                                        <option value="1:55am">1:55am</option>
                                        <option value="2:00am">2:00am</option>
                                        <option value="2:05am">2:05am</option>
                                        <option value="2:10am">2:10am</option>
                                        <option value="2:15am">2:15am</option>
                                        <option value="2:20am">2:20am</option>
                                        <option value="2:25am">2:25am</option>
                                        <option value="2:30am">2:30am</option>
                                        <option value="2:35am">2:35am</option>
                                        <option value="2:40am">2:40am</option>
                                        <option value="2:45am">2:45am</option>
                                        <option value="2:50am">2:50am</option>
                                        <option value="2:55am">2:55am</option>
                                        <option value="3:00am">3:00am</option>
                                        <option value="3:05am">3:05am</option>
                                        <option value="3:10am">3:10am</option>
                                        <option value="3:15am">3:15am</option>
                                        <option value="3:20am">3:20am</option>
                                        <option value="3:00am">3:25am</option>
                                        <option value="3:30am">3:30am</option>
                                        <option value="3:35am">3:35am</option>
                                        <option value="3:40am">3:40am</option>
                                        <option value="3:45am">3:45am</option>
                                        <option value="3:50am">3:50am</option>
                                        <option value="3:55am">3:55am</option>
                                        <option value="4:00am">4:00am</option>
                                        <option value="4:05am">4:05am</option>
                                        <option value="4:10am">4:10am</option>
                                        <option value="4:15am">4:15am</option>
                                        <option value="4:20am">4:20am</option>
                                        <option value="4:25am">4:25am</option>
                                        <option value="4:30am">4:30am</option>
                                        <option value="4:35am">4:35am</option>
                                        <option value="4:40am">4:40am</option>
                                        <option value="4:45am">4:45am</option>
                                        <option value="4:50am">4:50am</option>
                                        <option value="4:55am">4:55am</option>
                                        <option value="5:00am">5:00am</option>
                                        <option value="5:30am">5:30am</option>
                                        <option value="6:00am">6:00am</option>
                                        <option value="6:30am">6:30am</option>
                                        <option value="7:00am">7:00am</option>
                                        <option value="7:30am">7:30am</option>
                                        <option value="8:00am">8:00am</option>
                                        <option value="8:30am">8:30am</option>
                                        <option value="9:00am">9:00am</option>
                                        <option value="9:30am">9:30am</option>
                                        <option value="10:00am">10:00am</option>
                                        <option value="10:30am">10:30am</option>
                                        <option value="11:00am">11:00am</option>
                                        <option value="11:30am">11:30am</option>
                                        <option value="12:00pm">12:00pm</option>
                                        <option value="12:30pm">12:30pm</option>
                                        <option value="1:00pm">1:00pm</option>
                                        <option value="1:30pm">1:30pm</option>
                                        <option value="2:00pm">2:00pm</option>
                                        <option value="2:30pm">2:30pm</option>
                                        <option value="3:00pm">3:00pm</option>
                                        <option value="4:00pm">4:00pm</option>
                                        <option value="4:30pm">4:30pm</option>
                                        <option value="5:00pm">5:00pm</option>
                                        <option value="5:30pm">5:30pm</option>
                                        <option value="6:00pm">6:00pm</option>
                                        <option value="6:30pm">6:30pm</option>
                                        <option value="7:00pm">7:00pm</option>
                                        <option value="8:00pm">8:00pm</option>
                                        <option value="9:05pm">9:00pm</option>
                                        <option value="10:00pm">10:00pm</option>
                                        <option value="11:00pm">11:00pm</option>
                                        <option value="11:55pm">11:55pm</option>
                                    </select>
                                    {{-- <input type="hidden" name="shift_date"> --}}
                                </div>
                            </div>
                            <div class="col-6 col-md-6">
                                <div class="form-group">
                                    <label for="end_time">End Time</label>
                                    <select id="edit_end_time" name="end_time" class="form-control">
                                        <option value="12:00am">12:00am</option>
                                        <option value="12:05am">12:05am</option>
                                        <option value="12:10am">12:10am</option>
                                        <option value="12:15am">12:15am</option>
                                        <option value="12:20am">12:20am</option>
                                        <option value="12:25am">12:25am</option>
                                        <option value="12:30am">12:30am</option>
                                        <option value="12:35am">12:35am</option>
                                        <option value="12:40am">12:40am</option>
                                        <option value="12:45am">12:45am</option>
                                        <option value="12:50am">12:50am</option>
                                        <option value="12:55am">12:55am</option>
                                        <option value="1:00am">1:00am</option>
                                        <option value="1:05am">1:05am</option>
                                        <option value="1:10am">1:10am</option>
                                        <option value="1:15am">1:15am</option>
                                        <option value="1:20am">1:20am</option>
                                        <option value="1:25am">1:25am</option>
                                        <option value="1:30am">1:30am</option>
                                        <option value="1:35am">1:35am</option>
                                        <option value="1:40am">1:40am</option>
                                        <option value="1:45am">1:45am</option>
                                        <option value="1:50am">1:50am</option>
                                        <option value="1:55am">1:55am</option>
                                        <option value="2:00am">2:00am</option>
                                        <option value="2:05am">2:05am</option>
                                        <option value="2:10am">2:10am</option>
                                        <option value="2:15am">2:15am</option>
                                        <option value="2:20am">2:20am</option>
                                        <option value="2:25am">2:25am</option>
                                        <option value="2:30am">2:30am</option>
                                        <option value="2:35am">2:35am</option>
                                        <option value="2:40am">2:40am</option>
                                        <option value="2:45am">2:45am</option>
                                        <option value="2:50am">2:50am</option>
                                        <option value="2:55am">2:55am</option>
                                        <option value="3:00am">3:00am</option>
                                        <option value="3:05am">3:05am</option>
                                        <option value="3:10am">3:10am</option>
                                        <option value="3:15am">3:15am</option>
                                        <option value="3:20am">3:20am</option>
                                        <option value="3:00am">3:25am</option>
                                        <option value="3:30am">3:30am</option>
                                        <option value="3:35am">3:35am</option>
                                        <option value="3:40am">3:40am</option>
                                        <option value="3:45am">3:45am</option>
                                        <option value="3:50am">3:50am</option>
                                        <option value="3:55am">3:55am</option>
                                        <option value="4:00am">4:00am</option>
                                        <option value="4:05am">4:05am</option>
                                        <option value="4:10am">4:10am</option>
                                        <option value="4:15am">4:15am</option>
                                        <option value="4:20am">4:20am</option>
                                        <option value="4:25am">4:25am</option>
                                        <option value="4:30am">4:30am</option>
                                        <option value="4:35am">4:35am</option>
                                        <option value="4:40am">4:40am</option>
                                        <option value="4:45am">4:45am</option>
                                        <option value="4:50am">4:50am</option>
                                        <option value="4:55am">4:55am</option>
                                        <option value="5:00am">5:00am</option>
                                        <option value="5:30am">5:30am</option>
                                        <option value="6:00am">6:00am</option>
                                        <option value="6:30am">6:30am</option>
                                        <option value="7:00am">7:00am</option>
                                        <option value="7:30am">7:30am</option>
                                        <option value="8:00am">8:00am</option>
                                        <option value="8:30am">8:30am</option>
                                        <option value="9:00am">9:00am</option>
                                        <option value="9:30am">9:30am</option>
                                        <option value="10:00am">10:00am</option>
                                        <option value="10:30am">10:30am</option>
                                        <option value="11:00am">11:00am</option>
                                        <option value="11:30am">11:30am</option>
                                        <option value="12:00pm">12:00pm</option>
                                        <option value="12:30pm">12:30pm</option>
                                        <option value="1:00pm">1:00pm</option>
                                        <option value="1:30pm">1:30pm</option>
                                        <option value="2:00pm">2:00pm</option>
                                        <option value="2:30pm">2:30pm</option>
                                        <option value="3:00pm">3:00pm</option>
                                        <option value="4:00pm">4:00pm</option>
                                        <option value="4:30pm">4:30pm</option>
                                        <option value="5:00pm">5:00pm</option>
                                        <option value="5:30pm">5:30pm</option>
                                        <option value="6:00pm">6:00pm</option>
                                        <option value="6:30pm">6:30pm</option>
                                        <option value="7:00pm">7:00pm</option>
                                        <option value="8:00pm">8:00pm</option>
                                        <option value="9:05pm">9:00pm</option>
                                        <option value="10:00pm">10:00pm</option>
                                        <option value="11:00pm">11:00pm</option>
                                        <option value="11:55pm">11:55pm</option>
                                    </select>
                                    {{-- <input type="hidden" name="shift_date" id="edit_shift_date"> --}}
                                    <input type="hidden" name="edit_day_of_week" id="edit_day_of_week">
                                    <input type="hidden" name="team_member_id" id="edit_team_member_id">
                                    <input type="hidden" name="shift_id" id="schedule_id">
                                </div>
                            </div>
                        </div>


                        <button class="btn btn btn-success add-btn mt-4" id="editShiftBtn">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal End -->



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
                        url: `clients/${dataId}`,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            console.log(response)
                            if (response.status) {
                                Swal.fire({
                                    title: "Success!",
                                    text: response.message,
                                    icon: "success"
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


        $(document).on('click', '.addShift', function(e) {
            const dayOfWeek = $(this).data('day');
            const id = $(this).data('id');
            console.log('dayOfWeek:', id);
            $('#day_of_week').val(dayOfWeek);
            $('#team_member_id').val(id);
        });
        $(document).on('click', '.editShift', function(e) {
            // Get the parent dropdown menu
            const dropdownMenu = $(this).closest('.dropdown-menu');

            // Retrieve data attributes
            const day = dropdownMenu.data('day');
            const team_member_id = dropdownMenu.data('id');
            const start_time = dropdownMenu.data('start-time');
            const end_time = dropdownMenu.data('end-time');
            const schedule_id = dropdownMenu.data('shift-id');
            // console.log(day, team_member_id, start_time, end_time, schedule_id)
            // Convert start_time to the desired format (e.g., "10:00am")
            var formatted_start_time = convertTo12HourFormat(start_time);

            // Convert end_time to the desired format (e.g., "9:05pm")
            var formatted_end_time = convertTo12HourFormat(end_time);
            // Function to convert 24-hour time to 12-hour time
            function convertTo12HourFormat(time) {
                var [hours, minutes] = time.split(':');
                hours = parseInt(hours);
                var suffix = hours >= 12 ? 'pm' : 'am';
                hours = hours % 12 || 12; // Convert to 12-hour format
                return `${hours}:${minutes}${suffix}`;
            }

            $('#edit_day_of_week').val(day);
            $('#edit_team_member_id').val(team_member_id);
            $('#edit_start_time').val(formatted_start_time);
            $('#edit_end_time').val(formatted_end_time);
            $('#schedule_id').val(schedule_id);
            $('#exampleModalToggleEdit').modal('show');

        });

        $('#addBtn').on('click', function(e) {
            e.preventDefault();
            const data = {
                start_time: $('#start_time').val(),
                end_time: $('#end_time').val(),
                day_of_week: $('#day_of_week').val(),
                team_member_id: $('#team_member_id').val(),
            };
            console.log(data);
            $.ajax({
                url: "{{ route('scheduled-shifts.store') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                success: function(response) {
                    console.log(response)
                    if (response.status) {
                        Swal.fire({
                            title: "Success!",
                            text: response.message,
                            icon: "success"
                        });

                        // Refresh Data Table
                        $("#example").load(window.location + " #example");
                        $('#exampleModalToggle').modal('hide');
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
        });

        $('#editShiftBtn').on('click', function(e) {
            e.preventDefault();
            const data = {
                start_time: $('#edit_start_time').val(),
                end_time: $('#edit_end_time').val(),
                day_of_week: $('#edit_day_of_week').val(),
                team_member_id: $('#edit_team_member_id').val(),
                schedule_id: $('#schedule_id').val(),
            };
            console.log(data);
            $.ajax({
                url: `/scheduled-shifts/${data.schedule_id}`,
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                success: function(response) {
                    console.log(response)
                    if (response.status) {
                        Swal.fire({
                            title: "Success!",
                            text: response.message,
                            icon: "success"
                        });

                        // Refresh Data Table
                        $("#example").load(window.location + " #example");
                        $('#exampleModalToggleEdit').modal('hide');
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
        });

        $(document).on('click', '.delSiftBtn', function() {
            const dropdownMenu = $(this).closest('.dropdown-menu');
            const schedule_id = dropdownMenu.data('shift-id');
            // console.log(shift_id, id, shift_date);

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
                        url: `/scheduled-shifts/${schedule_id}`,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log(response)
                            if (response.status) {
                                Swal.fire({
                                    title: "Success!",
                                    text: response.message,
                                    icon: "success"
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
        })
    </script>
@endsection
