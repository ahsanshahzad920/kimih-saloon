@extends('admin.layout.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>


@endsection
@section('title', 'Edit Membership')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <!-- start page title -->

            <!-- end page title -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Edit Membership</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="javascript: void(0);">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit Membership</li>
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
                <form action="{{ route('memberships.update',$membership->id) }}" id="productForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mt-4 d-flex justify-content-center">
                        @include('admin.layout.errors')
                        <div class="col-md-8">

                            <div class="card rounded-3">
                                <div class="card-body">
                                    <h5>Basic info</h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="membership_name">Membership Name</label>
                                                <input type="text" class="form-control mt-2" name="name"
                                                    id="membership_name" placeholder="" value="{{$membership->name ?? ''}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="description">Membership Description</label>
                                                <textarea class="form-control subheading mt-1" id="description" name="description" rows="3">{{$membership->description ?? ''}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-3 mt-2">
                                <div class="card-body">
                                    <h5>Services and sessions </h5>
                                    <span class="text-seconda">Add the services and sessions included in the membership. </span>
                                    <hr>
                                    <div class="row mt-4">
                                        <label for="">Included Services</label>
                                        @php
                                            $memberService = explode(',', $membership->services);
                                        @endphp
                                        <div class="col-12 col-md-12">
                                            <select id="choices-multiple-remove-button" placeholder="Select Services"
                                                name="services[]" multiple>
                                                @foreach ($services as $service)
                                                    <option value="{{$service->id}}" {{in_array($service->id,$memberService) ? 'selected': ''}}>{{$service->service_name ?? ''}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="description">Sessions</label>
                                                <select  placeholder="Select Services"
                                                    name="sessions" class="form-control subheading" id="sessions">
                                                    <option value="Limited" {{$membership->sessions == "Limited" ? 'selected':''}}>Limited</option>
                                                    <option value="Unlimited" {{$membership->sessions == "Unlimited" ? 'selected':''}}>Unlimited</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="no_of_session">
                                            <div class="form-group">
                                                <label for="description">No of sessions</label>
                                                <input type="text" class="form-control" name="no_of_session"
                                                    id="no_of_session" value="{{$membership->no_of_session ?? ''}}" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-3 mt-2">
                                <div class="card-body">
                                    <h5>Pricing and payment </h5>
                                    <span class="text-seconda">Choose how you'd like your clients to pay. </span>
                                    <div class="row mt-2">
                                        <hr>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="description">Valid For</label>
                                                <select id="" name="valid_for"
                                                    class="form-control subheading" >
                                                    <option value="7 days" {{$membership->valid_for == "7 days" ? 'selected':''}}>7 days</option>
                                                    <option value="14 days" {{$membership->valid_for == "14 days" ? 'selected':''}}>14 days</option>
                                                    <option value="1 month" {{$membership->valid_for == "1 month" ? 'selected':''}}>1 month</option>
                                                    <option value="2 months" {{$membership->valid_for == "2 months" ? 'selected':''}}>2 months</option>
                                                    <option value="3 months" {{$membership->valid_for == "3 months" ? 'selected':''}}>3 months</option>
                                                    <option value="4 months" {{$membership->valid_for == "4 months" ? 'selected':''}}>4 months</option>
                                                    <option value="6 months" {{$membership->valid_for == "6 months" ? 'selected':''}}>6 months</option>
                                                    <option value="8 months" {{$membership->valid_for == "8 months" ? 'selected':''}}>8 months</option>
                                                    <option value="1 year" {{$membership->valid_for == "1 year" ? 'selected':''}}>1 year</option>
                                                    <option value="18 months" {{$membership->valid_for == "18 months" ? 'selected':''}}>18 months</option>
                                                    <option value="2 years" {{$membership->valid_for == "2 years" ? 'selected':''}}>2 years</option>
                                                    <option value="5 years" {{$membership->valid_for == "5 years" ? 'selected':''}}>5 years</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="description">Price</label>
                                                <input type="text" class="form-control" name="price"
                                                    id="price" placeholder="0.00" value="{{$membership->price ?? ''}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <hr>
                                        <h6>Tax Rate</h6>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="description">Tax rate</label>
                                                <select  placeholder="Select Services"
                                                    name="tax_rate" class="form-control subheading">
                                                    <option disabled>Select an Option</option>
                                                    <option value="No Tax" {{$membership->tax_rate == "No Tax" ? 'selected':''}}>No Tax</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-3 mt-2">
                                <div class="card-body">
                                    <h5>Online sales and redemption </h5>
                                    <span class="text-seconda">Client can use this membership for the online services booking. </span>
                                    <div class="row mt-2">
                                        <hr>
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center">
                                                <label class="switch mt-2">
                                                    <input type="checkbox" name="online_sale" id="online_sale" value="1" {{$membership->online_sale == 1 ? 'checked':''}}>
                                                    <span class="slider"></span>
                                                </label>
                                                <p class="m-0">Enable online redemptions</p>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="card rounded-3 mt-2">
                                <div class="card-body">
                                    <h5>Terms & Conditions </h5>
                                    <span class="text-seconda">If there are any rules attached to your membership it's a good place to mention them. </span>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="term_condition">Terms & Conditions (Optional)</label>
                                                <textarea class="form-control subheading mt-1" id="term_condition" name="term_condition" rows="3">{{$membership->term_condition ?? ''}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>



                            <button type="submit" class="btn btn btn-success add-btn mt-3">Update</button>

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

        $('#sessions').change(function() {
            if (this.value == "Unlimited") {
                $('#no_of_session').hide();
            } else {
                $('#no_of_session').show();
            }
        });
        $('#sessions').trigger('change');
    });
</script>
@endsection
