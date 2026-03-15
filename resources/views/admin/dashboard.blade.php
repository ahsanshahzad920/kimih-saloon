@php
    use Carbon\Carbon;
    use App\Models\Appointment;
    use App\Models\Service;
    use App\Models\Sale;
    use Illuminate\Support\Facades\Auth;
    use App\Models\SaleItem;
@endphp

@extends('admin.layout.app')
@section('title', 'Dashboard')
@section('style')
    <style>
        .ui-datepicker .ui-datepicker-header {
            background: white;
            border: none;
        }
    </style>
    <style>
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
@section('content')
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col">

                        <div class="h-100">
                            <div class="row mb-3 pb-1">
                                <div class="col-12">
                                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                        <div class="flex-grow-1">
                                            <h4 class="fs-16 mb-1">Good Morning, Anna!</h4>
                                            <p class="text-muted mb-0">Here's what's happening with your store
                                                today.</p>
                                        </div>

                                    </div><!-- end card header -->
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->

                            <div class="row">
                                {{-- <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Total Earnings</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <h5 class="text-brand fs-14 mb-0">
                                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                                        +16.24 %
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 mb-lg-0">$<span
                                                            class="counter-value" data-target="559.25">0</span>k
                                                    </h4>

                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-success-subtle rounded fs-3">
                                                        <i class="bx bx-dollar-circle text-success"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col --> --}}

                                <div class="col-xl-6 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Appointments </p>
                                                </div>
                                                {{-- <div class="flex-shrink-0">
                                                    <h5 class="text-brand fs-14 mb-0">
                                                        <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                                        -3.57 %
                                                    </h5>
                                                </div> --}}
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 mb-lg-0"><span
                                                            class="counter-value"
                                                            data-target="{{ \App\Models\Appointment::where('created_by', auth()->id())->count() }}">0</span>
                                                    </h4>

                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-info-subtle rounded fs-3">
                                                        <i class="bx bx-shopping-bag text-info"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xl-6 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Customers</p>
                                                </div>
                                                {{-- <div class="flex-shrink-0">
                                                    <h5 class="text-brand fs-14 mb-0">
                                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                                        +29.08 %
                                                    </h5>
                                                </div> --}}
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 mb-lg-0"><span
                                                            class="counter-value"
                                                            data-target="{{ auth()->user()->clients->count() }}">0</span>
                                                    </h4>

                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-warning-subtle rounded fs-3">
                                                        <i class="bx bx-user-circle text-warning"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                {{-- <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        My Balance</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <h5 class="text-brand fs-14 mb-0">
                                                        +0.00 %
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 mb-lg-0">$<span
                                                            class="counter-value" data-target="165.89">0</span>k
                                                    </h4>

                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                        <i class="bx bx-wallet text-primary"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col --> --}}
                            </div> <!-- end row-->

                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="card">
                                        <div class="card-header border-0 align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Recent sales</h4>
                                        </div><!-- end card header -->

                                        {{-- <div class="card-header p-0 border-0 bg-light-subtle">
                                            <div class="row g-0 text-center">
                                                <div class="col-6 col-sm-3">
                                                    <div class="p-3 border border-dashed border-start-0">
                                                        <h5 class="mb-1">$<span class="counter-value"
                                                                data-target="22.89">0</span>k</h5>

                                                        <p class="text-muted mb-0">Sales</p>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-6 col-sm-3">
                                                    <div class="p-3 border border-dashed border-start-0">
                                                        <h5 class="mb-1"><span class="counter-value"
                                                                data-target="7585">0</span></h5>
                                                        <p class="text-muted mb-0">Appointments</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end card header -->

                                        <div class="card-body p-0 pb-2">
                                            <div class="w-100">
                                                <div id="chartData"
                                                    data-colors='["--vz-warning", "--vz-primary", "--vz-success"]'
                                                    class="apex-charts" dir="ltr"></div>
                                            </div>
                                        </div><!-- end card body --> --}}

                                        {{-- @php

                                            // Fetch sales data
                                            $salesData = Sale::selectRaw(
                                                'SUM(grand_total) as total, MONTH(created_at) as month',
                                            )
                                                ->where('created_by', Auth::id())
                                                ->groupBy('month')
                                                ->get()
                                                ->pluck('total', 'month')
                                                ->toArray();

                                            // Fetch appointments data
                                            $appointmentsData = Appointment::selectRaw(
                                                'COUNT(*) as total, MONTH(created_at) as month',
                                            )
                                                ->where('created_by', Auth::id())
                                                ->groupBy('month')
                                                ->get()
                                                ->pluck('total', 'month')
                                                ->toArray();

                                            $months = [];
                                            $sales = [];
                                            $appointments = [];

                                            for ($i = 1; $i <= 12; $i++) {
                                                $months[] = Carbon::create()->month($i)->format('F');
                                                $sales[] = $salesData[$i] ?? 0;
                                                $appointments[] = $appointmentsData[$i] ?? 0;
                                            }
                                        @endphp --}}

                                        @php

                                            // Check if the authenticated user is an admin
                                            $isAdmin = Auth::user()->hasRole('Admin');

                                            // Fetch sales data
                                            $salesQuery = Sale::selectRaw(
                                                'SUM(grand_total) as total, MONTH(created_at) as month',
                                            );
                                            if (!$isAdmin) {
                                                $salesQuery->where('created_by', Auth::id());
                                            }
                                            $salesData = $salesQuery
                                                ->groupBy('month')
                                                ->get()
                                                ->pluck('total', 'month')
                                                ->toArray();

                                            // Fetch appointments data
                                            $appointmentsQuery = Appointment::selectRaw(
                                                'COUNT(*) as total, MONTH(created_at) as month',
                                            );
                                            if (!$isAdmin) {
                                                $appointmentsQuery->where('created_by', Auth::id());
                                            }
                                            $appointmentsData = $appointmentsQuery
                                                ->groupBy('month')
                                                ->get()
                                                ->pluck('total', 'month')
                                                ->toArray();

                                            $months = [];
                                            $sales = [];
                                            $appointments = [];

                                            for ($i = 1; $i <= 12; $i++) {
                                                $months[] = Carbon::create()->month($i)->format('F');
                                                $sales[] = $salesData[$i] ?? 0;
                                                $appointments[] = $appointmentsData[$i] ?? 0;
                                            }
                                        @endphp


                                        <div class="card-header p-0 border-0 bg-light-subtle">
                                            <div class="row g-0 text-center">
                                                <div class="col-6 col-sm-3">
                                                    <div class="p-3 border border-dashed border-start-0">
                                                        <h5 class="mb-1">AED{{ number_format(array_sum($sales), 2) }}</h5>
                                                        <p class="text-muted mb-0">Sales</p>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-sm-3">
                                                    <div class="p-3 border border-dashed border-start-0">
                                                        <h5 class="mb-1">{{ array_sum($appointments) }}</h5>
                                                        <p class="text-muted mb-0">Appointments</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end card header -->

                                        <div class="card-body p-0 pb-2">
                                            <div class="w-100">
                                                <div id="chartData" class="apex-charts" dir="ltr">
                                                </div>
                                            </div>
                                        </div>




                                    </div><!-- end card -->
                                </div><!-- end col -->
                                <div class="col-xl-6">
                                    <div class="card card-height-100">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Upcoming appointments</h4>

                                        </div><!-- end card header -->

                                        <div class="card-body">
                                            @php
                                                $currentMonth = Carbon::now()->month;
                                                $lastMonth = Carbon::now()->subMonth()->month;

                                                $todayStart = Carbon::now()->startOfDay();

                                                $todayEnd = Carbon::now()->endOfDay();

                                                $tomorrowStart = Carbon::now()->addDay()->startOfDay();

                                                $tomorrowEnd = Carbon::now()->addDay()->endOfDay();

                                                $bookings = Appointment::where(function ($query) use (
                                                    $todayStart,
                                                    $tomorrowEnd,
                                                    $todayEnd,
                                                    $tomorrowStart,
                                                ) {
                                                    $query
                                                        ->whereBetween('start', [$todayStart, $todayEnd])
                                                        ->orWhereBetween('start', [$tomorrowStart, $tomorrowEnd]);
                                                })
                                                    ->where('created_by', Auth::id())
                                                    ->with('services.service')
                                                    ->get();

                                                // dd($bookings);

                                            @endphp
                                            <div class="table-responsive table-card">
                                                <table
                                                    class="table table-centered table-hover align-middle table-nowrap mb-0">
                                                    <tbody>
                                                        @forelse ($bookings as $booking)
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex-shrink-0 me-2">
                                                                            <h6 class="mb-0">
                                                                                {{ $booking->start ? \Carbon\Carbon::parse($booking->start)->format('j M') : '' }}
                                                                            </h6>
                                                                        </div>
                                                                        <div>
                                                                            <h5 class="fs-18 my-1 fw-medium"><a
                                                                                    href="" class="text-reset">
                                                                                    {{ $booking->client->name ?? '' }}
                                                                                </a>
                                                                            </h5>
                                                                        </div>
                                                                </td>
                                                                <td>
                                                                    <span class="text-muted">
                                                                        {{ $booking->start ? \Carbon\Carbon::parse($booking->start)->format('D, j M Y g:ia') : '' }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    @if (!is_null($booking->services))
                                                                        @foreach ($booking->services as $service)
                                                                            <p class="mb-0">
                                                                                {{ $service->service->service_name ?? '' }}
                                                                            </p>
                                                                            <span class="text-muted">
                                                                                {{ $service->service->service_type ?? '' }}
                                                                            </span>
                                                                        @endforeach
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <span class="text-muted">
                                                                        AED{{ $booking->grand_total ?? '' }}
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="4" class="text-center">No Record found.</td>
                                                            </tr>
                                                        @endforelse

                                                    </tbody>
                                                </table><!-- end table -->
                                            </div>

                                            {{-- <div
                                                class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                                                <div class="col-sm">
                                                    <div class="text-muted">
                                                        Showing <span class="fw-semibold">5</span> of <span
                                                            class="fw-semibold">25</span> Results
                                                    </div>
                                                </div>
                                                <div class="col-sm-auto  mt-3 mt-sm-0">
                                                    <ul
                                                        class="pagination pagination-separated pagination-sm mb-0 justify-content-center">
                                                        <li class="page-item disabled">
                                                            <a href="#" class="page-link">←</a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a href="#" class="page-link">1</a>
                                                        </li>
                                                        <li class="page-item active">
                                                            <a href="#" class="page-link">2</a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a href="#" class="page-link">3</a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a href="#" class="page-link">→</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div> --}}

                                        </div> <!-- .card-body-->
                                    </div> <!-- .card-->
                                </div> <!-- .col-->

                                <!-- end col -->
                            </div>

                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="card card-height-100">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Top services</h4>

                                        </div><!-- end card header -->
                                        @php
                                            $myServices = Service::where('created_by', auth()->id())->get();
                                            // Check if the authenticated user is an admin
                                            // $isAdmin = Auth::user()->hasRole('Admin');

                                            // // Fetch services data
                                            // $servicesQuery = Service::query();
                                            // if (!$isAdmin) {
                                            //     $servicesQuery->where('created_by', auth()->id());
                                            // }
                                            // $myServices = $servicesQuery->get();
                                        @endphp

                                        <div class="card-body">
                                            <div class="table-responsive table-card">
                                                <table
                                                    class="table table-centered table-hover align-middle table-nowrap mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Service</th>
                                                            <th>This month</th>
                                                            <th>Last month</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($myServices as $data)
                                                            <tr>
                                                                <td>{{ $data->service_name ?? '' }}</td>
                                                                <td>
                                                                    {{ SaleItem::where('item_id', $data->id)->where('type', 'service')->whereMonth('created_at', $currentMonth)->count() ?? 0 }}
                                                                </td>

                                                                <td>
                                                                    {{ SaleItem::where('item_id', $data->id)->where('type', 'service')->whereMonth('created_at', $lastMonth)->count() ?? 0 }}
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            No record found
                                                        @endforelse

                                                    </tbody>
                                                </table><!-- end table -->
                                            </div>



                                        </div> <!-- .card-body-->
                                    </div> <!-- .card-->
                                </div>
                                <div class="col-xl-6">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Team Member</h4>
                                            @php
                                                $teamMembers = auth()->user()->teamMember;
                                            @endphp
                                        </div><!-- end card header -->

                                        <div class="card-body">
                                            <div class="table-responsive table-card">
                                                <table
                                                    class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                                    <thead class="text-muted table-light">
                                                        <tr>
                                                            <th scope="col">ID</th>
                                                            <th scope="col">Customer</th>
                                                            <th scope="col">Job Title</th>
                                                            <th scope="col">Phone</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($teamMembers as $member)
                                                            <tr>
                                                                <td>
                                                                    <a href=""
                                                                        class="fw-medium link-primary">#{{ $member->id }}</a>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex-shrink-0 me-2">
                                                                            <img src="{{ asset($member->image) }}"
                                                                                alt=""
                                                                                class="avatar-xs rounded-circle" />
                                                                        </div>
                                                                        <div class="flex-grow-1">{{ $member->name ?? '' }}
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>{{ $member->job_title ?? '' }}</td>
                                                                <td>
                                                                    <h5 class="fs-14 fw-medium mb-0">
                                                                        {{ $member->phone ?? '' }}
                                                                    </h5>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <!-- end table -->
                                            </div>
                                        </div>
                                    </div> <!-- .card-->
                                </div> <!-- .col-->
                            </div> <!-- end row-->


                        </div> <!-- end .h-100-->

                    </div> <!-- end col -->

                   
                     <!-- end col -->
                </div>

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

    </div>
    <!-- end main content-->



@endsection

@section('bottom-scripts')

    <!-- apexcharts -->
    <script src="{{ asset('dash-assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <!-- Dashboard init -->
    <script src="{{ asset('dash-assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js')}}"></script>
    <script>
        var salesData = @json(array_values($salesData));
        var appointmentsData = @json(array_values($appointmentsData));
        var months = @json(array_keys($salesData));
    </script>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                chart: {
                    type: 'bar',
                    height: 350
                },
                series: [{
                    name: 'Sales',
                    data: @json($sales)
                }, {
                    name: 'Appointments',
                    data: @json($appointments)
                }],
                xaxis: {
                    categories: @json($months)
                },
                yaxis: {
                    title: {
                        text: 'Count'
                    }
                },
                colors: ['rgba(221,63,235,1)', 'rgba(58, 55, 236, 1)'],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val;
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chartData"), options);
            chart.render();
        });
    </script>



@endsection
