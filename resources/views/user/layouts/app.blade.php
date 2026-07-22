<!doctype html>
<html lang="">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('top-styles')
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/iconplugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme-dark.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
    <style>
        .myc-available-time {
            background: linear-gradient(267deg, rgba(221, 63, 235, 1) 0%, rgba(58, 55, 236, 1) 100%) !important;
        }

        .myc-available-time:hover{
            color: white !important;
        }

        #loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
        }

        .goog-te-banner-frame.skiptranslate {
            display: none !important;
        }

        .goog-logo-link {
            display: none !important;
        }
    </style>

    <style>
        .goog-te-gadget-simple {
            border: none;
            background-color: transparent;
        }

        .goog-te-gadget-simple .goog-te-menu-value span {
            display: none;
        }

        .goog-te-gadget-simple .goog-te-menu-value img {
            display: inline;
            width: 20px;
            height: 20px;
        }

        .goog-te-gadget-simple .goog-te-menu-value {
            padding: 0;
        }

        .goog-te-menu-frame {
            max-width: 100%;
            box-shadow: none;
            border: none;
        }

        .goog-te-menu2 {
            max-width: 100%;
            border: none;
            box-shadow: none;
        }

        .goog-te-menu2 .goog-te-menu2-item div {
            padding: 8px;
        }

        .goog-te-menu2 .goog-te-menu2-item span.text {
            margin-left: 30px;
            /* Space for the flag */
        }

        .goog-te-menu2 .goog-te-menu2-item img {
            width: 20px;
            height: 20px;
            position: absolute;
            left: 8px;
            top: 8px;
        }

        .flag-icon {
            margin-right: 8px;
            width: 20px;
            height: 20px;
            vertical-align: middle;
        }

        @media (max-width: 600px) {
            .goog-te-gadget-simple {
                font-size: 14px;
            }

            .goog-te-menu2 .goog-te-menu2-item img {
                width: 16px;
                height: 16px;
            }

            .goog-te-menu2 .goog-te-menu2-item span.text {
                margin-left: 25px;
            }
        }
    </style>
   <style>
       @media (max-width: 768px){
.for-business-banner h1 {
    text-align: center;
    color: white;
    font-size: 2.5rem;
}
.business-info-img {
    margin-top: -60vh;
}
}

@media (max-width: 576px){
.for-business-banner h1 {
    text-align: center;
    color: white;
    font-size: 2rem;
}
.business-info-img {
    margin-top: -53vh;
}
}

@media(max-width: 375px){
.for-business-banner h1 {
    text-align: center;
    color: white;
    font-size: 1.7rem;
}

.business-info-img {
    margin-top: -56vh;
}
}

@media (max-width: 320px){
.for-business-banner h1 {
    text-align: center;
    color: white;
    font-size: 1.5rem;
}
}


   </style>
    <!--     Start of Tawk.to Script-->
    <!-- <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/667ac27aeaf3bd8d4d143a9a/1i17ofbld';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script> -->
    <!--End of Tawk.to Script -->

    @yield('styles')
</head>

<body>
    @include('user.layouts.navbar')
    <div class="modal fade fade-scale searchmodal" id="searchmodal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="modal-search-form">
                        <input type="search" class="search-field" placeholder="Search...">
                        <button type="submit">
                            <i class="ri-search-line"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <div id="loader">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div> --}}

    @yield('content')

    @include('user.layouts.footer')
    <div class="modal fade productsQuickView" id="productsQuickView" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close-on" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="flaticon-close"></i>
                    </span>
                </button>
                <div class="product-details-desc">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12">
                            <div class="products-quickView-image">
                                <img src="assets/images/products/product-details.png" alt="Product Details">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="product-desc mb-30 pl-20">
                                <h3>Nail Polish Removers </h3>
                                <div class="price">
                                    <span class="old-price">$140.00 </span>
                                    <span class="new-price">- $110.00</span>
                                </div>
                                <div class="product-review">
                                    <div class="rating">
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-line"></i>
                                        <i class="ri-star-line"></i>
                                    </div>
                                    <div class="rating-count">255 Reviews</div>
                                </div>
                                <p> Voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab
                                    illo inventore veritatis et quasi. </p>
                                <ul class="product-category-list">
                                    <li>Availablity: <span>In Stock</span>
                                    </li>
                                    <li>Tags: <span>Nail, Lover</span>
                                    </li>
                                </ul>
                                <div class="input-counter-area">
                                    <h4>Quantity</h4>
                                    <div class="input-counter">
                                        <span class="minus-btn">
                                            <i class="ri-add-fill"></i>
                                        </span>
                                        <input type="text" value="1">
                                        <span class="plus-btn">
                                            <i class="ri-subtract-line"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="product-add-btn">
                                    <button type="submit" class="default-btn border-radius-5"> Add To Cart <i
                                            class="flaticon-shopping-cart-empty-side-view"></i>
                                    </button>
                                    <ul class="products-action">
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
                                    </ul>
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
    @yield('top-scripts')

    {{-- Google Translator for Multi Language Mode
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,ur,hi,fa,ar,ru',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>

    <p>You can translate the content of this page by selecting a language in the select box.</p>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            var intervalId = setInterval(function() {
                var selectBox = document.querySelector('.goog-te-combo');
                if (selectBox) {
                    var langMap = {
                        'en': '🇺🇸 English',
                        'ur': '🇵🇰 Urdu',
                        'hi': '🇮🇳 Hindi',
                        'fa': '🇮🇷 Farsi',
                        'ar': '🇸🇦 Arabic',
                        'ru': '🇷🇺 Russian'
                    };

                    for (var i = 0; i < selectBox.options.length; i++) {
                        var option = selectBox.options[i];
                        if (langMap[option.value]) {
                            option.textContent = langMap[option.value];
                        }
                    }

                    clearInterval(intervalId);
                }
            }, 100);
        });
    </script>
    --}}


    {{-- <script src="{{asset('assets/js/jquery.min.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/js/plugins.js')}}"></script> --}}
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/meanmenu.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/ajaxchimp.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/form-validator.min.js') }}" type="text/javascript"></script>
    {{-- <script src="{{asset('assets/js/contact-form-script.js')}}" type="text/javascript"></script> --}}
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/magnific-popup.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/aos.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/tweenMax.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    @yield('scripts')

    @if (session()->has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
            })
        </script>
    @endif
    @if (session()->has('error'))
        <script>
            Swal.fire({
                icon: 'danger',
                title: 'Danger!',
                text: '{{ session('error') }}',
            })
        </script>
    @endif

    {{-- <script>
        $(window).on('load', function() {
            $('#loader').fadeOut('slow');
        });
    </script> --}}

</body>

</html>
