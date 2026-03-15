@extends('admin.layout.app')
@section('title', 'Update Faqs')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Update Faqs</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <form action="{{ route('faqs.update', $faq?->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="question">Question</label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('question') ? 'is-invalid' : '' }}"
                                            name="question" id="question" placeholder="Faq question"
                                            value="{{ old('question', $faq->question ?? '') }}">
                                        @error('question')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="answer">Answer</label>
                                <textarea class="form-control editor {{ $errors->has('answer') ? 'is-invalid' : '' }}" id="answer" name="answer"
                                    rows="5" placeholder="Feature answer">{!! $faq->answer !!}</textarea>
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

@section('scripts')
    <script>
        CKEDITOR.replace('.editor');
    </script>

@endsection
