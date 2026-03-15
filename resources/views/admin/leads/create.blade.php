@extends('admin.layout.app')
@section('title', 'Create Lead')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Create Lead</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <form action="{{ route('leads.store') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}"
                                            name="first_name" id="first_name" placeholder="First Name"
                                            value="{{ old('first_name') }}">
                                        @error('first_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}"
                                            name="last_name" id="last_name" placeholder="Last Name"
                                            value="{{ old('last_name') }}">
                                        @error('last_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email"
                                            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                            name="email" id="email" placeholder="Email" value="{{ old('email') }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="phone">Phone (with country code)</label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                            name="phone" id="phone" placeholder="Phone" value="{{ old('phone') }}">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="address">Address</label>
                                <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" id="address" name="address"
                                    rows="3" placeholder="Address">{{ old('address') }}</textarea>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success add-btn rounded-3 me-2">Submit</button>
                            <a href="{{ route('leads.index') }}" class="btn cancel-btn">Back</a>
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
@endsection
