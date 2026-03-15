@extends('admin.layout.app')
@section('title', 'Update Plan Services')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Update Plan Services</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <form action="{{ route('plan_services.update', $planService?->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            name="name" id="name" placeholder="Plan Service name "
                                            value="{{ old('name', $planService->name ?? '') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="plan_id">Select Plan</label>
                                        <select name="plan_id" id="plan_id"
                                            class="form-control {{ $errors->has('plan_id') ? 'is-invalid' : '' }}">
                                            <option value="">Select a plan</option>
                                            @foreach ($plans as $plan)
                                                <option value="{{ $plan->id }}"
                                                    {{ old('plan_id', $planService->plan_id ?? '') == $plan->id ? 'selected' : '' }}>
                                                    {{ $plan->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('plan_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success add-btn rounded-3 me-2">Submit</button>
                            <a href="{{ route('plan_services.index') }}" class="btn cancel-btn">Back</a>
                        </form>

                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
@endsection
