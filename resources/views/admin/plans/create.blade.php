@extends('admin.layout.app')
@section('title', 'Create Plan')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Create Plan</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <form action="{{ route('plans.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            name="name" id="name" placeholder="Plan name"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number"
                                            class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                                            name="price" id="price" placeholder="Plan price per month"
                                            value="{{ old('price') }}">
                                        @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--                                 <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="image">Image</label>
                                                    <input type="file"
                                                        class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}"
                                                        name="image" id="image">
                                                    @error('image')
        <span class="text-danger">{{ $message }}</span>
    @enderror
                                                </div>
                                            </div> -->
                            </div>

                            <button type="submit" class="btn btn-success add-btn rounded-3 me-2">Submit</button>
                            <a href="{{ route('plans.index') }}" class="btn cancel-btn">Back</a>
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
