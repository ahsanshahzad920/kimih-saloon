@extends('user.layouts.app')

@section('title', 'Shop Services')
@section('styles')
    <!-- App Css-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="{{ asset('dash-assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('virtual-select-master/dist/virtual-select.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('pick-hours-availability/css/mark-your-calendar.css') }}" />

    <style>
        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            background-color: #9a2c47;
            /* Change this color to your desired color */
            border-bottom: 2px solid white;
            /* Optional: Add a border at the bottom */
            color: white !important;
        }

        .tr {
            cursor: pointer;
        }
    </style>

@endsection
@section('content')


    <div class="container-fluid booking-cart mt-5" style="margin-bottom: 250px">
        <div class="row">

            <div class="col-lg-8" id="toggleDiv">
                <h2 class="mb-3">Select Services</h2>

                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        @foreach ($user->serviceCategory as $index => $category)
                            <button class="nav-link text-dark {{ $loop->first ? 'active' : '' }}"
                                id="nav-{{ $category->id }}-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-{{ $category->id }}" type="button" role="tab"
                                aria-controls="nav-{{ $category->name }}"
                                aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                {{ $category->name }}
                            </button>
                        @endforeach
                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">
                    @foreach ($user->serviceCategory as $index => $category)
                        <div class="tab-pane fade px-2 {{ $loop->first ? 'show active' : '' }}"
                            id="nav-{{ $category->id }}" role="tabpanel" aria-labelledby="nav-{{ $category->id }}-tab"
                            tabindex="0">
                            <div class="row my-3">
                                <!-- You can add content here if needed -->
                            </div>
                            <div class="services-booking-card table">
                                @foreach ($category->services as $service)
                                    <div class="card tr" data-details="{{ json_encode($service) }}">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <h5>{{ $service->service_name ?? '' }}</h5>
                                                    <p>{{ $service->duration ?? '' }}</p>
                                                </div>
                                                <div class="col-lg-4 text-end">
                                                    <h6>AED {{ $service->price ?? '' }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @if ($category->services->isEmpty())
                                    <div class="card d-flex justify-content-content p-4">
                                        No Service Found
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-4 border-left ">
                <div class="">
                    {{-- <div class="form-group mt-2 mb-3">
                        <label for="customers" class="mb-1 fw-bold">Client <span class="text-danger">*</span></label>
                        <select class="form-control form-select subheading mt-1" aria-label="Default select example"
                            name="client_id" id="client_id">
                            <option value="">Select Clients</option>

                        </select>
                    </div> --}}
                    <div class=" mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ isset($user->businessUser->images[0]) ? asset('storage/' . $user->businessUser->images[0]['image']) : asset('assets/images/shope.png') }}"
                                    class="img-fluid rounded-start" alt="Image Not Found">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $user->businessUser->business_name }}</h5>
                                    {{-- <p class="card-text"><i class="flaticon-star "></i> 4.8 (3,443)</p> --}}
                                    <p class="card-text"><small
                                            class="text-body-secondary">{{ $user->businessUser->city ?? '' }}
                                            ,{{ $user->businessUser->country ?? '' }}</small></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-2 mb-3" id="dateTimeDiv" style="display: none">
                        <div class="mb-2">
                            <i class="bi bi-calendar"></i>
                            <span id="selected-date" class="ms-2">06-05-24</span>
                        </div>
                        <div>
                            <i class="bi bi-alarm"></i>
                            <span id="selected-time" class="ms-2">07:00pm</span>
                            <span id="totalDuration"></span>
                        </div>
                        <input type="hidden" name="selected-date-input" id="selected-date-input">
                        <input type="hidden" name="selected-time-input" id="selected-time-input">
                        <input type="hidden" name="totalDurationInput" id="totalDurationInput">
                    </div>

                    <div class="services-wraper cart-list" id="cart-list" style="max-height:300px;overflow-y:auto;">


                    </div>

                    <div class="mt-4">

                        <div class="d-flex justify-content-between align-items-center mb-2" id="grandTotalDiv">
                            <h6>Total:</h6>
                            <span class=" fw-bold" id="total">AED 0.00</span>
                        </div>
                        <ul style="display: none;" id="tax-info">
                            <li style="list-style-type: none;" class="fw-bold">Excluding Taxes</li>
                            <li>2.5% our fee</li>
                            <li>Stripe fee + 1aed</li>

                        </ul>
                        <hr>
                        <div class="d-flex justify-content-end">
                            <button id="payButton" class="me-2 btn btn-outline-dark" style="display:none;">
                                Pay through Wallet
                            </button>
                            <button class="btn default-btn text-white text-end" type="button" id="continue">
                                Continue</button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- container-fluid -->


