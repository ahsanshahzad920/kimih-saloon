<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm-hover"
    data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="dash-assets/images/">
    <!-- jsvectormap css -->
    <link href="dash-assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />
    <!--Swiper slider css-->
    <link href="dash-assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
    <!-- Layout config Js -->
    <script src="dash-assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="dash-assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="dash-assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="dash-assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="dash-assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    {{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css"> --}}
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- Include Leaflet CSS -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css"> --}}

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .ui-auticomplete {
            width: 440px !important;
            z-index: 999999999999;
        }

        #map {
            margin-top: 40px;
            height: 280px;
            /* Set an appropriate height */
            width: 100%;
            /* Set the width to 100% to fill the available space */
        }
    </style>

</head>

<body>
    <section class="business-signup">
        <div class="container">
            <div id="container" class="container mt-5">
                <div class="progress px-1" style="height: 3px;">
                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0"
                        aria-valuemax="100"></div>
                </div>
                <form id="multi-step-form" action="{{ route('business.setup') }}" method="POST">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="step step-1">
                        <div class="text-end">
                            <button type="button" class="default-btn py-2 next-step">Continue</button>
                        </div>
                        <!-- Step 1 form fields here -->
                        <div class="row">
                            <div class="col-lg-5 mx-auto">
                                <p>Account setup</p>
                                <h3 class="text-brand">What's your business name?</h3>
                                <p>This is the brand name your clients will see. Your billing and legal name can be
                                    added</p>
                                <div class="card auth-page-content">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Business name</label>
                                            <input type="text" class="form-control" id="useremail"
                                                name="business_name">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Website (Optional)</label>
                                            <input type="text" class="form-control" id="useremail" name="website">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="step step-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="button" class="default-btn py-2 prev-step">Previous</button>
                            <button type="button" class="default-btn py-2 next-step">Next</button>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <img class="img-fluid mb-3" style="width:200px" src="assets/images/logo.png"alt="Logo">
                                <p>Account setup</p>
                                <h3 class="text-brand">What services do you offer?</h3>
                                <p>Choose your primary and up to 3 related service types</p>
                                <div class="row">

                                    @foreach ($services as $service)
                                        <div class="col-lg-4">
                                            <div class="services">
                                                <label>
                                                    <input type="checkbox" name="services[]"
                                                        value="{{ $service->id }}">
                                                    <span><img src="{{ asset($service->icon) }}"
                                                            alt="{{ $service->name }}"> <br>{{ $service->name }}</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="step step-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="button" class="default-btn py-2 prev-step">Previous</button>
                            <button type="button" class="default-btn py-2 next-step">Next</button>
                        </div>
                        <div class="row">
                            <div class="col-lg-5 mx-auto">
                                <p>Account setup</p>
                                <h3 class="text-brand">What's your team size?</h3>
                                <p>This will help us set up your calendar correctly. Don't worry, this doesn't change
                                    the price</p>
                                <div class="services">
                                    <label>
                                        <input type="radio" value="just me" name="team_size">
                                        <span>It's just me</span>
                                    </label>
                                </div>
                                <div class="services">
                                    <label>
                                        <input type="radio" value="2-5 people" name="team_size">
                                        <span>2-5 people</span>
                                    </label>
                                </div>
                                <div class="services">
                                    <label>
                                        <input type="radio" value="6-10 people" name="team_size">
                                        <span>6-10 people</span>
                                    </label>
                                </div>
                                <div class="services">
                                    <label>
                                        <input type="radio" value="11+ people" name="team_size">
                                        <span>11+ people</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="step step-4" style="height: 1000px">
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="button" class="default-btn prev-step">Previous</button>
                            <button type="submit" class="default-btn">Submit</button>
                        </div>
                        <div class="row">
                            <div class="col-lg-5 mx-auto">
                                <p>Account setup</p>
                                <h3 class="text-brand">Set your location</h3>
                                <p>Add your business location so your clients can easily find you.</p>

                                <div class=" ">
                                    <div class="form-group">
                                        <label for="" class="form-label">Where's your business
                                            located?</label>
                                        <input type="text" class="form-control" id="addressInput" name="location"
                                            placeholder="e.g. Dubai UAE">
                                        <div id="suggestionsContainer"></div>

                                        <div class="mapouter mt-5">
                                            <div class="gmap_canvas">
                                                <!-- <iframe class="gmap_iframe" width="100%" frameborder="0"
                                                    scrolling="no" marginheight="0" marginwidth="0"
                                                    src="https://maps.google.com/maps?q=31.5994529,74.3379943&t=k&z=13&ie=UTF8&iwloc=&output=embed"
                                                    id="map"></iframe> -->
                                                    <iframe class="gmap_iframe" width="100%" frameborder="0"
                                                        scrolling="no" marginheight="0" marginwidth="0"
                                                        src="https://maps.google.com/maps?q=25.197197,55.274376&t=k&z=17&ie=UTF8&iwloc=&output=embed"
                                                        id="map"></iframe>

                                                <a href="https://embed-googlemap.com">embed google maps in website</a>
                                            </div>
                                            <style>
                                                .mapouter {
                                                    position: relative;
                                                    text-align: right;
                                                    width: 100%;
                                                    height: 400px;
                                                }

                                                .gmap_canvas {
                                                    overflow: hidden;
                                                    background: none !important;
                                                    width: 100%;
                                                    height: 400px;
                                                }

                                                .gmap_iframe {
                                                    height: 400px !important;
                                                }
                                            </style>
                                        </div>
                                        {{-- <div class="mt-3">
                                            <input type="checkbox" class="form-control" id="dntHaveAddress">
                                            <label for="dntHaveAddress" class="form-label">I don't have a business address (mobile and online services only)</label>
                                        </div> --}}
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="dntHaveAddress">
                                            <label class="form-check-label" for="dntHaveAddress">
                                                I don't have a business address (mobile and online services only)
                                            </label>
                                        </div>

                                    </div>
                                    {{-- <div class="card-body">
                                        <h5>Business address</h5>
                                        <p>Lahore-Islamabad Motorway
                                            Sabzazar
                                            Lahore, Punjab
                                            Lahore
                                            Pakistan</p>
                                        <iframe
                                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d435521.95368151565!2d74.0047345272737!3d31.48251798697851!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39190483e58107d9%3A0xc23abe6ccc7e2462!2sLahore%2C%20Punjab%2C%20Pakistan!5e0!3m2!1sen!2s!4v1714917211125!5m2!1sen!2s"
                                            width="100%" height="300" style="border:0;" allowfullscreen=""
                                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div> --}}
                                    <input type="hidden" name="latitude" id="latitude">
                                    <input type="hidden" name="longitude" id="longitude">
                                </div>
                            </div>

                        </div>
                        {{-- <div id="map"></div> --}}


                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- JAVASCRIPT -->
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    {{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> --}}

    {{-- <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script> --}}

    <script src="dash-assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Include Leaflet JavaScript -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js"></script> --}}

    {{-- <script src="dash-assets/libs/simplebar/simplebar.min.js"></script>
    <script src="dash-assets/libs/node-waves/waves.min.js"></script>
    <script src="dash-assets/libs/feather-icons/feather.min.js"></script>
    <script src="dash-assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="dash-assets/js/plugins.js"></script>
    <!-- apexcharts -->
    <script src="dash-assets/libs/apexcharts/apexcharts.min.js"></script>
    <!-- Vector map-->
    <script src="dash-assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="dash-assets/libs/jsvectormap/maps/world-merc.js"></script>
    <!--Swiper slider js-->
    <script src="dash-assets/libs/swiper/swiper-bundle.min.js"></script>
    <!-- Dashboard init -->
    <script src="dash-assets/js/pages/dashboard-ecommerce.init.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script> --}}
    <!-- App js -->
    {{-- <script src="dash-assets/js/app.js"></script> --}}
    <script type="text/javascript">
        var currentStep = 1;
        var updateProgressBar;

        function displayStep(stepNumber) {
            if (stepNumber >= 1 && stepNumber <= 4) {
                $(".step-" + currentStep).hide();
                $(".step-" + stepNumber).show();
                currentStep = stepNumber;
                updateProgressBar();
            }
        }

        function validateStep(stepNumber) {
            var isValid = true;
            switch (stepNumber) {
                case 1:
                    var businessName = $("input[name='business_name']").val();
                    if (businessName.trim() === "") {
                        // alert("Business name is required.");
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Business name is required!',
                        });
                        isValid = false;
                    }
                    break;
                case 2:
                    if ($("input[type='checkbox']:checked").length == 0) {
                        // alert("Please select at least one service.");
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Please select at least one service!',
                        });
                        isValid = false;
                    } else if ($("input[type='checkbox']:checked").length > 3) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Select services can not greater then 3!',
                        });
                        isValid = false;
                    }
                    break;
                case 3:
                    if ($("input[name='team_size']:checked").length == 0) {
                        // alert("Please select a team size.");
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Please select a team size!',
                        });

                        isValid = false;
                    }
                    break;
                    // Add more validations as needed for other steps
            }
            return isValid;
        }

        $(document).ready(function() {
            $('#multi-step-form').find('.step').slice(1).hide();
            $(".next-step").click(function() {
                if (validateStep(currentStep)) {
                    if (currentStep < 4) {
                        $(".step-" + currentStep).addClass("animate__animated animate__fadeOutLeft");
                        currentStep++;
                        setTimeout(function() {
                            $(".step").removeClass("animate__animated animate__fadeOutLeft").hide();
                            $(".step-" + currentStep).show().addClass(
                                "animate__animated animate__fadeInRight");
                            updateProgressBar();
                        }, 500);
                    }
                }
            });
            $(".prev-step").click(function() {
                if (currentStep > 1) {
                    $(".step-" + currentStep).addClass("animate__animated animate__fadeOutRight");
                    currentStep--;
                    setTimeout(function() {
                        $(".step").removeClass("animate__animated animate__fadeOutRight").hide();
                        $(".step-" + currentStep).show().addClass(
                            "animate__animated animate__fadeInLeft");
                        updateProgressBar();
                    }, 500);
                }
            });
            updateProgressBar = function() {
                var progressPercentage = ((currentStep - 1) / 4) * 100;
                $(".progress-bar").css("width", progressPercentage + "%");
            }
        });
    </script>
    {{-- <script type="text/javascript">
        var currentStep = 1;
        var updateProgressBar;

        function displayStep(stepNumber) {
            if (stepNumber >= 1 && stepNumber <= 4) {
                $(".step-" + currentStep).hide();
                $(".step-" + stepNumber).show();
                currentStep = stepNumber;
                updateProgressBar();
            }
        }
        $(document).ready(function() {
            $('#multi-step-form').find('.step').slice(1).hide();
            $(".next-step").click(function() {
                if (currentStep < 4) {
                    $(".step-" + currentStep).addClass("animate__animated animate__fadeOutLeft");
                    currentStep++;
                    setTimeout(function() {
                        $(".step").removeClass("animate__animated animate__fadeOutLeft").hide();
                        $(".step-" + currentStep).show().addClass(
                            "animate__animated animate__fadeInRight");
                        updateProgressBar();
                    }, 500);
                }
            });
            $(".prev-step").click(function() {
                if (currentStep > 1) {
                    $(".step-" + currentStep).addClass("animate__animated animate__fadeOutRight");
                    currentStep--;
                    setTimeout(function() {
                        $(".step").removeClass("animate__animated animate__fadeOutRight").hide();
                        $(".step-" + currentStep).show().addClass(
                            "animate__animated animate__fadeInLeft");
                        updateProgressBar();
                    }, 500);
                }
            });
            updateProgressBar = function() {
                var progressPercentage = ((currentStep - 1) / 4) * 100;
                $(".progress-bar").css("width", progressPercentage + "%");
            }
        });
    </script> --}}


    <!-- Initialize the autocomplete feature using Geoapify's library -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/@geoapify/geocoder-autocomplete@1.0.0/dist/geocoder-autocomplete.min.js"></script> --}}
    {{-- <script>
        function initAutocomplete() {
            var input = document.getElementById('addressInput');
            var autocomplete = new GeocoderAutocomplete(input);
            autocomplete.on('select', function(event) {
                var place = event.suggestion;
                var latitude = place.location.lat;
                var longitude = place.location.lng;
                console.log('Latitude:', latitude);
                console.log('Longitude:', longitude);
            });
        }
        initAutocomplete();
    </script> --}}

    {{-- <script>
        function initAutocomplete() {
            var input = document.getElementById('addressInput');
            var autocomplete = new GeocoderAutocomplete(input, {
                apiKey: '08bc3fa941a845cdbbf91465149c74bb', // Replace with your actual API key
                countries: 'us', // Limit suggestions to the United States (optional)
            });

            autocomplete.on('select', function(event) {
                var place = event.suggestion;
                var latitude = place.location.lat;
                var longitude = place.location.lng;
                console.log('Latitude:', latitude);
                console.log('Longitude:', longitude);
            });
        }

        // Call the initAutocomplete function after the library is loaded
        window.addEventListener('load', initAutocomplete);
    </script> --}}


    <script>
        $(document).ready(function() {

            // use code for nomintim api
            // var suggestionsContainer = $("#suggestionsContainer");
            // $("#addressInput").autocomplete({
            //     source: function(request, response) {
            //         var searchTerm = request.term;
            //         performAddressSearch(searchTerm, response);
            //     },
            //     minLength: 1,
            //     select: function(event, ui) {
            //         $("#addressInput").val(ui.item.value);
            //         var selectedAddress = ui.item.value;
            //         console.log("location:" + ui.item.latitude + " long:" + ui.item.longitude);
            //         // getCoordinates(selectedAddress);

            //         event.preventDefault();
            //     },
            //     appendTo: "#suggestionsContainer"
            // }).autocomplete("instance")._renderItem = function(ul, item) {
            //     return $("<li>").append("<div>" + item.label + "</div>").appendTo(ul);
            // };


            // function performAddressSearch(searchTerm, response) {
            //     console.log("perfome");
            //     var apiUrl = "https://nominatim.openstreetmap.org/search?format=json&limit=10&q=" +
            //         encodeURIComponent(
            //             searchTerm);
            //     $.ajax({
            //         url: apiUrl,
            //         dataType: "json",
            //         success: function(data) {
            //             console.log(data);
            //             var suggestions = [];
            //             for (var i = 0; i < data.length; i++) {
            //                 suggestions.push({
            //                     value: data[i].display_name,
            //                     label: data[i].display_name,
            //                     latitude: parseFloat(data[i].lat),
            //                     longitude: parseFloat(data[i].lon),
            //                 });
            //                 // console.log(data[1])
            //             }

            //             response(suggestions);
            //         },
            //         error: function() {}
            //     });
            // }


            // use for geocode api
            var suggestionsContainer = $("#suggestionsContainer");
            $("#addressInput").autocomplete({
                source: function(request, response) {
                    var searchTerm = request.term;
                    performAddressSearch(searchTerm, response);
                },
                minLength: 3,
                select: function(event, ui) {
                    $("#addressInput").val(ui.item.value);
                    var selectedAddress = ui.item.value;
                    console.log("location:" + ui.item.latitude + " long:" + ui.item.longitude);
                    event.preventDefault();
                },
                appendTo: "#suggestionsContainer"
            }).autocomplete("instance")._renderItem = function(ul, item) {
                return $("<li>").append("<div>" + item.label + "</div>").appendTo(ul);
            };

            function performAddressSearch(searchTerm, response) {
                var apiUrl = "https://geocode.maps.co/search?q=" + encodeURIComponent(searchTerm) +
                    "&api_key={{ env('GEOCODE_API_KEY') }}";
                $.ajax({
                    url: apiUrl,
                    dataType: "json",
                    success: function(data) {
                        var suggestions = [];
                        for (var i = 0; i < data.length; i++) {
                            suggestions.push({
                                value: data[i].display_name,
                                label: data[i].display_name,
                                latitude: parseFloat(data[i].lat),
                                longitude: parseFloat(data[i].lon),
                                place_id: data[i].place_id,
                            });
                        }
                        response(suggestions);
                    },
                    error: function() {}
                });
            }



            // // Create a Leaflet map
            // var map = L.map('map').setView([51.505, -0.09], 13); // Set initial coordinates and zoom level

            // // Add a tile layer (you can choose other tile providers)
            // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            //     attribution: '© OpenStreetMap contributors'
            // }).addTo(map);

            // $("#addressInput").on('autocompleteselect', function(event, ui) {
            //     var latitude = ui.item.latitude;
            //     var longitude = ui.item.longitude;

            //     // Update map center
            //     map.setView([latitude, longitude], 13);

            //     // Add a marker
            //     L.marker([latitude, longitude]).addTo(map);
            // });

            // var map = L.map('map').setView([51.505, -0.09], 13);

            // // L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            // //     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            // // }).addTo(map);
            // L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            //     maxZoom: 19,
            //     attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            // }).addTo(map);
            var latitude;
            var longitude;

            $("#addressInput").on('autocompleteselect', function(event, ui) {
                console.log(ui.item)
                latitude = ui.item.latitude;
                longitude = ui.item.longitude;
                city = ui.item.city;
                state = ui.item.state;
                country = ui.item.country;
                countryCode = ui.item.countryCode;
                place_id = ui.item.place_id;
                console.log('place_id', place_id)
                $('#latitude').val(latitude);
                $('#longitude').val(longitude);
                // Update map iframe
                $('.gmap_iframe').attr('src', 'https://maps.google.com/maps?q=' + latitude + ',' +
                    longitude + '&t=k&z=16&ie=UTF8&iwloc=&output=embed');

                // Update map center
                // map.setView([latitude, longitude], 13);

                // Add a marker
                // L.marker([latitude, longitude]).addTo(map);
            });

            $("#dntHaveAddress").change(function() {
                if ($(this).is(":checked")) {
                    $("#addressInput").prop("disabled", true);
                    $("#addressInput").val("");
                    $("#suggestionsContainer").hide();
                    $('.mapouter').hide();
                    $('#latitude').val("");
                    $('#longitude').val("");
                } else {
                    $("#addressInput").prop("disabled", false);
                    $("#suggestionsContainer").show();
                    $('.mapouter').show();
                    $('#latitude').val(latitude);
                    $('#longitude').val(longitude);
                }
            });

        });
    </script>

</body>

</html>
