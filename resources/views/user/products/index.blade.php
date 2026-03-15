<!doctype html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/iconplugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme-dark.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Star rating style --}}
    <style>
        .star-label {
            font-size: 30px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
    </style>
    <style>
        .product-card {
            /* border: 1px solid #ddd; */
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: box-shadow 0.3s;
        }

        .product-card:hover {
            box-shadow: 0 0 11px rgba(33, 33, 33, .2);
        }

        .product-img {
            max-height: 200px;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .product-price {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .product-save {
            color: green;
        }

        .nav-tabs .nav-link {
            margin-right: 1rem;
        }

        .cartQtyInput {
            width: 50px !important;
        }
    </style>
</head>

<body>

    <nav class="navbar bg-dark">
        <div class="container-fluid">
            <div class="d-flex justify-content-end w-100 p-2">
                <a class="fw-bolder text-white text-decoration-none" href="#" id="addToCartListButton"><i
                        class="bi bi-cart"></i>
                    Add To Cart (<span id="cart-count">{{ count($carts) }}</span>)</a>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <div class="text-center mb-4">
            <h1>{{ $shop->businessUser->business_name ?? '' }}</h1>
        </div>
        <nav class="my-5">
            <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">All Product</button>
                @foreach ($shop->product_categories as $category)
                    <button class="nav-link" id="nav-{{ $category->id }}-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-{{ $category->id }}" type="button" role="tab"
                        aria-controls="nav-{{ $category->id }}" aria-selected="false">{{ $category->name }}</button>
                @endforeach
                {{-- <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>
              <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button> --}}
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                tabindex="0">
                <div class="row mt-5">
                    @forelse ($shop->products as $product)
                        <div class="col-md-4 mb-4" style="cursor: pointer">
                            <div class="product-card">
                                <div class="viewProduct">
                                    <img src="{{ asset('/storage' . $product->images[0]['img_path']) }}"
                                        class="product-img" alt="No Image Found">
                                    <div class="product-price">AED {{ number_format($product->retail_price, 2) }} <span
                                            class="product-save">Save {{ $product->save_percentage }}%</span></div>
                                    <div>{{ $product->name }}</div>
                                </div>
                                <button class="btn btn-dark mt-3 add-to-cart " data-product="{{ $product }}">Add
                                    to cart</button>
                            </div>
                        </div>
                    @empty
                        <div class="card">
                            <div class="card-body">
                                No products found in this shop
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
            @foreach ($shop->product_categories as $category)
                <div class="tab-pane fade" id="nav-{{ $category->id }}" role="tabpanel"
                    aria-labelledby="nav-{{ $category->id }}-tab" tabindex="0">
                    <div class="row mt-5">
                        @forelse ($category->products as $product)
                            <div class="col-md-4 mb-4" style="cursor: pointer">
                                <div class="product-card">
                                    <div class="viewProduct">
                                        <img src="{{ asset('/storage' . $product->images[0]['img_path']) }}"
                                            class="product-img" alt="No Image Found">
                                        <div class="product-price">AED {{ number_format($product->retail_price, 2) }}
                                            <span class="product-save">Save {{ $product->save_percentage }}%</span>
                                        </div>
                                        <div>{{ $product->name }}</div>
                                    </div>
                                    <button class="btn btn-dark mt-3 add-to-cart "
                                        data-product="{{ $product }}">Add
                                        to cart</button>
                                </div>
                            </div>
                        @empty
                            <div class="card">
                                <div class="card-body">
                                    No products found in this category
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>



    {{-- Quick View Product Model  --}}
    <div class="modal fade productsQuickView" id="productsQuickView" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close-on" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="p-2">
                        <i class="flaticon-close"></i>
                    </span>
                </button>
                <div class="product-details-desc">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12">
                            <div class="products-quickView-image">
                                <img src="{{ empty($cart->product->images[0]['img_path']) ? 'https://via.placeholder.com/150' : asset('/storage' . $cart->product->images[0]['img_path']) }}"
                                    alt="Product Details">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="product-desc mb-30 pl-20">
                                <h3>Nail Polish Removers </h3>
                                <div class="price">
                                    <span class="old-price">$140.00 </span>
                                    <span class="new-price">- $110.00</span>
                                </div>
                                <div class="review-form">
                                    {{-- product-review.blade.php --}}

                                    <div class="">
                                        <div class="container">
                                            {{-- Rating --}}
                                            <div class="row">
                                                <div class="col-md-12 p-3">
                                                    <main class="d-flex">
                                                        <article class="me-3">
                                                            <form class="star">
                                                                <label class="star-label">
                                                                    ★
                                                                    <input type="radio" name="note"
                                                                        value="1">
                                                                </label>
                                                                <label class="star-label">
                                                                    ★
                                                                    <input type="radio" name="note"
                                                                        value="2">
                                                                </label>
                                                                <label class="star-label">
                                                                    ★
                                                                    <input type="radio" name="note"
                                                                        value="3">
                                                                </label>
                                                                <label class="star-label">
                                                                    ★
                                                                    <input type="radio" name="note"
                                                                        value="4">
                                                                </label>
                                                                <label class="star-label">
                                                                    ★
                                                                    <input type="radio" name="note"
                                                                        value="5">
                                                                </label>
                                                            </form>
                                                        </article>
                                                        @auth
                                                            <div class="review-form">
                                                                <form action="{{ route('product.review.store') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    {{-- User id --}}
                                                                    <div class="mb-3">
                                                                        <input type="hidden" name="user_id"
                                                                            id="user_id" value="{{ auth()->id() }}"
                                                                            class="form-control" />
                                                                    </div>
                                                                    {{-- Product id --}}
                                                                    <div class="mb-3">
                                                                        <input type="hidden" name="product_id"
                                                                            id="product_id" value=""
                                                                            class="form-control" />
                                                                    </div>
                                                                    {{-- Rating number --}}
                                                                    <div class="mb-3">
                                                                        <input type="hidden" name="rating"
                                                                            id="rating" class="form-control" />
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-outline-primary">
                                                                        Submit review
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        @endauth
                                                    </main>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 p-3">
                                                    {{-- <div class="reviews-container">
                                                        <!-- Reviews will be displayed here -->
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <p> Voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab
                                    illo
                                    inventore veritatis et quasi. </p>
                                <ul class="product-category-list">
                                    <li>Availablity: <span>In Stock</span></li>
                                    {{-- <li>Tags: <span id="tags">Nail, Lover</span> </li> --}}
                                </ul>
                                <div class="reviews-container">
                                    <!-- Reviews will be displayed here -->
                                </div>
                                <input type="hidden" value="1" id="qty">
                                {{-- <div class="input-counter-area">
                                    <h4>Quantity</h4>
                                    <div class="input-counter">
                                        <span class="minus-btn">
                                            <i class="ri-add-fill"></i>
                                        </span>
                                        <input type="text" value="1" id="qty">
                                        <span class="plus-btn">
                                            <i class="ri-subtract-line"></i>
                                        </span>
                                    </div>
                                </div> --}}
                                <div class="product-add-btn">
                                    {{-- <button type="submit" class="default-btn border-radius-5"> Add To Cart <i
                                            class="flaticon-shopping-cart-empty-side-view"></i>
                                    </button> --}}
                                    {{-- <ul class="products-action">
                                        <li>
                                            <a href="#">
                                                <i class="ri-arrow-left-right-line"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="ri-heart-line"></i>
                                            </a>
                                        </li>
                                    </ul> --}}
                                </div>
                                <div class="product-share">
                                    <ul>
                                        <li>
                                            <span>Share:</span>
                                        </li>
                                        <li>
                                            <a href="https://twitter.com/" target="_blank">
                                                <i class="ri-twitter-fill"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.linkedin.com/" target="_blank">
                                                <i class="ri-linkedin-fill"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.facebook.com/" target="_blank">
                                                <i class="ri-facebook-fill"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://vimeo.com/" target="_blank">
                                                <i class="ri-vimeo-fill"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample"
        aria-labelledby="offcanvasExampleLabel" style="width: 530px">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Cart List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            {{-- @forelse ($carts as $cart)

            @empty

            @endforelse --}}
            <div class="cart-list">
                @forelse ($carts as $cart)
                    <div class=" card mb-3 " data-cart-id="{{ $cart->id }}"
                        data-product-id="{{ $cart->product->id }}" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4 d-flex align-items-center">
                                <img src="{{ empty($cart->product->images[0]['img_path']) ? 'https://via.placeholder.com/150' : asset('/storage' . $cart->product->images[0]['img_path']) }}"
                                    class="img-fluid rounded-start" alt="Image Not Found">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $cart->product->name ?? '' }}</h5>
                                    <p class="card-text">{{ $cart->product->measureType ?? '' }}
                                        {{ $cart->product->amount ?? '' }}</p>
                                    <p class="card-text">AED {{ $cart->product->retail_price ?? '' }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="input-counter-area">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-secondary cart-minus-btn" type="button">
                                                        <i class="ri-subtract-line"></i>
                                                    </button>
                                                </span>
                                                <input type="text" class="form-control cartQtyInput p-1"
                                                    value="1">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-secondary cart-plus-btn" type="button">
                                                        <i class="ri-add-fill"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <i class="bi bi-trash remove text-danger fs-5"
                                                style="cursor: pointer"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card notFoundCart" id="notFoundCart">
                        <div class="card-body">
                            No Cart Found
                        </div>
                    </div>
                @endforelse
            </div>
            <hr>
            <div class="d-flex justify-content-between p-2 mt-3">
                <span class="fw-bold">Total</span>
                <span class="fw-bold">AED <span class="grand_total">200.00</span></span>
            </div>
            <ul id="tax-info">
                <li style="list-style-type: none;" class="fw-bold">Excluding Taxes</li>
                <li>2.5% our fee</li>
                <li>Stripe fee + 1aed</li>

            </ul>
            {{-- <form action="{{ route('stripe.checkout') }}" method="GET">
                @csrf
                <x-form.input type="hidden" name="event_id" id="form_event_id" />
                <x-form.input type="hidden" name="event_price" id="even_price" />
                <x-form.input type="hidden" name="event_title" id="event_title" />
                @auth
                    @if (isset(auth()->user()->paid_event_id))
                        <button type="button" class="btn btn-success w-100">
                            Paid
                        </button>
                    @else
                        <button type="submit" class="btn btn-primary w-100">
                            Pay now
                        </button>
                    @endif
                @endauth

            </form> --}}
            <div class="d-flex justify-content-end mt-2">
                <button class="btn btn-primary btn-dark" id="checkoutBtn">Checkout</button>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    {{-- Star Rating --}}
    <script>
        const LABELCOLORINACTIV = "#dccfcf";
        const LABELCOLORACTIV = "#4dc717";

        const RATINGSLABELS = document.querySelectorAll("form.star label");
        const RATINGSINPUTS = document.querySelectorAll("form.star input");

        // make inputs disappear
        RATINGSINPUTS.forEach(function(anInput) {
            anInput.style.display = "none";
        });

        // manage label click & hover display
        function notationLabels(e) {
            let currentLabelRed = e.target;
            let currentLabelBlack = e.target;

            // console.log(e.target.localName);

            if (e.type == "mouseenter" || !e.target.control.checked) {
                // coloring red from the clicked/hovered label included, going backward till the node start - if we are hovering or the star isn't already checked.
                while (currentLabelRed != null) {
                    currentLabelRed.style.color = LABELCOLORACTIV;
                    currentLabelRed = currentLabelRed.previousElementSibling;
                }

                // coloring black from the clicked/hovered label excluded, going forward till the node end
                while ((currentLabelBlack = currentLabelBlack.nextElementSibling) != null) {
                    currentLabelBlack.style.color = LABELCOLORINACTIV;
                }
            } else {
                // if the clicked label was already checked we uncheck it and prevent the click event from doing its job - defacto enabling zero star rating
                e.target.control.checked = false;
                e.preventDefault();
            }
            if (e.type == "click") {
                // Assuming the rating value is stored in the value attribute of the input
                const ratingValue = e.target.control.value;
                const ratingInput = document.getElementById('rating');
                ratingInput.value = ratingValue;
            }
        }

        function notationLabelsOut(e) {
            let notesNode = e.target.parentNode.querySelectorAll("label");
            let currentLabel = notesNode[notesNode.length - 1];

            // console.log("out : " + e.target.localName);
            // console.log("out checked: " + e.target.control.checked);

            notesNode.forEach(function redrum(starLabel) {
                starLabel.style.color = LABELCOLORACTIV;
            });

            while (currentLabel != null && !currentLabel.control.checked) {
                currentLabel.style.color = LABELCOLORINACTIV;
                currentLabel = currentLabel.previousElementSibling;

                //console.log("currentLabel null?: " + currentLabel);
                // previousElementSibling become the input ...
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            RATINGSLABELS.forEach(function(aStar) {
                aStar.style.color = "#eee";
                aStar.addEventListener("click", notationLabels);
                aStar.addEventListener("mouseenter", notationLabels);
                aStar.addEventListener("mouseout", notationLabelsOut);
            });

            // stop a callback to the label click event function notationLabels passed on the input element associated ... why ... that's behond me
            // alternatively we could check for e.target.localName in the notationLabels function
            RATINGSINPUTS.forEach(function(aStarInput) {
                aStarInput.addEventListener("click", function(e) {
                    e.stopPropagation();
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Get the input element
            var qtyInput = $('#qty');
            let amountWithouTax = 0;

            // $('.viewProduct').on('click', function(e) {

            //     e.stopPropagation();
            //     var product = $(this).closest('.product-card').find('button').data('product');
            //     console.log(product);

            //     @php
                //         $userGiveReview = \App\Models\ProductReview::where('user_id', auth()->id())
                //             ->where('product_id', product . id)
                //             ->exists();
                //
            @endphp

            //     var modal = $('#productsQuickView');
            //     modal.find('.products-quickView-image img').attr('src', '/storage' + product.images[0][
            //         'img_path'
            //     ]);
            //     modal.find('.product-desc h3').text(product.name);
            //     modal.find('.product-desc .price .old-price').text('AED ' + product.retail_price);
            //     let save_price = (product.retail_price - product.supply_price) / product.retail_price * 100;
            //     modal.find('.product-desc .price .new-price').text('Save ' + save_price.toFixed(2) + '%');
            //     modal.find('.product-desc p').text(product.product_short_description);
            //     modal.find('#product_id').val(product.id);
            //     modal.find('.product-desc .product-category-list li:nth-child(1) span').text(product
            //         .current_stock_quantity > 0 ? "In Stock" : "Out of Stock");
            //     qtyInput.val(1);
            //     modal.modal('show');
            // });
            // Assuming you are using jQuery
            // $('.viewProduct').on('click', function(e) {
            //     e.stopPropagation();
            //     var product = $(this).closest('.product-card').find('button').data('product');
            //     console.log(product);

            //     // Fetch user review status via AJAX or pass it from the backend
            //     $.ajax({
            //         url: '/check-user-review',
            //         method: 'GET',
            //         data: {
            //             product_id: product.id
            //         },
            //         success: function(response) {
            //             var userGiveReview = response.userGiveReview;

            //             var modal = $('#productsQuickView');
            //             modal.find('.products-quickView-image img').attr('src', '/storage' +
            //                 product.images[0]['img_path']);
            //             modal.find('.product-desc h3').text(product.name);
            //             modal.find('.product-desc .price .old-price').text('AED ' + product
            //                 .retail_price);
            //             let save_price = (product.retail_price - product.supply_price) / product
            //                 .retail_price * 100;
            //             modal.find('.product-desc .price .new-price').text('Save ' + save_price
            //                 .toFixed(2) + '%');
            //             modal.find('.product-desc p').text(product.product_short_description);
            //             modal.find('#product_id').val(product.id);
            //             modal.find('.product-desc .product-category-list li:nth-child(1) span')
            //                 .text(product.current_stock_quantity > 0 ? "In Stock" :
            //                     "Out of Stock");
            //             qtyInput.val(1);


            //             // Show or hide the review form based on userGiveReview
            //             if (userGiveReview) {
            //                 modal.find('.review-form').hide();
            //             } else {
            //                 modal.find('.review-form').show();
            //             }

            //             modal.modal('show');
            //         }
            //     });
            // });
            $('.viewProduct').on('click', function(e) {
                e.stopPropagation();
                var product = $(this).closest('.product-card').find('button').data('product');
                console.log(product);

                // Fetch user review status via AJAX or pass it from the backend
                $.ajax({
                    url: '/check-user-review',
                    method: 'GET',
                    data: {
                        product_id: product.id
                    },
                    success: function(response) {
                        var userGiveReview = response.userGiveReview;

                        var modal = $('#productsQuickView');
                        modal.find('.products-quickView-image img').attr('src', '/storage' +
                            product.images[0]['img_path']);
                        modal.find('.product-desc h3').text(product.name);
                        modal.find('.product-desc .price .old-price').text('AED ' + product
                            .retail_price);
                        let save_price = (product.retail_price - product.supply_price) / product
                            .retail_price * 100;
                        modal.find('.product-desc .price .new-price').text('Save ' + save_price
                            .toFixed(2) + '%');
                        modal.find('.product-desc p').text(product.product_short_description);
                        modal.find('#product_id').val(product.id);
                        modal.find('.product-desc .product-category-list li:nth-child(1) span')
                            .text(product.current_stock_quantity > 0 ? "In Stock" :
                                "Out of Stock");
                        qtyInput.val(1);

                        // Show or hide the review form based on userGiveReview
                        if (userGiveReview) {
                            modal.find('.review-form').hide();
                        } else {
                            modal.find('.review-form').show();
                        }

                        // Fetch and display reviews
                        // $.ajax({
                        //     url: '/product/' + product.id + '/reviews',
                        //     method: 'GET',
                        //     success: function(reviews) {
                        //         var reviewsContainer = modal.find(
                        //             '.reviews-container');
                        //         reviewsContainer.empty(); // Clear previous reviews

                        //         if (reviews.length > 0) {
                        //             reviews.forEach(function(review) {
                        //                 var reviewHtml = `
                    //             <div class="review">
                    //                 <p>Rating: ${review.rating} ★</p>
                    //             </div>`;
                        //                 reviewsContainer.append(reviewHtml);
                        //             });
                        //         } else {
                        //             reviewsContainer.append(
                        //                 '<p>No reviews yet.</p>');
                        //         }
                        //     }
                        // });

                        $.ajax({
                            url: '/product/' + product.id + '/reviews',
                            method: 'GET',
                            success: function(reviews) {
                                var reviewsContainer = modal.find(
                                    '.reviews-container');
                                reviewsContainer.empty(); // Clear previous reviews

                                if (reviews.length > 0) {
                                    reviews.forEach(function(review) {
                                        var stars = '';
                                        for (var i = 0; i < 5; i++) {
                                            if (i < review.rating) {
                                                stars += '★'; // Filled star
                                            } else {
                                                stars += '☆'; // Empty star
                                            }
                                        }

                                        var reviewHtml = `
                    <div class="review">
                        <p>Rating: ${stars}</p>
                    </div>
                `;
                                        reviewsContainer.append(reviewHtml);
                                    });
                                } else {
                                    reviewsContainer.append(
                                        '<p>No reviews yet.</p>');
                                }
                            }
                        });

                        modal.modal('show');
                    }
                });
            });



            // Increment button click handler
            $('.plus-btn').on('click', function() {
                var currentValue = parseInt(qtyInput.val());
                qtyInput.val(currentValue + 1);
            });

            // Decrement button click handler
            $('.minus-btn').on('click', function() {
                var currentValue = parseInt(qtyInput.val());
                if (currentValue > 1) {
                    qtyInput.val(currentValue - 1);
                }
            });

            // Increment quantity
            $(document).on('click', '.cart-plus-btn', function() {
                var $input = $(this).closest('.input-group').find('.cartQtyInput');
                var value = parseInt($input.val());
                if (!isNaN(value)) {
                    $input.val(value + 1);
                }
                calculateTotal();
            });

            // Decrement quantity
            $(document).on('click', '.cart-minus-btn', function() {
                var $input = $(this).closest('.input-group').find('.cartQtyInput');
                var value = parseInt($input.val());
                if (!isNaN(value) && value > 1) {
                    $input.val(value - 1);
                }
                calculateTotal();
            });

            $(document).on('click', '.add-to-cart', function(e) {
                var isUserLoggedIn = {{ auth()->check() ? 'true' : 'false' }};

                if (!isUserLoggedIn) {
                    window.location.href = "{{ route('auth-for-customer') }}";
                    return;
                }

                var client_id = {{ auth()->id() ?? 'null' }};
                var shop_id = {{ $shop->id }};
                var product = $(this).data('product');

                if (product.current_stock_quantity === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Product out of stock',
                        showConfirmButton: false,
                        timer: 1000,
                    });
                    return;
                }

                // Check if the item is already in the cart
                var cartItems = $('.cart-list .card');
                var isItemInCart = false;
                cartItems.each(function() {
                    var productId = $(this).data('product-id');
                    if (productId === product.id) {
                        isItemInCart = true;
                        return false; // Exit the loop
                    }
                });

                if (isItemInCart) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Item already in cart',
                        showConfirmButton: false,
                        timer: 1000,
                    });
                    return;
                }

                var qty = qtyInput.val();
                $.ajax({
                    url: "{{ route('cart.store') }}",
                    method: 'POST',
                    data: {
                        product_id: product.id,
                        quantity: qty,
                        client_id: client_id,
                        store_id: shop_id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status) {
                            var offcanvas = $('#offcanvasExample');
                            let cart_count = $('#cart-count').text();
                            let cart = response.cart;
                            $('#cart-count').text(parseInt(cart_count) + 1);
                            let item = `
                        <div class="card mb-3" data-cart-id="${cart.id}" data-product-id="${cart.product.id}" style="max-width: 540px;">
                            <div class="row g-0">
                               <div class="row g-0">
                                <div class="col-md-4 d-flex align-items-center">
                                    <img src="/storage${cart.product.images[0]['img_path']}" class="img-fluid rounded-start" alt="Image Not Found" onerror="this.onerror=null; this.src='https://via.placeholder.com/150';">
                                </div>

                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">${cart.product.name}</h5>
                                        <p class="card-text">${cart.product.measureType} ${cart.product.amount}</p>
                                        <p class="card-text">AED ${cart.product.retail_price}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="input-counter-area">
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-secondary cart-minus-btn" type="button">
                                                            <i class="ri-subtract-line"></i>
                                                        </button>
                                                    </span>
                                                    <input type="text" class="form-control cartQtyInput p-1" value="${cart.quantity}">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-secondary cart-plus-btn" type="button">
                                                            <i class="ri-add-fill"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div>
                                                <i class="bi bi-trash remove text-danger fs-5" style="cursor: pointer"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                            offcanvas.find('.cart-list').append(item);
                            if ($('#notFoundCart').length > 0) {
                                $('#notFoundCart').remove();
                            }
                            calculateTotal();
                            var bsOffcanvas = new bootstrap.Offcanvas(offcanvas[0]);
                            bsOffcanvas.show();
                        }
                    }
                });
            });

            $(document).on('click', '.remove', function() {
                var cart_id = $(this).closest('.card').data('cart-id');
                var cart = $(this).closest('.card');
                $.ajax({
                    url: `/cart/${cart_id}`,
                    method: 'DELETE',
                    data: {
                        cart_id: cart_id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status) {
                            cart.remove();
                            Swal.fire({
                                icon: 'success',
                                title: 'Product Removed',
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            let cart_count = $('#cart-count').text();
                            $('#cart-count').text(parseInt(cart_count) - 1);
                            if (parseInt(cart_count) - 1 === 0) {
                                var offcanvas = $('#offcanvasExample');
                                var bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvas[0]);
                                bsOffcanvas.hide();
                            }
                            calculateTotal();
                        }
                    }
                });
            });

            $('#addToCartListButton').on('click', function() {
                var offcanvas = $('#offcanvasExample');
                var bsOffcanvas = new bootstrap.Offcanvas(offcanvas[0]);
                bsOffcanvas.show();
            });



            // function calculateTotal() {
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
            //     var total = 0;
            //     $('.cart-list .card').each(function() {
            //         var qty = $(this).find('.cartQtyInput').val();
            //         var price = $(this).find('.card-text').last().text().split(' ')[1];
            //         total += parseInt(qty) * parseFloat(price);
            //     });
            //     let amount = total.toFixed(2);
            //     $('.grand_total').text(taxCalculator(amount));
            // }
            // calculateTotal();


            async function getExchangeRate(fromCurrency, toCurrency) {
                // Ensure the URL is a string
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


            async function calculateTotal() {
                var total = 0;
                $('.cart-list .card').each(function() {
                    var qty = $(this).find('.cartQtyInput').val();
                    var price = $(this).find('.card-text').last().text().split(' ')[1];

                    // Ensure qty and price are valid numbers
                    qty = parseInt(qty);
                    price = parseFloat(price);

                    if (isNaN(qty) || isNaN(price)) {
                        console.error("Invalid qty or price:", qty, price);
                        return;
                    }

                    total += qty * price;
                });

                // Convert total to a number before passing it to taxCalculator
                let amount = parseFloat(total.toFixed(2));
                amountWithouTax = amount;
                // $('.grand_total').text(await taxCalculator(amount));
                $('.grand_total').text(total);
                console.log('after tax', await taxCalculator(amount));
            }

            // Call the function to ensure it runs
            calculateTotal();



            $('#checkoutBtn').on('click', function() {
                var cartItems = $('.cart-list .card');
                var items = [];
                cartItems.each(function() {
                    var productId = $(this).data('product-id');
                    var cartId = $(this).data('cart-id');
                    var qty = $(this).find('.cartQtyInput').val();
                    items.push({
                        product_id: productId,
                        cart_id: cartId,
                        quantity: qty
                    });
                });
                if (items.length === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'No items in cart',
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    return;
                }
                // let grand_total = $('.grand_total').text();
                let grand_total = amountWithouTax;
                var isUserLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
                if (!isUserLoggedIn) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Please login to checkout',
                        showConfirmButton: false,
                        timer: 1000,
                    });
                    return;
                } else {
                    var client_id = {{ auth()->id() ?? 'null' }};
                }
                // if(client_id === null) {
                //     Swal.fire({
                //         icon: 'error',
                //         title: 'Please login to checkout',
                //         showConfirmButton: false,
                //         timer: 1000,
                //     });
                //     return;
                // }
                let shop_id = {{ $shop->id }};
                $.ajax({
                    // url: "{{ route('shop.products.checkout', $shop->businessUser->slug) }}",
                    url: "{{ route('stripe.checkout') }}",
                    method: 'POST',
                    data: {
                        items: items,
                        grand_total: grand_total,
                        client_id: client_id,
                        store_id: shop_id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1000,
                            });
                            window.location.href = response.url;
                            // window.location.href = "{{ route('customer.product.orders') }}";
                            // window.location.href = "/";

                        }
                    }
                });
            });

        });
    </script>
</body>

</html>
