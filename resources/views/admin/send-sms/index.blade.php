@extends('admin.layout.app')

@section('title', 'Send SMS')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">

                    <div class="card-body">
                        <form action="{{ route('send-sms.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            @include('admin.layout.errors')

                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="phone">Phone number (with country code)</label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                            name="phone" id="phone" placeholder="Phone number"
                                            value="{{ old('phone') }}" />
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="message">Message</label>
                                <textarea class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" id="message" name="message"
                                    rows="5" placeholder="Message">{{ old('message') }}</textarea>
                                @error('message')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success add-btn rounded-3 me-2">Send</button>
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
