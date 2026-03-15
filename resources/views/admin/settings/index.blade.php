@extends('admin.layout.app')
@section('title', 'Settings')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Settings</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <form action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="site_name">Site Name</label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('site_name') ? 'is-invalid' : '' }}"
                                            name="site_name" id="site_name" placeholder="Site Name"
                                            value="{{ old('site_name', $settings->site_name ?? '') }}" />
                                        @error('site_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="logo">Logo Icon</label>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <input type="file"
                                                    class="form-control {{ $errors->has('logo') ? 'is-invalid' : '' }}"
                                                    name="logo" id="logo" />
                                                @error('logo')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-4 bg-light p-2">
                                                @if ($settings && $settings->logo)
                                                    <div>
                                                        <img src="{{ asset('storage/' . $settings->logo) }}" alt="Logo"
                                                            height="100" width="100">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="logo_with_site_name">Logo with Site Name</label>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <input type="file"
                                                    class="form-control {{ $errors->has('logo_with_site_name') ? 'is-invalid' : '' }}"
                                                    name="logo_with_site_name" id="logo_with_site_name" />
                                                @error('logo_with_site_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-4 bg-light p-2">
                                                @if ($settings && $settings->logo_with_site_name)
                                                    <div>
                                                        <img src="{{ asset('storage/' . $settings->logo_with_site_name) }}"
                                                            alt="Logo with Site Name" height="100" width="200">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="logo_front">Logo for Front Pages</label>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <input type="file"
                                                    class="form-control {{ $errors->has('logo_front') ? 'is-invalid' : '' }}"
                                                    name="logo_front" id="logo_front" />
                                                @error('logo_front')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-4 bg-light p-2">
                                                @if ($settings && $settings->logo_front)
                                                    <div>
                                                        <img src="{{ asset('storage/' . $settings->logo_front) }}"
                                                            alt="Logo with Site Name" height="100" width="200">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="privacy_policy">Privacy Policy</label>
                                <textarea class="form-control {{ $errors->has('privacy_policy') ? 'is-invalid' : '' }}" id="editor"
                                    name="privacy_policy" rows="5" placeholder="Privacy Policy">{{ old('privacy_policy', $settings->privacy_policy ?? '') }}</textarea>
                                @error('privacy_policy')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="term_of_service">Terms of Services</label>
                                <textarea class="form-control editor {{ $errors->has('term_of_service') ? 'is-invalid' : '' }}" id="editor"
                                    name="term_of_service" rows="5" placeholder="Term of Service">{{ old('term_of_service', $settings->term_of_service ?? '') }}</textarea>
                                @error('term_of_service')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="cancellation_policy">Cancellation Policy</label>
                                <textarea class="form-control editors {{ $errors->has('cancellation_policy') ? 'is-invalid' : '' }}" id="editors"
                                    name="cancellation_policy" rows="5" placeholder="Cancellation Policy">{{ old('cancellation_policy', $settings->cancellation_policy ?? '') }}</textarea>
                                @error('cancellation_policy')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="partner_terms">Patner Terms</label>
                                <textarea class="form-control editors {{ $errors->has('partner_terms') ? 'is-invalid' : '' }}" id="editorss"
                                    name="partner_terms" rows="5" placeholder="Partner Terms">{{ old('partner_terms', $settings->partner_terms ?? '') }}</textarea>
                                @error('partner_terms')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success add-btn rounded-3 me-2">Submit</button>
                            <a href="{{ route('settings.index') }}" class="btn cancel-btn">Back</a>
                        </form>
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editors'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#editorss'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
