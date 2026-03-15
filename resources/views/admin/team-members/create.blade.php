@extends('admin.layout.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>

@endsection
@section('title', 'Create Supplier')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <!-- start page title -->

            <!-- end page title -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Create Team Member</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="javascript: void(0);">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="javascript: void(0);">Catalogues</a>
                                    </li>
                                    <li class="breadcrumb-item active">Create Supplier</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('team-members.store') }}" method="POST" enctype="multipart/form-data" class="d-flex justify-content-center">
                    @csrf
                    <div class="col-md-7">
                        <div class="card card-shadow rounded-3 border-0 mt-4 p-4 pb-5 ">
                            <div class="container-fluid create-product-form rounded">
                                <h5>Profile</h5>
                                <h6 class="text-secondary">Manage your team members personal profile</h6>
                                <!--end breadcrumb-->
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1" class="mb-1">Image <span
                                                    class="text-danger"></span></label>
                                            <input type="file" class="form-control subheading" id="exampleFormControlInput1"
                                                placeholder="Image" name="image" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1" class="mb-1">Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control subheading" id="exampleFormControlInput1"
                                                placeholder="e.g. John Doe" required name="name" />
                                        </div>
                                    </div>

                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1" class="mb-1">Email</label>
                                            <input type="email" class="form-control subheading" id="exampleFormControlInput1"
                                                placeholder="e.g. example@gmail.com" name="email" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1" class="mb-1">Phone<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control subheading" id="exampleFormControlInput1"
                                                placeholder="e.g. 123456789" required name="phone" />
                                        </div>
                                    </div>

                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1" class="mb-1">Birthday</label>
                                            <input type="date" class="form-control subheading" id="exampleFormControlInput1"
                                                placeholder="e.g. 23/04/1999" required name="birth_date" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1" class="mb-1">Select Gender</label>
                                            <select class="form-select subheading" id="exampleFormControl" name="gender" required>
                                                <option disabled>Select an Option</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Non-Binary">Non-Binary</option>
                                                <option value="Prefer not to say">Prefer not to say</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1" class="mb-1">Job Title</label>
                                            <input type="text" class="form-control" id="job_title" name="job_title">
                                            <span class="text-secondary">Visible to clients online</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">

                                    <label class="form-label">Address:</label>
                                    <textarea name="address" id="address" cols="30" rows="4" class="form-control" required></textarea>
                                </div>


                            </div>
                        </div>
                        <div class="card card-shadow rounded-3 border-0 mt-4 p-4 pb-5 ">
                            <div class="container-fluid create-product-form rounded">
                                <h5>Employment details </h5>
                                <h6 class="text-secondary">Manage your team members start date, and employment details. </h6>
                                <!--end breadcrumb-->
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="preferred_language" class="mb-1">Start Date</label>
                                            <input type="date" class="form-control" id="start_date" name="start_date">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="preferred_language" class="mb-1">End Date</label>
                                            <input type="date" class="form-control" id="end_date" name="end_date">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-12 mt-2">
                                    <label class="form-label">Notes:</label>
                                    <textarea name="note" id="note" cols="30" rows="4" class="form-control"
                                        placeholder="Add a private note only viewable in the team memeber list"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card card-shadow rounded-3 border-0 mt-4 p-4 pb-5 ">
                            <div class="container-fluid create-product-form rounded">
                                <h5>Workspace </h5>
                                <h6 class="text-secondary">Manage your team members start date, and employment details. </h6>
                                <!--end breadcrumb-->
                                <div class="row mt-4">
                                    <label for="">Select Services</label>
                                    <div class="col-12 col-md-12">
                                        <select id="choices-multiple-remove-button" placeholder="Select Service"
                                            name="services[]" multiple>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}" selected>{{ $service->service_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-md-12 mt-2">
                                    <label class="form-label">Notes:</label>
                                    <textarea name="note" id="note" cols="30" rows="4" class="form-control" placeholder="Add a private note only viewable in the team memeber list"></textarea>
                                </div> --}}
                                <button class="btn default-btn mt-3 text-white" type="submit">Save</button>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')


<script type="text/javascript">
    $(document).ready(function() {
        // $('.ckeditor').ckeditor();

        var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
            removeItemButton: true,
            // maxItemCount: 5,
            // searchResultLimit: 5,
            // renderChoiceLimit: 5
        });

    });
</script>
@endsection
