@extends('admin.layout.app')
@section('title', 'Add features')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Add features</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <form action="{{ route('feature.page.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                            name="title" id="title" placeholder="Feature Title"
                                            value="{{ old('title', $featurePage->title ?? '') }}" />
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="description">Description</label>
                                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description"
                                    rows="5" placeholder="Feature Description">{{ old('description', $featurePage->description ?? '') }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success add-btn rounded-3 me-2">Submit</button>
                            <a href="{{ route('features.index') }}" class="btn cancel-btn">Back</a>
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
