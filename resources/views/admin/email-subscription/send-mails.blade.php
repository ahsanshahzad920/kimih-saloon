@extends('admin.layout.app')
@section('title', 'Send Mails')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Send Mails</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <form action="{{ route('send.mails.send') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-lg-12 mb-2">
                                    <div class="form-group">
                                        <label for="subject">Select Customer</label>
                                        <select name="customer_id" id="customer_id" class="form-control ">
                                            <option value="">Select Customer</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->user->id }}">{{ $customer->user->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('subject')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="subject">Subject</label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('subject') ? 'is-invalid' : '' }}"
                                            name="subject" id="subject" autocomplete="off" />
                                        @error('subject')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="attach">Attachment</label>
                                        <input type="file"
                                            class="form-control {{ $errors->has('attach') ? 'is-invalid' : '' }}"
                                            name="attach" id="attach" autocomplete="off" />
                                        @error('attach')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="body">Body</label>
                                <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" id="editor" name="body"
                                    rows="5"></textarea>
                                @error('body')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success add-btn rounded-3 me-2">Submit</button>
                            <a href="{{ route('sub.index') }}" class="btn cancel-btn">Back</a>
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
