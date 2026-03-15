@extends('admin.layout.app')
@section('title', 'Add Client')
@section('content')
    <!--start page wrapper -->
{{-- <div class="content">
    <div class="container-fluid px-4 mt-3">
        <div class="border-bottom">
            <h3 class="all-adjustment text-center pb-2 mb-0">Create Client</h3>
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

        <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card card-shadow rounded-3 border-0 mt-4 p-4 pb-5 ">
                <div class="container-fluid create-product-form rounded">
                    <h5>Profile</h5>
                    <h6 class="text-secondary">Manage your client’s personal profile</h6>
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
                                <label for="exampleFormControlSelect1" class="mb-1">Pronouns</label>
                                <select class="form-select subheading" id="exampleFormControl" name="pronouns" required>
                                    <option disabled>Select an Option</option>
                                    <option value="He/Him">He/Him</option>
                                    <option value="She/Her">She/Her</option>
                                    <option value="They/Them">They/Them</option>
                                    <option value="Prefer not to say">Prefer not to say</option>
                                </select>
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
                    <h5>Additional info</h5>
                    <h6 class="text-secondary">Manage your client’s info. </h6>
                    <!--end breadcrumb-->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="preferred_language" class="mb-1">Preferred language <span
                                        class="text-danger"></span>
                                </label>
                                <select name="preferred_language" id="preferred_language"
                                    class="form-select subheading">
                                    <option disabled>Select an Option</option>
                                    <option value="English">English</option>
                                    <option value="French">French</option>
                                    <option value="Spanish">Spanish</option>
                                    <option value="German">German</option>
                                    <option value="Chinese">Chinese</option>
                                    <option value="Japanese">Japanese</option>
                                    <option value="Russian">Russian</option>
                                    <option value="Arabic">Arabic</option>
                                    <option value="Hindi">Hindi</option>
                                    <option value="Bengali">Bengali</option>
                                    <option value="Portuguese">Portuguese</option>
                                    <option value="Urdu">Urdu</option>
                                    <option value="Indonesian">Indonesian</option>
                                    <option value="Turkish">Turkish</option>
                                    <option value="Korean">Korean</option>
                                    <option value="Italian">Italian</option>
                                    <option value="Dutch">Dutch</option>
                                    <option value="Polish">Polish</option>
                                    <option value="Greek">Greek</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="client_source" class="mb-1">Client Source <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control subheading" id="client_source"
                                    placeholder="e.g. John Doe" name="client_source" />
                                <span class="text-secondary">Choose how this client found your business</span>
                            </div>
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="occupation" class="mb-1">Occupation</label>
                                <input type="email" class="form-control subheading" id="occupation"
                                    placeholder="Enter Client Job Information" name="occupation" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country" class="mb-1">Country</label>
                                <select class="form-select subheading" id="country" name="country">
                                    <option disabled>Select an Option</option>
                                    <option value="US">🇺🇸 United States</option>
                                    <option value="GB">🇬🇧 United Kingdom</option>
                                    <option value="CA">🇨🇦 Canada</option>
                                    <option value="AE">🇦🇪 United Arab Emirates</option>
                                    <option value="AF">🇦🇫 Afghanistan</option>
                                    <option value="AX">🇦🇽 Åland Islands</option>
                                    <option value="AL">🇦🇱 Albania</option>
                                    <option value="DZ">🇩🇿 Algeria</option>
                                    <option value="AS">🇦🇸 American Samoa</option>
                                    <option value="AD">🇦🇩 Andorra</option>
                                    <option value="AO">🇦🇴 Angola</option>
                                    <option value="AI">🇦🇮 Anguilla</option>
                                    <option value="AQ">🇦🇶 Antarctica</option>
                                    <option value="AG">🇦🇬 Antigua And Barbuda</option>
                                    <option value="AR">🇦🇷 Argentina</option>
                                    <option value="AM">🇦🇲 Armenia</option>
                                    <option value="AW">🇦🇼 Aruba</option>
                                    <option value="AC"> Ascension Island</option>
                                    <option value="AU">🇦🇺 Australia</option>
                                    <option value="AT">🇦🇹 Austria</option>
                                    <option value="AZ">🇦🇿 Azerbaijan</option>
                                    <option value="BS">🇧🇸 Bahamas</option>
                                    <option value="BH">🇧🇭 Bahrain</option>
                                    <option value="BD">🇧🇩 Bangladesh</option>
                                    <option value="BB">🇧🇧 Barbados</option>
                                    <option value="BY">🇧🇾 Belarus</option>
                                    <option value="BE">🇧🇪 Belgium</option>
                                    <option value="BZ">🇧🇿 Belize</option>
                                    <option value="BJ">🇧🇯 Benin</option>
                                    <option value="BM">🇧🇲 Bermuda</option>
                                    <option value="BT">🇧🇹 Bhutan</option>
                                    <option value="BO">🇧🇴 Bolivia, Plurinational State Of</option>
                                    <option value="BQ">🇧🇶 Bonaire, Saint Eustatius And Saba</option>
                                    <option value="BA">🇧🇦 Bosnia &amp; Herzegovina</option>
                                    <option value="BW">🇧🇼 Botswana</option>
                                    <option value="BR">🇧🇷 Brazil</option>
                                    <option value="IO">🇮🇴 British Indian Ocean Territory</option>
                                    <option value="BN">🇧🇳 Brunei Darussalam</option>
                                    <option value="BG">🇧🇬 Bulgaria</option>
                                    <option value="BF">🇧🇫 Burkina Faso</option>
                                    <option value="BI">🇧🇮 Burundi</option>
                                    <option value="CV">🇨🇻 Cabo Verde</option>
                                    <option value="KH">🇰🇭 Cambodia</option>
                                    <option value="CM">🇨🇲 Cameroon</option>
                                    <option value="KY">🇰🇾 Cayman Islands</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="additional_email" class="mb-1">Additional Email</label>
                                <input type="email" class="form-control subheading" id="additional_email"
                                    placeholder="e.g. example@gmail.com" name="additional_email" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="additional_phone" class="mb-1">Additional Phone</label>
                                <input type="text" class="form-control subheading" id="additional_phone"
                                    placeholder="e.g. example@gmail.com" name="additional_phone" />
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card card-shadow rounded-3 border-0 mt-4 p-4 pb-5 ">
                <div class="container-fluid create-product-form rounded">
                    <h5>Emergency contacts </h5>
                    <h6 class="text-secondary">Manage your client’s emergency contacts. </h6>
                    <!--end breadcrumb-->
                    <h6 class="mt-4">Primary contact</h6>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="e_primary_name" class="mb-1">Full Name </label>
                                <input type="text" class="form-control subheading" id="e_primary_name"
                                    placeholder="e.g. John Doe" name="e_primary_name" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="e_primary_relationship" class="mb-1">Relationship </label>
                                <input type="text" class="form-control subheading" id="e_primary_relationship"
                                    placeholder="e.g. Parent" name="e_primary_relationship" />
                            </div>
                        </div>


                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="e_primary_email" class="mb-1">Email</label>
                                <input type="email" class="form-control subheading" id="e_primary_email"
                                    placeholder="e.g. example@gmail.com" name="e_primary_email" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="e_primary_phone" class="mb-1">Phone</label>
                                <input type="tel" class="form-control subheading" id="e_primary_phone"
                                    placeholder="e.g. 123456789" name="phone" />
                            </div>
                        </div>
                    </div>
                    <hr class="mt-4">
                    <h6 class="mt-4">Secondary contact</h6>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="e_secondary_name" class="mb-1">Full Name </label>
                                <input type="text" class="form-control subheading" id="e_secondary_name"
                                    placeholder="e.g. John Doe" name="e_secondary_name" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="e_secondary_relationship" class="mb-1">Relationship </label>
                                <input type="text" class="form-control subheading" id="e_secondary_relationship"
                                    placeholder="e.g. Parent" name="e_secondary_relationship" />
                            </div>
                        </div>


                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="e_secondary_email" class="mb-1">Email</label>
                                <input type="email" class="form-control subheading" id="e_secondary_email"
                                    placeholder="e.g. example@gmail.com" name="e_secondary_email" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="e_secondary_phone" class="mb-1">Phone</label>
                                <input type="tel" class="form-control subheading" id="e_secondary_phone"
                                    placeholder="e.g. 123456789" name="e_secondary_phone" />
                            </div>
                        </div>
                    </div>

                    <button class="btn btn btn-success add-btn mt-4" type="submit">Save</button>
                </div>
            </div>

        </form>
    </div>
</div> --}}
<!--end page wrapper -->



    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">All Clients</h4>
                    </div><!-- end card header -->
                    @include('admin.layout.errors')
                    <div class="card-body">
                        <div class="listjs-table" id="customerList">
                            <div class="row g-4 mb-3">
                                <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card card-shadow rounded-3 border-0 mt-4 p-4 pb-5 ">
                                        <div class="container-fluid create-product-form rounded">
                                            <h5>Profile</h5>
                                            <h6 class="text-secondary">Manage your client’s personal profile</h6>
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
                                                        <label for="exampleFormControlSelect1" class="mb-1">Pronouns</label>
                                                        <select class="form-select subheading" id="exampleFormControl" name="pronouns" required>
                                                            <option disabled>Select an Option</option>
                                                            <option value="He/Him">He/Him</option>
                                                            <option value="She/Her">She/Her</option>
                                                            <option value="They/Them">They/Them</option>
                                                            <option value="Prefer not to say">Prefer not to say</option>
                                                        </select>
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
                                            <h5>Additional info</h5>
                                            <h6 class="text-secondary">Manage your client’s info. </h6>
                                            <!--end breadcrumb-->
                                            <div class="row mt-4">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="preferred_language" class="mb-1">Preferred language <span
                                                                class="text-danger"></span>
                                                        </label>
                                                        <select name="preferred_language" id="preferred_language"
                                                            class="form-select subheading">
                                                            <option disabled>Select an Option</option>
                                                            <option value="English">English</option>
                                                            <option value="French">French</option>
                                                            <option value="Spanish">Spanish</option>
                                                            <option value="German">German</option>
                                                            <option value="Chinese">Chinese</option>
                                                            <option value="Japanese">Japanese</option>
                                                            <option value="Russian">Russian</option>
                                                            <option value="Arabic">Arabic</option>
                                                            <option value="Hindi">Hindi</option>
                                                            <option value="Bengali">Bengali</option>
                                                            <option value="Portuguese">Portuguese</option>
                                                            <option value="Urdu">Urdu</option>
                                                            <option value="Indonesian">Indonesian</option>
                                                            <option value="Turkish">Turkish</option>
                                                            <option value="Korean">Korean</option>
                                                            <option value="Italian">Italian</option>
                                                            <option value="Dutch">Dutch</option>
                                                            <option value="Polish">Polish</option>
                                                            <option value="Greek">Greek</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="client_source" class="mb-1">Client Source <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control subheading" id="client_source"
                                                            placeholder="e.g. John Doe" name="client_source" />
                                                        <span class="text-secondary">Choose how this client found your business</span>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="occupation" class="mb-1">Occupation</label>
                                                        <input type="text" class="form-control subheading" id="occupation"
                                                            placeholder="Enter Client Job Information" name="occupation" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="country" class="mb-1">Country</label>
                                                        <select class="form-select subheading" id="country" name="country">
                                                            <option disabled>Select an Option</option>
                                                            <option value="US">🇺🇸 United States</option>
                                                            <option value="GB">🇬🇧 United Kingdom</option>
                                                            <option value="CA">🇨🇦 Canada</option>
                                                            <option value="AE">🇦🇪 United Arab Emirates</option>
                                                            <option value="AF">🇦🇫 Afghanistan</option>
                                                            <option value="AX">🇦🇽 Åland Islands</option>
                                                            <option value="AL">🇦🇱 Albania</option>
                                                            <option value="DZ">🇩🇿 Algeria</option>
                                                            <option value="AS">🇦🇸 American Samoa</option>
                                                            <option value="AD">🇦🇩 Andorra</option>
                                                            <option value="AO">🇦🇴 Angola</option>
                                                            <option value="AI">🇦🇮 Anguilla</option>
                                                            <option value="AQ">🇦🇶 Antarctica</option>
                                                            <option value="AG">🇦🇬 Antigua And Barbuda</option>
                                                            <option value="AR">🇦🇷 Argentina</option>
                                                            <option value="AM">🇦🇲 Armenia</option>
                                                            <option value="AW">🇦🇼 Aruba</option>
                                                            <option value="AC"> Ascension Island</option>
                                                            <option value="AU">🇦🇺 Australia</option>
                                                            <option value="AT">🇦🇹 Austria</option>
                                                            <option value="AZ">🇦🇿 Azerbaijan</option>
                                                            <option value="BS">🇧🇸 Bahamas</option>
                                                            <option value="BH">🇧🇭 Bahrain</option>
                                                            <option value="BD">🇧🇩 Bangladesh</option>
                                                            <option value="BB">🇧🇧 Barbados</option>
                                                            <option value="BY">🇧🇾 Belarus</option>
                                                            <option value="BE">🇧🇪 Belgium</option>
                                                            <option value="BZ">🇧🇿 Belize</option>
                                                            <option value="BJ">🇧🇯 Benin</option>
                                                            <option value="BM">🇧🇲 Bermuda</option>
                                                            <option value="BT">🇧🇹 Bhutan</option>
                                                            <option value="BO">🇧🇴 Bolivia, Plurinational State Of</option>
                                                            <option value="BQ">🇧🇶 Bonaire, Saint Eustatius And Saba</option>
                                                            <option value="BA">🇧🇦 Bosnia &amp; Herzegovina</option>
                                                            <option value="BW">🇧🇼 Botswana</option>
                                                            <option value="BR">🇧🇷 Brazil</option>
                                                            <option value="IO">🇮🇴 British Indian Ocean Territory</option>
                                                            <option value="BN">🇧🇳 Brunei Darussalam</option>
                                                            <option value="BG">🇧🇬 Bulgaria</option>
                                                            <option value="BF">🇧🇫 Burkina Faso</option>
                                                            <option value="BI">🇧🇮 Burundi</option>
                                                            <option value="CV">🇨🇻 Cabo Verde</option>
                                                            <option value="KH">🇰🇭 Cambodia</option>
                                                            <option value="CM">🇨🇲 Cameroon</option>
                                                            <option value="KY">🇰🇾 Cayman Islands</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="additional_email" class="mb-1">Additional Email</label>
                                                        <input type="email" class="form-control subheading" id="additional_email"
                                                            placeholder="e.g. example@gmail.com" name="additional_email" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="additional_phone" class="mb-1">Additional Phone</label>
                                                        <input type="text" class="form-control subheading" id="additional_phone"
                                                            placeholder="e.g. example@gmail.com" name="additional_phone" />
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-shadow rounded-3 border-0 mt-4 p-4 pb-5 ">
                                        <div class="container-fluid create-product-form rounded">
                                            <h5>Emergency contacts </h5>
                                            <h6 class="text-secondary">Manage your client’s emergency contacts. </h6>
                                            <!--end breadcrumb-->
                                            <h6 class="mt-4">Primary contact</h6>
                                            <div class="row mt-3">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="e_primary_name" class="mb-1">Full Name </label>
                                                        <input type="text" class="form-control subheading" id="e_primary_name"
                                                            placeholder="e.g. John Doe" name="e_primary_name" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="e_primary_relationship" class="mb-1">Relationship </label>
                                                        <input type="text" class="form-control subheading" id="e_primary_relationship"
                                                            placeholder="e.g. Parent" name="e_primary_relationship" />
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="e_primary_email" class="mb-1">Email</label>
                                                        <input type="email" class="form-control subheading" id="e_primary_email"
                                                            placeholder="e.g. example@gmail.com" name="e_primary_email" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="e_primary_phone" class="mb-1">Phone</label>
                                                        <input type="tel" class="form-control subheading" id="e_primary_phone"
                                                            placeholder="e.g. 123456789" name="phone" />
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="mt-4">
                                            <h6 class="mt-4">Secondary contact</h6>
                                            <div class="row mt-3">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="e_secondary_name" class="mb-1">Full Name </label>
                                                        <input type="text" class="form-control subheading" id="e_secondary_name"
                                                            placeholder="e.g. John Doe" name="e_secondary_name" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="e_secondary_relationship" class="mb-1">Relationship </label>
                                                        <input type="text" class="form-control subheading" id="e_secondary_relationship"
                                                            placeholder="e.g. Parent" name="e_secondary_relationship" />
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="e_secondary_email" class="mb-1">Email</label>
                                                        <input type="email" class="form-control subheading" id="e_secondary_email"
                                                            placeholder="e.g. example@gmail.com" name="e_secondary_email" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="e_secondary_phone" class="mb-1">Phone</label>
                                                        <input type="tel" class="form-control subheading" id="e_secondary_phone"
                                                            placeholder="e.g. 123456789" name="e_secondary_phone" />
                                                    </div>
                                                </div>
                                            </div>

                                            <button class="btn default-btn  mt-4" type="submit">Save</button>
                                        </div>
                                    </div>

                                </form>

                            </div>

                        </div>
                    </div><!-- end card -->
                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
    <!-- end main content-->
@endsection
