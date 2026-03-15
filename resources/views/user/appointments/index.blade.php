@extends('user.layouts.app')

@section('title', 'Shop Details')
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h2 class="text-center mb-5 mt-3">Appointments</h2>
                <div class="row row-cols-1 row-cols-md-2 g-4 mb-5">
                    {{-- @foreach ($appointments as $appointment)
                        <?php

                        $carbonDate = \Carbon\Carbon::parse($appointment->start);

                        $formattedDate = $carbonDate->format('j M Y \a\t g:ia'); // Example: "6 Jun 2024 at 11:30am"
                        // dd($appointment->userCreatedBy->businessUser->images[0]['image']);
                        ?>
                        <div class="col">
                            <div class="card mb-3" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="{{isset($appointment->userCreatedBy->businessUser->images[0]) ? asset('storage/'.$appointment->userCreatedBy->businessUser->images[0]['image']) : asset('assets/images/shope.png')}}" class="img-fluid rounded-start" alt="No Image found">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title d-flex justify-content-between"><span>{{$appointment->title ?? ''}}</span> <span class="badge rounded-pill text-bg-primary">{{$appointment->status ?? ''}}</span></h5>
                                            <p class="card-text"> <i class="bi bi-alarm me-2"></i> <span>{{$formattedDate ?? ''}}</span></p>
                                            <div class="d-flex justify-content-between">
                                                <p class="card-text"><small class="text-body-secondary">AED {{$appointment->grand_total ?? ''}} . {{count($appointment->services)}} item</small></p>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach --}}

                    @forelse ($appointments as $appointment)
                        <?php
                        $carbonDate = \Carbon\Carbon::parse($appointment->start);
                        $formattedDate = $carbonDate->format('j M Y \a\t g:ia');

                        $carbonEndDate = \Carbon\Carbon::parse($appointment->end);
                        $currentDate = \Carbon\Carbon::now();
                        $diffInDays = $carbonEndDate->diffInDays($currentDate, false); // false to get negative values if end date is in the past
                        ?>
                        <div class="col">
                            <div class="card mb-3" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="{{ isset($appointment->userCreatedBy->businessUser->images[0]) ? asset('storage/' . $appointment->userCreatedBy->businessUser->images[0]['image']) : asset('assets/images/shope.png') }}"
                                            class="img-fluid rounded-start" alt="No Image found">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title d-flex justify-content-between">
                                                <span>{{ $appointment->title ?? '' }}</span>
                                                <span
                                                    class="badge rounded-pill text-bg-primary">{{ $appointment->status ?? '' }}</span>
                                            </h5>
                                            <p class="card-text">
                                                <i class="bi bi-alarm me-2"></i>
                                                <span>{{ \Carbon\Carbon::parse($appointment->start)->format('j M Y \a\t g:ia') ?? '' }}</span>
                                            </p>
                                            <div class="d-flex justify-content-between">
                                                <p class="card-text">
                                                    <small class="text-body-secondary">AED
                                                        {{ $appointment->grand_total ?? '' }} .
                                                        {{ count($appointment->services) }} item</small>
                                                </p>
                                            </div>
                                            @if ($appointment->status != 'Completed')
                                                <div class="d-flex justify-content-end">
                                                    <form action="{{ route('appointment.cancel') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="appointment_id"
                                                            value="{{ $appointment->id ?? '' }}" />
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Are you sure to cancel ?')">
                                                            Cancel
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        No Record found.
                    @endforelse


                </div>

            </div>
        </div>
    </div>
@endsection
@section('top-scripts')


@endsection