@endsection
@section('top-scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('virtual-select-master/dist/virtual-select.min.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
    <script src="{{ asset('pick-hours-availability/js/mark-your-calendar.js') }}"></script>

    <script>
        $(document).ready(function() {
            let taxedAmount = 0;
            let time_slots = @json($time_slots);

            // VirtualSelect.init({
            //     ele: '#example-select',
            //     search: true,
            // });
            // Add click event handler to all table rows
            $('.table .tr').click(function() {
                var details = $(this).data('details');
                console.log(details);
                // return;
                details.name = details.service_name;
                details.pr

                // Check if the cartItem already exists in the cart-list
                var exists = false;
                $('#cart-list .item').each(function() {
                    var existingDetails = $(this).data('details');
                    if (existingDetails.id === details.id) {
                        exists = true;
                        return false; // Break the loop
                    }
                });
                // console.log(details);
                if (exists) {
                    alert('Item already exists in the cart');
                    return;
                }

                let cartItem;
                cartItem = `

                    <div class="card item" data-details='${JSON.stringify(details)}'>
                        <div class="card-body">
                            <div class="row">
                                <div class="d-flex justify-content-between">
                                    <h5>${details.name ?? ''}</h5>
                                <div>

                                <a href="#" class="ms-2 trash-btn" style="cursor:pointer;">
                                            <i class="bi bi-trash-fill text-danger"></i>
                                </a>
                            </div>

                        </div>
                                            <div class="d-flex justify-content-between">
                            <span>${details.duration ?? ''} . ${details.available_for ?? ''}</span>
                            <span>AED ${details.price}</span>
                        </div>
                                        </div>
                                    </div>
                     </div>
                    `;

                // Append the cart item to the cart-list div
                $('#cart-list').append(cartItem);
                calculate()
            });

            // Add click event handler to trash buttons within the cart items
            $('#cart-list').on('click', '.trash-btn', function() {
                // Find the parent cart item and remove it
                $(this).closest('.item').remove();
                calculate();
            });

            // function calculate() {
            //     var grand_total = 0;
            //     var total = 0;
            //     let durations = [];
            //     $('.item').each(function() {
            //         if (parseFloat($(this).data('details').price)) {
            //             let price = parseFloat($(this).data('details').price);
            //             total += price;
            //             durations.push($(this).data('details').duration);
            //         }
            //     });

            //     function taxCalculator(originalAmount) {
            //         // Constants for fees
            //         const percentageFee = 2.5 / 100;
            //         const stripeFee = 1;
            //         const textFee = 0.15;
            //         const emailFee = 0.05;

            //         // Calculate fees
            //         const percentageFeeAmount = originalAmount * percentageFee;
            //         const totalFees = percentageFeeAmount + stripeFee + textFee + emailFee;

            //         // Calculate total amount
            //         const totalAmount = originalAmount + totalFees;

            //         return Math.floor(totalAmount);
            //     }

            //     function calculateTotalDuration(timeValues) {
            //         let totalMinutes = 0;

            //         for (const value of timeValues) {
            //             const [hours, minutes] = value.split(' ');
            //             const hoursInMinutes = parseInt(hours) * 60;
            //             const minutesValue = parseInt(minutes) || 0;
            //             totalMinutes += hoursInMinutes + minutesValue;
            //         }

            //         const totalHours = Math.floor(totalMinutes / 60);
            //         const remainingMinutes = totalMinutes % 60;

            //         return `${totalHours}h ${remainingMinutes}min`;
            //     }
            //     let totalDuration = calculateTotalDuration(durations);

            //     $('#totalDuration').text(` (${totalDuration})`);
            //     $('#totalDurationInput').val(totalDuration);

            //     // let userBalance = {{ auth()->user()->balance ?? 0 }};
            //     let amountWithTax = taxCalculator(total);

            //     $('#total').text(`$${amountWithTax}`);

            //     function checkBalance() {
            //         let payButton = document.getElementById('payButton'); // Make sure the pay button has this ID

            //         if (userBalance >= amountWithTax && $('#picker')) {
            //             payButton.style.display = 'block'; // Show the pay button
            //         } else {
            //             payButton.style.display = 'none'; // Hide the pay button
            //         }
            //     }

            //     // Call the function to check the balance
            //     // checkBalance();
            // }

            async function getExchangeRate(fromCurrency, toCurrency) {
                const response = await fetch(`https://api.exchangerate-api.com/v4/latest/${fromCurrency}`);
                const data = await response.json();
                return data.rates[toCurrency];
            }

            async function taxCalculator(originalAmount) {
                // Constants for fees in AED
                const ourFeeRate = 0.025;
                const stripeFeeRate = 0.029; // Example Stripe fee rate (2.9%)
                const stripeFixedFeeAED = 1; // Fixed fee in AED
                const textFeeAED = 0.15;
                const emailFeeAED = 0.05;

                // Calculate the fees
                const ourFee = originalAmount * ourFeeRate;
                const stripeFee = (originalAmount * stripeFeeRate) + stripeFixedFeeAED;
                const totalTextFee = textFeeAED * 2; // Assuming 2 texts
                const totalEmailFee = emailFeeAED; // Assuming 1 email

                // Calculate the total amount
                const totalAmount = originalAmount + ourFee + stripeFee + totalTextFee + totalEmailFee;

                return Math.floor(totalAmount);
            }

            async function calculate() {
                var grand_total = 0;
                var total = 0;
                let durations = [];
                $('.item').each(function() {
                    if (parseFloat($(this).data('details').price)) {
                        let price = parseFloat($(this).data('details').price);
                        total += price;
                        durations.push($(this).data('details').duration);
                    }
                });

                function calculateTotalDuration(timeValues) {
                    let totalMinutes = 0;

                    for (const value of timeValues) {
                        const [hours, minutes] = value.split(' ');
                        const hoursInMinutes = parseInt(hours) * 60;
                        const minutesValue = parseInt(minutes) || 0;
                        totalMinutes += hoursInMinutes + minutesValue;
                    }

                    const totalHours = Math.floor(totalMinutes / 60);
                    const remainingMinutes = totalMinutes % 60;

                    return `${totalHours}h ${remainingMinutes}min`;
                }

                let totalDuration = calculateTotalDuration(durations);

                $('#totalDuration').text(` (${totalDuration})`);
                $('#totalDurationInput').val(totalDuration);

                // let userBalance = {{ auth()->user()->balance ?? 0 }};
                let amountWithTax = await taxCalculator(total);
                console.log('sldfjdlfkj', amountWithTax);
                taxedAmount = amountWithTax;

                $('#total').text(`AED ${total}`);

                function checkBalance() {
                    let payButton = document.getElementById('payButton'); // Ensure this ID matches your HTML

                    if (userBalance >= amountWithTax && $('#picker').length) {
                        payButton.style.display = 'block'; // Show the pay button
                    } else {
                        payButton.style.display = 'none'; // Hide the pay button
                    }
                }

                // Call the function to check the balance
                checkBalance();
            }

            // Call calculate function when needed
            calculate();


            // function initializeCalendarPicker(time_slots) {

            //     console.log(time_slots)
            //     $("#picker").markyourcalendar({
            //         // availability: [
            //         //     ["1:00", "2:00", "3:00", "4:00", "5:00","6:00", "7:00", "8:00","9:00","9:15","9:30",],
            //         //     ["2:00"],
            //         //     ["3:00"],
            //         //     ["4:00"],
            //         //     ["5:00"],
            //         //     ["6:00"],
            //         //     ["7:00"],
            //         // ],
            //         availability : time_slots,
            //         startDate: new Date(),
            //         onClick: function(ev, data) {
            //             // data is a list of datetimes
            //             var d = data[0].split(" ")[0];
            //             var t = data[0].split(" ")[1];
            //             $("#dateTimeDiv").show();
            //             var formatedTime = `${d} ${t}`;
            //             function formatDateTime(dateTimeStr) {
            //                 const dateTime = new Date(dateTimeStr);

            //                 // Format date to 'Monday 10 Jan'
            //                 const dateOptions = { weekday: 'long', day: 'numeric', month: 'short' };
            //                 const formattedDate = dateTime.toLocaleDateString('en-GB', dateOptions);

            //                 // Format time to '09:00pm'
            //                 const timeOptions = { hour: 'numeric', minute: 'numeric', hour12: true };
            //                 const formattedTime = dateTime.toLocaleTimeString('en-GB', timeOptions);

            //                 return {
            //                     date: formattedDate,
            //                     time: formattedTime
            //                 };
            //             }
            //             let dateTime = formatDateTime(formatedTime);
            //             $("#selected-date").html(dateTime.date);
            //             $("#selected-time").html(dateTime.time);
            //         },
            //         onClickNavigator: function(ev, instance) {
            //             var arr = [
            //                 // [
            //                 //     ["4:00", "5:00", "6:00", "7:00", "8:00","9:00","9:15","9:30","9:45","10:00","10:15","10:30","10:45","10:45"],
            //                 //     ["1:00", "5:00"],
            //                 //     ["2:00", "5:00"],
            //                 //     ["3:30"],
            //                 //     ["2:00", "5:00"],
            //                 //     ["2:00", "5:00"],
            //                 //     ["2:00", "5:00"],
            //                 // ],
            //                 time_slots,

            //             ];
            //             instance.setAvailability(arr[0]);
            //         },
            //     });
            // }


            $(document).on('click', '#continue', function() {
                // function taxCalculator(originalAmount) {
                //     // Constants for fees
                //     const percentageFee = 2.5 / 100;
                //     const stripeFee = 1;
                //     const textFee = 0.15;
                //     const emailFee = 0.05;

                //     // Calculate fees
                //     const percentageFeeAmount = originalAmount * percentageFee;
                //     const totalFees = percentageFeeAmount + stripeFee + textFee + emailFee;

                //     // Calculate total amount
                //     const totalAmount = originalAmount + totalFees;

                //     return Math.floor(totalAmount);
                // }


                let userBalance = {{ auth()->user()->balance ?? 0 }};
                // let amountWithTax = await taxCalculator(totalValue);
                // console.log('after tax', amountWithTax);

                function checkBalance() {
                    let payButton = document.getElementById(
                        'payButton'); // Make sure the pay button has this ID

                    if (userBalance >= taxedAmount && $('#picker')) {
                        payButton.style.display = 'block'; // Show the pay button
                    } else {
                        payButton.style.display = 'none'; // Hide the pay button
                    }
                }
                checkBalance();

                let taxInfo = document.getElementById('tax-info');
                taxInfo.style.display = 'block';


                let items = [];
                $('.item').each(function() {
                    items.push($(this).data('details'));
                });

                if (items.length === 0) {
                    // alert('Please select at least one service');
                    toastr.error('Please select at least one service');
                    return;
                }
                let client_id = 0;
                client_id = {{ auth()->id() ?? '0' }}
                if (client_id == '0') {
                    toastr.error('Please login to continue');
                    window.location.href = "{{ route('auth-for-customer') }}";
                    return;
                }


                let secondDiv =
                    `

                    <div class="col-lg-12" id="toggleDiv">
                        <h2 class="mb-3 ">Select Professonal</h2>
                        <div class="col-12 mt-4 mb-3">
                            <div class="mb-3">
                                <label class="form-label">Select Team Member</label>
                                <select class="" name="member"
                                    id="example-select" required>
                                    <option disabled>Select Member</option>
                                    @foreach ($user->teamMember as $team_member)
                                        <option value="{{ $team_member->id }}">
                                            {{ $team_member->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="picker"></div>
                    </div>

                `;

                // Show the spinner for 1 seconds
                $('#toggleDiv').html(`
                    <div class="d-flex justify-content-center align-items-center " style="height:400px;">
                        <div class="spinner-border text-danger" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                `);

                setTimeout(() => {
                    // After 1 second, replace the spinner with the secondDiv content
                    $('#toggleDiv').html(secondDiv);
                    // initializeCalendarPicker(time_slots); // Initialize the calendar picker
                    VirtualSelect.init({
                        ele: '#example-select',
                        search: true,
                    });
                    $('#continue').attr('id', 'createBooking');

                }, 1000);

                let data = {
                    items: items,
                    client_id: client_id
                };


            })

            $(document).on('change', '#example-select', function() {
                let member_id = $(this).val();

                $.ajax({
                    url: "{{ route('get-member-timeslotes') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        member_id: member_id
                    },
                    success: function(response) {
                        if (response.status) {
                            time_slots = response.time_slots;
                            // Initialize the calendar picker with the new time slots
                            initializeCalendarPicker(time_slots);
                        }
                    }
                });
            });


            function initializeCalendarPicker(time_slots) {

                console.log(time_slots)
                $("#picker").markyourcalendar({
                    availability: time_slots,
                    startDate: new Date(),
                    onClick: function(ev, data) {
                        // data is a list of datetimes
                        if (data && data.length > 0 && data[0].split) {
                            var d = data[0].split(" ")[0];
                            var t = data[0].split(" ")[1];
                            $("#dateTimeDiv").show();
                            var formatedTime = `${d} ${t}`;

                            function formatDateTime(dateTimeStr) {
                                const dateTime = new Date(dateTimeStr);

                                // Format date to 'Monday 10 Jan'
                                const dateOptions = {
                                    weekday: 'long',
                                    day: 'numeric',
                                    month: 'short'
                                };
                                const formattedDate = dateTime.toLocaleDateString('en-GB', dateOptions);

                                // Format time to '09:00pm'
                                const timeOptions = {
                                    hour: 'numeric',
                                    minute: 'numeric',
                                    hour12: true
                                };
                                const formattedTime = dateTime.toLocaleTimeString('en-GB', timeOptions);

                                return {
                                    date: formattedDate,
                                    time: formattedTime
                                };
                            }
                            let dateTime = formatDateTime(formatedTime);
                            $("#selected-date").html(dateTime.date);
                            $("#selected-time").html(dateTime.time);
                            $('#selected-date-input').val(d);
                            $('#selected-time-input').val(t);
                        }
                    },
                    onClickNavigator: function(ev, instance) {
                        var arr = [
                            time_slots,
                        ];
                        instance.setAvailability(arr[0]);
                    },
                });
            }

            $(document).on('click', '#createBooking', function() {
                let items = [];
                let serviceIds = [];
                let totalDuration
                $('.item').each(function() {
                    items.push($(this).data('details'));
                    serviceIds.push($(this).data('details').id);
                });

                if (items.length === 0) {
                    // alert('Please select at least one service');
                    toastr.error('Please select at least one service');
                    window.location.href = "/shop/{{ $user->businessUser->slug }}/services/1/booking";
                    return;
                }
                let client_id = 0;
                client_id = {{ auth()->id() ?? '0' }}
                if (client_id == '0') {
                    toastr.error('Please login to continue');
                    window.location.href = "{{ route('auth-for-customer') }}";
                    return;
                }

                if ($('#example-select').val() == '') {
                    toastr.error('Please select a team member');
                    return;
                }

                var startTime = $('#selected-date-input').val() + 'T' + $('#selected-time-input').val();
                var duration = $('#totalDurationInput').val();

                let durationInSeconds = durationToSeconds(duration);

                const endTime = calculateEndTime(startTime, durationInSeconds);
                console.log(
                    `Start time: ${startTime}, Duration: ${durationInSeconds} seconds, End time: ${endTime}`
                );


                $.ajax({
                    type: "post",
                    // url: "{{ route('booking.store') }}",
                    url: "{{ route('booking.stripe.checkout') }}",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        title: items[0].service_name,
                        start: startTime,
                        end: endTime,
                        description: items[0].service_description,
                        location: "{{ $user->businessUser->location }}",
                        color: "bg-dark-subtle",
                        services: serviceIds,
                        client_id: client_id,
                        business_id: {{ $user->id }},
                        team_member_id: $('#example-select').val(),
                    },
                    success: function(response) {
                        if (response.status) {
                            toastr.success(response.message);
                            // window.location.href = "{{ route('customer.appointments') }}";
                            window.location.href = response.url;
                        }
                    }
                });


            });

            // pay through wallet
            // $(document).on('click', '#payButton', function() {
            //     let items = [];
            //     let serviceIds = [];
            //     let totalDuration
            //     $('.item').each(function() {
            //         items.push($(this).data('details'));
            //         serviceIds.push($(this).data('details').id);
            //     });

            //     if (items.length === 0) {
            //         // alert('Please select at least one service');
            //         toastr.error('Please select at least one service');
            //         window.location.href = "/shop/{{ $user->businessUser->slug }}/services/1/booking";
            //         return;
            //     }
            //     let client_id = 0;
            //     client_id = {{ auth()->id() ?? '0' }}
            //     if (client_id == '0') {
            //         toastr.error('Please login to continue');
            //         window.location.href = "{{ route('auth-for-customer') }}";
            //         return;
            //     }

            //     if ($('#example-select').val() == '') {
            //         toastr.error('Please select a team member');
            //         return;
            //     }

            //     var startTime = $('#selected-date-input').val() + 'T' + $('#selected-time-input').val();
            //     var duration = $('#totalDurationInput').val();

            //     let durationInSeconds = durationToSeconds(duration);

            //     const endTime = calculateEndTime(startTime, durationInSeconds);
            //     console.log(
            //         `Start time: ${startTime}, Duration: ${durationInSeconds} seconds, End time: ${endTime}`
            //     );


            //     $.ajax({
            //         type: "post",
            //         url: "{{ route('booking.store') }}",
            //         // url: "{{ route('booking.stripe.checkout') }}",
            //         headers: {
            //             'X-CSRF-TOKEN': "{{ csrf_token() }}"
            //         },
            //         data: {
            //             title: items[0].service_name,
            //             start: startTime,
            //             end: endTime,
            //             description: items[0].service_description,
            //             location: "{{ $user->businessUser->location }}",
            //             color: "bg-dark-subtle",
            //             services: serviceIds,
            //             client_id: client_id,
            //             business_id: {{ $user->id }},
            //             team_member_id: $('#example-select').val(),
            //         },
            //         success: function(response) {
            //             if (response.status) {
            //                 toastr.success(response.message);
            //                 window.location.href = "{{ route('customer.appointments') }}";
            //                 // window.location.href = response.url;
            //             }
            //         }
            //     });


            // });

            $(document).on('click', '#payButton', function() {
                console.log('Pay button clicked');
                let items = [];
                let serviceIds = [];
                let totalDuration;

                $('.item').each(function() {
                    items.push($(this).data('details'));
                    serviceIds.push($(this).data('details').id);
                });

                if (items.length === 0) {
                    toastr.error('Please select at least one service');
                    window.location.href = "/shop/{{ $user->businessUser->slug }}/services/1/booking";
                    return;
                }

                let client_id = 0;
                client_id = {{ auth()->id() ?? '0' }};
                if (client_id == '0') {
                    toastr.error('Please login to continue');
                    window.location.href = "{{ route('auth-for-customer') }}";
                    return;
                }

                if ($('#example-select').val() == '') {
                    toastr.error('Please select a team member');
                    return;
                }

                var startTime = $('#selected-date-input').val() + 'T' + $('#selected-time-input').val();
                var duration = $('#totalDurationInput').val();

                let durationInSeconds = durationToSeconds(duration);

                const endTime = calculateEndTime(startTime, durationInSeconds);
                console.log(
                    `Start time: ${startTime}, Duration: ${durationInSeconds} seconds, End time: ${endTime}`
                );

                $.ajax({
                    type: "post",
                    url: "{{ route('booking.store') }}",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        title: items[0].service_name,
                        start: startTime,
                        end: endTime,
                        description: items[0].service_description,
                        location: "{{ $user->businessUser->location }}",
                        color: "bg-dark-subtle",
                        services: serviceIds,
                        client_id: client_id,
                        business_id: {{ $user->id }},
                        team_member_id: $('#example-select').val(),
                    },
                    success: function(response) {
                        if (response.status) {
                            toastr.success(response.message);
                            window.location.href = "{{ route('customer.appointments') }}";
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
            });



            // function parseDuration(durationStr) {
            //     // Regular expression to match hours and minutes
            //     const regex = /(\d+)\s*h(?:\s*(\d+)\s*min)?/i;
            //     const match = durationStr.match(regex);

            //     if (!match) {
            //         console.error('Invalid duration format:', durationStr);
            //         return null;
            //     }

            //     const hours = parseInt(match[1], 10);
            //     const minutes = match[2] ? parseInt(match[2], 10) : 0;

            //     return {
            //         hours,
            //         minutes
            //     };
            // }

            // function calculateEndTime(startTime, durationStr) {
            //     const parsedDuration = parseDuration(durationStr);
            //     if (!parsedDuration) {
            //         return null;
            //     }

            //     const startDate = new Date(startTime);
            //     const {
            //         hours,
            //         minutes
            //     } = parsedDuration;

            //     const endTime = new Date(startDate);
            //     endTime.setHours(endTime.getHours() + hours);
            //     endTime.setMinutes(endTime.getMinutes() + minutes);

            //     return endTime.toISOString(); // Format: YYYY-MM-DDTHH:mm:ss
            // }

            function calculateEndTime(start_time, durationInSeconds) {
                const startDateTime = new Date(start_time);

                // Add the duration in seconds to the start time
                startDateTime.setSeconds(startDateTime.getSeconds() + durationInSeconds);

                // Format the end time to YYYY-MM-DDTHH:mm
                const year = startDateTime.getFullYear();
                const month = String(startDateTime.getMonth() + 1).padStart(2, '0');
                const day = String(startDateTime.getDate()).padStart(2, '0');
                const hours = String(startDateTime.getHours()).padStart(2, '0');
                const minutes = String(startDateTime.getMinutes()).padStart(2, '0');

                return `${year}-${month}-${day}T${hours}:${minutes}`;
            }

            function durationToSeconds(durationStr) {
                // Regular expression to match hours and minutes
                const regex = /(\d+)\s*h(?:\s*(\d+)\s*min)?/i;
                const match = durationStr.match(regex);

                if (!match) {
                    console.error('Invalid duration format:', durationStr);
                    return null;
                }

                const hours = parseInt(match[1], 10);
                const minutes = match[2] ? parseInt(match[2], 10) : 0;

                // Convert hours and minutes to seconds
                const totalSeconds = hours * 3600 + minutes * 60;
                return totalSeconds;
            }


        });
    </script>

@endsection
