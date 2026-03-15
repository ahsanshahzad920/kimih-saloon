@extends('admin.layout.app')
@section('title', 'Create Blog')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Update Blogs</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <form action="{{ route('blogs.update', $blog?->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                            name="title" id="title" placeholder="Blog Title"
                                            value="{{ old('title', $blog->title ?? '') }}">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file"
                                            class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}"
                                            name="image" id="image">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <img src="{{ asset(Storage::url($blog->image ?? '')) }}" alt="image"
                                            width="100" height="100" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="blog_type_id">Blog Type</label>
                                <select class="form-select" name="blog_type_id" id="blog_type_id">
                                    <option selected disabled>Select blog type</option>
                                    @foreach ($blogTypes as $type)
                                        <option value="{{ $type->id ?? '' }}"
                                            {{ $type->id === $blog->blog_type_id ? 'selected' : '' }}>
                                            {{ $type->name ?? '' }}</option>
                                    @endforeach
                                </select>
                                @error('blog_type_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="tags">Tags (Add multiple tags to a blog post, separated by commas.)</label>
                                <textarea name="tags" id="tags" class="form-control" rows="6" placeholder="Enter Tags by comma separate">{{ old('tags', $blog->tags) }}</textarea>
                            </div>

                            <div class="form-group mb-4">
                                <label for="body">Body</label>
                                <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" id="editor" name="body"
                                    rows="5" placeholder="Blog Content">{{ old('body', $blog->body ?? '') }}</textarea>
                                @error('body')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success add-btn rounded-3 me-2">Submit</button>
                            <a href="{{ route('blogs.index') }}" class="btn cancel-btn">Back</a>
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
