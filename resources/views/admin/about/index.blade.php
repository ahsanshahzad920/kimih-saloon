@extends('admin.layout.app')

@section('title', 'About Us')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">{{ __('About Us Setting') }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('crm-about.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="heading" class="form-label">{{ __('Heading') }}</label>
                                    <input type="text" class="form-control" id="heading" name="heading"
                                        value="{{ old('heading', $record->heading ?? '') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="title" class="form-label">{{ __('Title') }}</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ old('title', $record->title ?? '') }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">{{ __('Description') }}</label>
                                <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $record->description ?? '') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="images" class="form-label">
                                    {{ __('Images') }}
                                    (<span class="text-danger">CTRL + click to select multiple images</span>)
                                </label>
                                <input type="file" class="form-control" id="images" name="images[]" multiple>
                            </div>

                            @isset($record->images)
                                <div class="row">
                                    @foreach (json_decode($record->images, true) as $image)
                                        <div class="col-md-1 mb-2">
                                            <img src="{{ asset(Storage::url($image)) }}" alt="images" width="80"
                                                height="80" />
                                            <button type="button" class="btn btn-danger btn-sm delete-image-button w-100"
                                                data-id="{{ $record?->id }}" data-path="{{ $image ?? '' }}">
                                                Delete
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endisset

                            <hr class="my-5">

                            {{-- Video Section --}}
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="video_link" class="form-label">{{ __('Video Link') }}</label>
                                    <input type="text" class="form-control" id="video_link" name="video_link"
                                        value="{{ old('video_link', $record->video_link ?? '') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="video_background_image"
                                        class="form-label">{{ __('Video Background Image') }}</label>
                                    <input type="file" class="form-control" id="video_background_image"
                                        name="video_background_image">
                                </div>
                                <div class="col-md-2">
                                    <img src="{{ isset($record->video_background_image) ? asset(Storage::url($record->video_background_image)) : 'https://placehold.co/600x400' }}"
                                        alt="image" width="100" height="100">
                                </div>
                            </div>

                            <hr class="my-5">

                            {{-- Section --}}
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="section_heading" class="form-label">{{ __('Section Heading') }}</label>
                                    <input type="text" class="form-control" id="section_heading" name="section_heading"
                                        value="{{ old('section_heading', $record->section_heading ?? '') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="section_title" class="form-label">{{ __('Section Title') }}</label>
                                    <input type="text" class="form-control" id="section_title" name="section_title"
                                        value="{{ old('section_title', $record->section_title ?? '') }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <label for="section_image" class="form-label">{{ __('Section Image') }}</label>
                                    <input type="file" class="form-control" id="section_image" name="section_image">
                                </div>
                                <div class="col-md-4">
                                    <img src="{{ isset($record->section_image) ? asset(Storage::url($record->section_image)) : 'https://placehold.co/600x400' }}"
                                        alt="image" width="100" height="100">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Save Settings') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('bottom-scripts')
    <script>
        $(document).ready(function() {
            $('.delete-image-button').on('click', function() {
                var recordID = $(this).data('id');
                var imagePath = $(this).data('path');
                var button = $(this);

                if (confirm('Are you sure you want to delete this image?')) {
                    $.ajax({
                        url: 'crm-about/' + recordID,
                        type: 'DELETE',
                        data: {
                            imagePath: imagePath,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                button.closest('.col-md-1').remove();
                            } else {
                                alert('Failed to delete the image.');
                            }
                        },
                        error: function(xhr) {
                            alert('An error occurred while deleting the image.');
                        }
                    });
                }
            });
        });
    </script>
@endsection
