@extends('user.layouts.app')

@section('content')
    <div class="inner-banner">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-7 col-md-7">
                    <div class="inner-title">
                        <h3>Payment</h3>
                        <ul>
                            <li>
                                <a href="index.html">Home</a>
                            </li>
                            <li>Payment</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-5">
                    <div class="inner-img">
                        <img src="assets/images/security.png" alt="Inner Banner" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="checkout-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="checkout-coupon-form-area">
                                <form class="checkout-coupon-form">
                                    <input type="text" class="form-control" placeholder="Coupon Code">
                                    <button class="subscribe-btn" type="submit">
                                        Apply
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <form>
                        <div class="billing-details">
                            <h3 class="title">Billing Details</h3>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Country">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Address">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Address Link2">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Town / City">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Postcode / Zip">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Company Name">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Email Address ">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <textarea name="notes" id="notes" cols="30" rows="7" placeholder="Order Notes" class="form-message"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 text-center">
                                    <button type="submit" class="default-btn">
                                        Place an Order
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-5">
                    <div class="checkout-table ml-20 mb-30">
                        <h3>Your Order</h3>
                        <div class="checkout-box ">
                            <div class="services-wraper mb-5">
                                <div href="#" class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h5>Haircut and Beard Trim</h5>
                                                <p>50 mins - Hussain Mustaf</p>

                                            </div>
                                            <div class="col-lg-4 text-end">
                                                <h6>£45</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class=" d-flex justify-content-between align-items-center">
                                    <p>Subtotal</p>
                                    <p>AED 40</p>
                                </div>
                                <div class=" d-flex justify-content-between align-items-center">
                                    <p>Tax</p>
                                    <p>AED 0</p>
                                </div>
                                <hr>
                                <div class=" d-flex justify-content-between align-items-center">
                                    <p>To pay</p>
                                    <h6>AED 40</h6>
                                </div>
                                <button class="default-btn w-100 mt-4">Continue</button>
                            </div>
                        </div>
                    </div>
                    <div class="payment-box ml-20">
                        <div class="payment-method">
                            <h3>Payment Method</h3>
                            <p>
                                There are many variations of passages of Lorem Ipsum available, but the majority have
                                suffered
                                alteration in some form, by injehumour, or randomised words which don't look even slightly
                                believable.
                            </p>
                            <p>
                                <input type="radio" id="direct-bank-transfer" name="radio-group" checked>
                                <label for="direct-bank-transfer">Direct Bank Transfer</label>
                            </p>
                            <p>
                                <input type="radio" id="paypal" name="radio-group">
                                <label for="paypal">PayPal</label>
                            </p>
                            <p>
                                <input type="radio" id="cash-on-delivery" name="radio-group">
                                <label for="cash-on-delivery">Cash On Delivery</label>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
