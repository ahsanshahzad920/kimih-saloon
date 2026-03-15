@extends('admin.layout.app')
@section('title', 'Add Bot Faqs')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Add Bot Faqs</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <form action="{{ route('bot-faqs.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="question">Question</label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('question') ? 'is-invalid' : '' }}"
                                            name="question" id="question" placeholder="Faqs question">
                                        @error('question')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="answer">Answer</label>
                                <textarea class="form-control {{ $errors->has('answer') ? 'is-invalid' : '' }}" id="answer" name="answer"
                                    rows="5" placeholder="Faqs answer"></textarea>
                                @error('answer')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success add-btn rounded-3 me-2">Submit</button>
                            <a href="{{ route('faqs.index') }}" class="btn cancel-btn">Back</a>
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
