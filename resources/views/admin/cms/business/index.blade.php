@extends('admin.layout.app')

@section('title', 'Business CMS')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">{{ __('Business Setting') }}</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('cms-business.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            id="title" name="title" value="{{ old('title', $section->title ?? '') }}">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="sub_title">Sub Title</label>
                                        <input type="text" class="form-control @error('sub_title') is-invalid @enderror"
                                            id="sub_title" name="sub_title"
                                            value="{{ old('sub_title', $section->sub_title ?? '') }}">
                                        @error('sub_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="header_image">Header Image</label>
                                        <input type="file"
                                            class="form-control @error('header_image') is-invalid @enderror"
                                            id="header_image" name="header_image">
                                        @error('header_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <img src="{{ asset(Storage::url($section->header_image ?? '')) }}" alt="img"
                                            width="100" height="100" />
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4 border-secondary border border-2">

                            <div class="row mb-3">
                                <div class="col-md-1 mb-3 d-flex align-items-center justify-content-center">
                                    <img src="{{ asset(Storage::url($section->capterra_image ?? '')) }}" alt="img"
                                        height="60" width="60">
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group mb-3">
                                        <label for="capterra_image">Capterra Image</label>
                                        <input type="file"
                                            class="form-control @error('capterra_image') is-invalid @enderror"
                                            id="capterra_image" name="capterra_image">
                                        @error('capterra_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="capterra_rating">Capterra Rating</label>
                                        <input type="text"
                                            class="form-control @error('capterra_rating') is-invalid @enderror"
                                            id="capterra_rating" name="capterra_rating"
                                            value="{{ old('capterra_rating', $section->capterra_rating ?? '') }}">
                                        @error('capterra_rating')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-bold me-2">Capterra Reviews</label>
                                        <button type="button" id="add-review"
                                            class="btn bg-white shadow-sm rounded px-2 py-1 border">+</button>

                                        <div id="reviews-form" class="mt-2 d-flex flex-wrap">
                                            @php
                                                $extData = !is_null($section)
                                                    ? json_decode($section->capterra_review, true)
                                                    : [];
                                                $extraContent =
                                                    !is_null($section) && !empty($section->capterra_review)
                                                        ? json_decode($section->capterra_review, true)
                                                        : [];
                                            @endphp

                                            @forelse ($extraContent as $index => $review)
                                                <div class="review-item d-flex flex-column align-items-start mt-2 me-2">
                                                    <input type="text" class="form-control mb-2"
                                                        name="extra_content[{{ $index }}][heading]"
                                                        placeholder="Heading" value="{{ $review['heading'] }}"
                                                        autocomplete="off">
                                                    <textarea class="form-control mb-2" name="extra_content[{{ $index }}][description]" placeholder="Description"
                                                        autocomplete="off" rows="4">{{ $review['description'] }}</textarea>
                                                    <button type="button"
                                                        class="btn btn-danger remove-review">Remove</button>
                                                </div>
                                            @empty
                                                <div class="review-item d-flex flex-column align-items-start mt-2 me-2">
                                                    <input type="text" class="form-control mb-2"
                                                        name="extra_content[0][heading]" placeholder="Heading"
                                                        autocomplete="off">
                                                    <textarea class="form-control mb-2" name="extra_content[0][description]" placeholder="Description" autocomplete="off"
                                                        rows="4"></textarea>
                                                    <button type="button"
                                                        class="btn btn-danger remove-review">Remove</button>
                                                </div>
                                            @endforelse
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <hr class="my-4 border-secondary border border-2">

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="top_rating_title">Top Rating Title</label>
                                        <input type="text"
                                            class="form-control @error('top_rating_title') is-invalid @enderror"
                                            id="top_rating_title" name="top_rating_title"
                                            value="{{ old('top_rating_title', $section->top_rating_title ?? '') }}">
                                        @error('top_rating_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="top_rating_description">Top Rating Description</label>
                                        <textarea class="form-control @error('top_rating_description') is-invalid @enderror" id="top_rating_description"
                                            name="top_rating_description">{{ old('top_rating_description', $section->top_rating_description ?? '') }}</textarea>
                                        @error('top_rating_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="business_partner_count">Business Partner Count</label>
                                        <input type="text"
                                            class="form-control @error('business_partner_count') is-invalid @enderror"
                                            id="business_partner_count" name="business_partner_count"
                                            value="{{ old('business_partner_count', $section->business_partner_count ?? '') }}">
                                        @error('business_partner_count')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="business_partner_title">Business Partner Title</label>
                                        <input type="text"
                                            class="form-control @error('business_partner_title') is-invalid @enderror"
                                            id="business_partner_title" name="business_partner_title"
                                            value="{{ old('business_partner_title', $section->business_partner_title ?? '') }}">
                                        @error('business_partner_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="appointmens_count">Appointments Count</label>
                                        <input type="text"
                                            class="form-control @error('appointmens_count') is-invalid @enderror"
                                            id="appointmens_count" name="appointmens_count"
                                            value="{{ old('appointmens_count', $section->appointmens_count ?? '') }}">
                                        @error('appointmens_count')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="appointmens_title">Appointments Title</label>
                                        <input type="text"
                                            class="form-control @error('appointmens_title') is-invalid @enderror"
                                            id="appointmens_title" name="appointmens_title"
                                            value="{{ old('appointmens_title', $section->appointmens_title ?? '') }}">
                                        @error('appointmens_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="stylists_count">Stylists Count</label>
                                        <input type="text"
                                            class="form-control @error('stylists_count') is-invalid @enderror"
                                            id="stylists_count" name="stylists_count"
                                            value="{{ old('stylists_count', $section->stylists_count ?? '') }}">
                                        @error('stylists_count')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="stylists_title">Stylists Title</label>
                                        <input type="text"
                                            class="form-control @error('stylists_title') is-invalid @enderror"
                                            id="stylists_title" name="stylists_title"
                                            value="{{ old('stylists_title', $section->stylists_title ?? '') }}">
                                        @error('stylists_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="countries_count">Countries Count</label>
                                        <input type="text"
                                            class="form-control @error('countries_count') is-invalid @enderror"
                                            id="countries_count" name="countries_count"
                                            value="{{ old('countries_count', $section->countries_count ?? '') }}">
                                        @error('countries_count')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="countries_title">Countries Title</label>
                                        <input type="text"
                                            class="form-control @error('countries_title') is-invalid @enderror"
                                            id="countries_title" name="countries_title"
                                            value="{{ old('countries_title', $section->countries_title ?? '') }}">
                                        @error('countries_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('bottom-scripts')
    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    {{-- Capterra Reviews --}}
    <script>
        $(document).ready(function() {
            let reviewIndex = @json(count($extraContent)); // Start from the text of existing reviews

            $('#add-review').click(function() {
                let newReview = `
            <div class="review-item d-flex flex-column align-items-start mt-2 me-2">
                <input type="text" class="form-control mb-2" name="extra_content[${reviewIndex}][heading]" placeholder="Heading" autocomplete="off">
                <textarea class="form-control mb-2" name="extra_content[${reviewIndex}][description]" placeholder="Description" autocomplete="off" rows="4"></textarea>
                <button type="button" class="btn btn-danger remove-review">Remove</button>
            </div>
        `;
                $('#reviews-form').append(newReview);
                reviewIndex++;
            });

            $(document).on('click', '.remove-review', function() {
                $(this).closest('.review-item').remove();
            });
        });
    </script>

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
