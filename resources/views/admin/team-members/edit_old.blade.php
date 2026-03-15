@extends('admin.layout.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>

@endsection
@section('content')
    <!--start page wrapper -->
@section('title', 'Add Client')
<div class="content">
    <div class="container-fluid px-4 mt-3">
        <div class="border-bottom">
            <h3 class="all-adjustment text-center pb-2 mb-0">Add Team Memeber</h3>
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

        <form action="{{ route('team-members.update',$team_member->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                                    placeholder="e.g. John Doe" required name="name" value="{{$team_member->name}}"/>
                            </div>
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="mb-1">Email</label>
                                <input type="email" class="form-control subheading" id="exampleFormControlInput1"
                                    placeholder="e.g. example@gmail.com" name="email" required value="{{$team_member->email}}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="mb-1">Phone<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control subheading" id="exampleFormControlInput1"
                                    placeholder="e.g. 123456789" required name="phone" value="{{$team_member->phone}}" />
                            </div>
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="mb-1">Birthday</label>
                                <input type="date" class="form-control subheading" id="exampleFormControlInput1"
                                    placeholder="e.g. 23/04/1999" required name="birth_date" value="{{$team_member->birth_date}}"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="mb-1">Select Gender</label>
                                <select class="form-select subheading" id="exampleFormControl" name="gender" required>
                                    <option disabled>Select an Option</option>
                                    <option value="Male" {{$team_member->gender == 'Male' ? 'selected': ''}} >Male</option>
                                    <option value="Female" {{$team_member->gender == 'Female' ? 'selected': ''}}>Female</option>
                                    <option value="Non-Binary" {{$team_member->gender == 'Non-Binary' ? 'selected': ''}} >Non-Binary</option>
                                    <option value="Prefer not to say" {{$team_member->gender == 'Prefer not to say' ? 'selected': ''}}>Prefer not to say</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="mb-1">Job Title</label>
                                <input type="text" class="form-control" id="job_title" name="job_title" value="{{$team_member->job_title}}">
                                <span class="text-secondary">Visible to clients online</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">

                        <label class="form-label">Address:</label>
                        <textarea name="address" id="address" cols="30" rows="4" class="form-control">{{$team_member->job_title}}</textarea>
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
                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{$team_member->start_date}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="preferred_language" class="mb-1">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" value="{{$team_member->end_date}}">
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12 mt-2">
                        <label class="form-label">Notes:</label>
                        <textarea name="note" id="note" cols="30" rows="4" class="form-control"
                            placeholder="Add a private note only viewable in the team memeber list">{{$team_member->note}}</textarea>
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
                                @php
                                    $team_member_services = explode(',', $team_member->services);
                                @endphp
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}" {{ in_array($service->id, $team_member_services) ? 'selected' : '' }}>{{ $service->service_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- <div class="col-md-12 mt-2">
                        <label class="form-label">Notes:</label>
                        <textarea name="note" id="note" cols="30" rows="4" class="form-control" placeholder="Add a private note only viewable in the team memeber list"></textarea>
                    </div> --}}
                    <button class="btn save-btn mt-3 text-white" type="submit">Save</button>
                </div>
            </div>


        </form>
    </div>
</div>
<!--end page wrapper -->
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
