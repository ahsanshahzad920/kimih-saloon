(function($) {
    'use strict';

    // Mean Menu JS
    jQuery('.mean-menu').meanmenu({ 
        meanScreenWidth: "991"
    });

    // Navbar Sticky Scroll
    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 50){  
            $('.kimih-header, .navbar-area, .nav-k').addClass("is-sticky");
        }
        else{
            $('.kimih-header, .navbar-area, .nav-k').removeClass("is-sticky");
        }
    });

    // Banner Slider
	$('.banner-slider').owlCarousel({
		loop:true,
		margin: 30,
		nav: true,
		mouseDrag: true,
        items:1,
		dots: false,
		autoHeight: true,
		autoplay: false,
		smartSpeed:1500,
        autoplayHoverPause: true,
        navText: [
            "<i class='flaticon-arrow-pointing-to-left'></i>",
            "<i class='flaticon-arrow-pointing-to-right'></i>"
        ],
    });

    // About Slider
	$('.about-slider').owlCarousel({
		loop:true,
		margin: 30,
		nav: false,
		mouseDrag: true,
        items:1,
		dots: true,
		autoHeight: true,
		autoplay: false,
		smartSpeed:1500,
        autoplayHoverPause: true,
    });

    // Testimonial Slider
	$('.testimonial-slider').owlCarousel({
		loop:true,
		margin: 30,
		nav: false,
		mouseDrag: true,
        items: 1,
		dots: false,
		autoHeight: true,
		autoplay: false,
		smartSpeed:1500,
        autoplayHoverPause: true,
        responsive:{
            0:{
                items: 1,
                center: false,
            },
            576:{
                items: 2,
                center: false,
            },
            1000:{
                items: 3,
                center:  true,
            }
        },
    });
    $(function() {
  // Owl Carousel
  var owl = $(".owl-carousel");
  owl.owlCarousel({
    items: 1,
    margin: 10,
    loop: false,
    nav: false
  });
});





    // Testimonial Slider
    jQuery(".nearbyLocation").owlCarousel({
  autoplay: true,
  rewind: true, /* use rewind if you don't want loop */
  margin: 20,
   /*
  animateOut: 'fadeOut',
  animateIn: 'fadeIn',
  */
  responsiveClass: true,
  autoHeight: true,
  autoplayTimeout: 7000,
  smartSpeed: 800,
  nav: true,
  responsive: {
    0: {
      items: 1
    },

    600: {
      items: 3
    },

    1024: {
      items: 4
    },

    1366: {
      items: 4
    }
  }
});
    // $('.nearbyLocation').owlCarousel({
    //     loop:true,
    //     margin: 30,
    //     nav: true,
    //     mouseDrag: true,
    //     items: 1,
    //     dots: false,
    //     autoHeight: true,
    //     autoplay: tr,
    //     smartSpeed:1500,
    //     autoplayHoverPause: true,
    //     responsive:{
    //         0:{
    //             items: 1,
    //             center: false,
    //         },
    //         576:{
    //             items: 2,
    //             center: false,
    //         },
    //         1000:{
    //             items: 4,
    //             center:  true,
    //         }
    //     },
    // });




    // Testimonial Slider Two
	$('.testimonial-slider-two').owlCarousel({
		loop:true,
		margin: 30,
		nav: false,
		mouseDrag: true,
		dots: false,
		autoHeight: true,
		autoplay: false,
		smartSpeed:1500,
        autoplayHoverPause: true,
        responsive:{
            0:{
                items: 1,
            },
            1000:{
                items: 2,
            }
        },
    });

    // Testimonial Slider Two
	$('.testimonial-slider-three').owlCarousel({
		loop:true,
		margin: 30,
		nav: true,
		mouseDrag: true,
		dots: false,
		autoHeight: true,
		autoplay: false,
		smartSpeed:1500,
        autoplayHoverPause: true,
        responsive:{
            0:{
                items: 1,
            },
            1000:{
                items: 2,
                center: false,
            }
        },
        navText: [
            "<i class='flaticon-arrow-pointing-to-left'></i>",
            "<i class='flaticon-arrow-pointing-to-right'></i>"
        ],
    });

    // Services Slider
	$('.services-slider').owlCarousel({
		loop:true,
		margin: 30,
		nav: true,
		mouseDrag: true,
		dots: false,
		autoHeight: true,
		autoplay: false,
		smartSpeed:1500,
        autoplayHoverPause: true,
        responsive:{
            0:{
                items: 1,
                center: false,
            },
            576:{
                items: 2,
                center: false,
            },
            1000:{
                items: 3,
                center:  true,
            }
        },
        navText: [
            "<i class='flaticon-arrow-pointing-to-left'></i>",
            "<i class='flaticon-arrow-pointing-to-right'></i>"
        ],
    });

    // Blog Preview Slider
	$('.blog-preview-slider').owlCarousel({
		loop:true,
		margin: 30,
		nav: true,
		mouseDrag: true,
		dots: false,
        items: 1,
		autoHeight: true,
		autoplay: false,
		smartSpeed:1500,
        autoplayHoverPause: true,
        navText: [
            "<i class='flaticon-arrow-pointing-to-left'></i>",
            "<i class='flaticon-arrow-pointing-to-right'></i>"
        ],
    });

    // Range Slider
    $( "#range-slider" ).slider({
        range: true,
        min: 50,
        max: 400,
        values: [50, 400],
        slide: function( event, ui ) {
            $( "#price-amount" ).val( "$" + ui.values[ 0 ] + "-$" + ui.values[ 1 ] );
        }
    });
    $( "#price-amount" ).val( "$" + $( "#range-slider" ).slider( "values", 0 ) +
    " - $" + $( "#range-slider" ).slider( "values", 1 ) );  

    $(".skill-bar").each(function () {
        $(this).find(".progress-content").animate({ width: $(this).attr("data-percentage") }, 2000);
        $(this).find(".progress-number-mark").animate({ left: $(this).attr("data-percentage") },
            {
                duration: 2000,
                step: function (now, fx) {
                    var data = Math.round(now);
                    $(this)
                        .find(".percent")
                        .html(data + "%");
                },
            }
        );
    });

    // Tabs Single Page
    $('.tab ul.tabs').addClass('active').find('> li:eq(0)').addClass('current');
    $('.tab ul.tabs li').on('click', function (g) {
        var tab = $(this).closest('.tab'), 
        index = $(this).closest('li').index();
        tab.find('ul.tabs > li').removeClass('current');
        $(this).closest('li').addClass('current');
        tab.find('.tab_content').find('div.tabs_item').not('div.tabs_item:eq(' + index + ')').slideUp();
        tab.find('.tab_content').find('div.tabs_item:eq(' + index + ')').slideDown();
        g.preventDefault();
    });

    // FAQ Accordion JS
	$('.accordion').find('.accordion-title').on('click', function(){
		// Adds Active Class
		$(this).toggleClass('active');
		// Expand or Collapse This Panel
		$(this).next().slideToggle('fast');
		// Hide The Other Panels
		$('.accordion-content').not($(this).next()).slideUp('fast');
		// Removes Active Class From Other Titles
		$('.accordion-title').not($(this)).removeClass('active');		
    });

    // Datetimepicker
    $('#datetimepicker').datepicker();

    // Datetimepicker
    $('#datetimepicker2').datepicker();

     // Newsletter modal
     $(window).on('load',function(){
        setTimeout(function(){ 
            $(".newsletter-popup-wrapepr").addClass("active")
        }, 3000); 
    });
    $(".newsletter-modal-close").on("click", function() {
        $(".newsletter-popup-wrapepr").removeClass("active")
    })

    // Popup Video 
    $('.play-btn').magnificPopup({
        disableOn: 0,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });

    // Input Plus & Minus Number JS
    $('.input-counter').each(function() {
        var spinner = jQuery(this),
        input = spinner.find('input[type="text"]'),
        btnUp = spinner.find('.plus-btn'),
        btnDown = spinner.find('.minus-btn'),
        min = input.attr('min'),
        max = input.attr('max');
        
        btnUp.on('click', function() {
            var oldValue = parseFloat(input.val());
            if (oldValue >= max) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue + 1;
            }
            spinner.find("input").val(newVal);
            spinner.find("input").trigger("change");
        });

        btnDown.on('click', function() {
            var oldValue = parseFloat(input.val());
            if (oldValue <= min) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue - 1;
            }
            spinner.find("input").val(newVal);
            spinner.find("input").trigger("change");
        });
    }); 

    // Count Time JS
	function makeTimer() {
		var endTime = new Date("October 30, 2022 17:00:00 PDT");			
		var endTime = (Date.parse(endTime)) / 1000;
		var now = new Date();
		var now = (Date.parse(now) / 1000);
		var timeLeft = endTime - now;
		var days = Math.floor(timeLeft / 86400); 
		var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
		var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
		var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));
		if (hours < "10") { hours = "0" + hours; }
		if (minutes < "10") { minutes = "0" + minutes; }
		if (seconds < "10") { seconds = "0" + seconds; }
		$("#days").html(days + "<span>Days</span>");
		$("#hours").html(hours + "<span>Hours</span>");
		$("#minutes").html(minutes + "<span>Minutes</span>");
		$("#seconds").html(seconds + "<span>Seconds</span>");
	}
    setInterval(function() { makeTimer(); }, 300);

    // Subscribe form
    $(".newsletter-form").validator().on("submit", function (event) {
        if (event.isDefaultPrevented()) {
            // Handle The Invalid Form...
            formErrorSub();
            submitMSGSub(false, "Please enter your email correctly");
        } else {
            // Everything Looks Good!
            event.preventDefault();
        }
    });
    function callbackFunction (resp) {
        if (resp.result === "success") {
            formSuccessSub();
        }
        else {
            formErrorSub();
        }
    }
    function formSuccessSub(){
        $(".newsletter-form")[0].reset();
        submitMSGSub(true, "Thank you for subscribing!");
        setTimeout(function() {
            $("#validator-newsletter").addClass('hide');
        }, 4000)
    }
    function formErrorSub(){
        $(".newsletter-form").addClass("animated shake");
        setTimeout(function() {
            $(".newsletter-form").removeClass("animated shake");
        }, 1000)
    }
    function submitMSGSub(valid, msg){
        if(valid){
            var msgClasses = "validation-success";
        } else {
            var msgClasses = "validation-danger";
        }
        $("#validator-newsletter").removeClass().addClass(msgClasses).text(msg);
    }
        
    // AJAX MailChimp
    $(".newsletter-form").ajaxChimp({
        url: "https://envyTheme.us20.list-manage.com/subscribe/post?u=60e1ffe2e8a68ce1204cd39a5&amp;id=42d6d188d9", // Your url MailChimp
        callback: callbackFunction
    });

    // Back To Top
    $('body').append("<div class='go-top'><i class='flaticon-navigate-up-arrow'></i></div>");
    $(window).on('scroll', function() {
        var scrolled = $(window).scrollTop();
        if (scrolled > 600) $('.go-top').addClass('active');
        if (scrolled < 600) $('.go-top').removeClass('active');
    });
    $('.go-top').on('click', function() {
        $('html, body').animate({
            scrollTop: '0',
        }, 500 );
    });

    // Preloader
    $(window).on("load", function() {
        var preLoder = $(".loader-wrapper");
        preLoder.delay(700).fadeOut(500);
        $("body").addClass("loaded");
    });

    // AOS JS
	AOS.init();

    // TweenMax JS
	$('.banner-area').mousemove(function(e){
		var wx = $(window).width();
		var wy = $(window).height();
		var x = e.pageX - this.offsetLeft;
		var y = e.pageY - this.offsetTop;
		var newx = x - wx/2;
		var newy = y - wy/2;
		$('.banner-img').each(function(){
			var speed = $(this).attr('data-speed');
			if($(this).attr('data-revert')) speed *= -.4;
			TweenMax.to($(this), 1, {x: (1 - newx*speed), y: (1 - newy*speed)});
		});
	});

    // TweenMax JS
	$('.banner-area-two').mousemove(function(e){
		var wx = $(window).width();
		var wy = $(window).height();
		var x = e.pageX - this.offsetLeft;
		var y = e.pageY - this.offsetTop;
		var newx = x - wx/2;
		var newy = y - wy/2;
		$('.banner-img-two, .banner-vector').each(function(){
			var speed = $(this).attr('data-speed');
			if($(this).attr('data-revert')) speed *= -.4;
			TweenMax.to($(this), 1, {x: (1 - newx*speed), y: (1 - newy*speed)});
		});
	});

    // TweenMax JS
	$('.intro-video-bg').mousemove(function(e){
		var wx = $(window).width();
		var wy = $(window).height();
		var x = e.pageX - this.offsetLeft;
		var y = e.pageY - this.offsetTop;
		var newx = x - wx/2;
		var newy = y - wy/2;
		$('.video-content-two').each(function(){
			var speed = $(this).attr('data-speed');
			if($(this).attr('data-revert')) speed *= -.4;
			TweenMax.to($(this), 1, {x: (1 - newx*speed), y: (1 - newy*speed)});
		});
	});

    // Buy Now Btn
    // $('body').append("<a href='https://themeforest.net/checkout/from_item/36367959?license=regular&support=bundle_6month&_ga=2.253043593.1220166448.1645934757-918236941.1644836235' target='_blank' class='buy-now-btn'><img src='assets/images/envato.png' alt='envato'/>Buy Now</a>");

    // Switch Btn
    // $('body').append("<div class='switch-box'><label id='switch' class='switch'><input type='checkbox' onchange='toggleTheme()' id='slider'><span class='slider round'></span></label></div>");

})(jQuery);

// function to set a given theme/color-scheme
function setTheme(themeName) {
    localStorage.setItem('naon_theme', themeName);
    document.documentElement.className = themeName;
}

// function to toggle between light and dark theme
function toggleTheme() {
    if (localStorage.getItem('naon_theme') === 'theme-dark') {
        setTheme('theme-light');
    } else {
        setTheme('theme-dark');
    }
}

// Immediately invoked function to set the theme on initial load
(function () {
    var slider = document.getElementById('slider');
    if (localStorage.getItem('naon_theme') === 'theme-dark') {
        setTheme('theme-dark');
        if (slider) slider.checked = false;
    } else {
        setTheme('theme-light');
        if (slider) slider.checked = true;
    }
})();

/* ==========================================================
   FRESHA CAROUSEL JQUERY SMOOTH SCROLL & WISHLIST AJAX
   ========================================================== */
jQuery(document).ready(function ($) {
    // 1. Smooth Scroll Controls (.js-carousel-prev / .js-carousel-next)
    $(document).on('click', '.js-carousel-next', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var $btn = $(this).closest('.js-carousel-next');
        var targetId = $btn.attr('data-target') || $btn.data('target');
        if (!targetId) return;
        var trackEl = document.querySelector(targetId);
        if (trackEl) {
            var cardWidth = trackEl.querySelector('.fresha-card-wrap')?.offsetWidth || 280;
            var scrollDist = (cardWidth + 16) * 2;
            trackEl.scrollBy({ left: scrollDist, behavior: 'smooth' });
        }
    });

    $(document).on('click', '.js-carousel-prev', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var $btn = $(this).closest('.js-carousel-prev');
        var targetId = $btn.attr('data-target') || $btn.data('target');
        if (!targetId) return;
        var trackEl = document.querySelector(targetId);
        if (trackEl) {
            var cardWidth = trackEl.querySelector('.fresha-card-wrap')?.offsetWidth || 280;
            var scrollDist = (cardWidth + 16) * 2;
            trackEl.scrollBy({ left: -scrollDist, behavior: 'smooth' });
        }
    });

    // 2. Desktop Mouse Drag-to-Scroll Support
    document.querySelectorAll('.fresha-carousel-track-wrap').forEach(function (slider) {
        var isDown = false;
        var startX;
        var scrollLeft;

        slider.addEventListener('mousedown', function (e) {
            isDown = true;
            slider.classList.add('active-drag');
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });
        slider.addEventListener('mouseleave', function () {
            isDown = false;
            slider.classList.remove('active-drag');
        });
        slider.addEventListener('mouseup', function () {
            isDown = false;
            slider.classList.remove('active-drag');
        });
        slider.addEventListener('mousemove', function (e) {
            if (!isDown) return;
            e.preventDefault();
            var x = e.pageX - slider.offsetLeft;
            var walk = (x - startX) * 1.5;
            slider.scrollLeft = scrollLeft - walk;
        });
    });

    // 3. Wishlist Heart Toggle + AJAX Call with Toast Notification
    $(document).on('click', '.js-fav-btn', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var $btn = $(this);
        var salonId = $btn.data('salon-id');

        var isNowActive = !$btn.hasClass('is-active');
        $btn.toggleClass('is-active');

        if (typeof Swal !== 'undefined') {
            const toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });
            toast.fire({
                icon: 'success',
                title: isNowActive ? 'Added to favorites' : 'Removed from favorites'
            });
        }

        var csrf = $('meta[name="csrf-token"]').attr('content');
        if (csrf && salonId) {
            $.ajax({
                url: '/wishlist/toggle',
                type: 'POST',
                data: {
                    _token: csrf,
                    salon_id: salonId
                },
                error: function () {
                    // Fail silently so UI experience remains smooth
                }
            });
        }
    });

    // 4. Google Places API Autocomplete for Location Inputs
    function initGooglePlacesAutocomplete() {
        if (typeof google === 'object' && typeof google.maps === 'object' && google.maps.places) {
            var inputs = document.querySelectorAll('input[name="location"], #addressInput, .js-location-autocomplete');
            inputs.forEach(function (input) {
                if (input.getAttribute('data-places-initialized')) return;
                input.setAttribute('data-places-initialized', 'true');

                var autocomplete = new google.maps.places.Autocomplete(input, {
                    types: ['geocode', '(cities)']
                });

                autocomplete.addListener('place_changed', function () {
                    var place = autocomplete.getPlace();
                    if (place && place.geometry && place.geometry.location) {
                        var form = input.closest('form');
                        if (form) {
                            var latInput = form.querySelector('input[name="lat"], input[name="latitude"]');
                            var lngInput = form.querySelector('input[name="lng"], input[name="longitude"]');
                            if (latInput) latInput.value = place.geometry.location.lat();
                            if (lngInput) lngInput.value = place.geometry.location.lng();
                        }
                    }
                });
            });
        }
    }

    if (typeof google === 'object' && typeof google.maps === 'object') {
        initGooglePlacesAutocomplete();
    } else {
        window.addEventListener('load', initGooglePlacesAutocomplete);
    }

    /* ==========================================================
       5. LOCATION FIELD — "Current location" (browser geolocation)
       ========================================================== */
    var locationField = document.getElementById('locationField');
    var locationInput = document.getElementById('userLocationInput');
    var useCurrentLocationBtn = document.getElementById('useCurrentLocationBtn');
    var userLocationLat = document.getElementById('userLocationLat');
    var userLocationLng = document.getElementById('userLocationLng');

    function closeAllSearchDropdowns(except) {
        document.querySelectorAll('.search-card .sf.open').forEach(function (sf) {
            if (sf !== except) sf.classList.remove('open');
        });
    }

    if (locationField && locationInput) {
        locationInput.addEventListener('focus', function () {
            closeAllSearchDropdowns(locationField);
            locationField.classList.add('open');
        });
        locationInput.addEventListener('input', function () {
            locationField.classList.remove('open');
        });
    }

    if (useCurrentLocationBtn) {
        useCurrentLocationBtn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            var textEl = useCurrentLocationBtn.querySelector('.dd-geo-text');
            var originalText = textEl.textContent;

            function showToast(icon, title) {
                if (typeof Swal !== 'undefined') {
                    Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2500,
                        timerProgressBar: true
                    }).fire({ icon: icon, title: title });
                } else {
                    alert(title);
                }
            }

            if (!navigator.geolocation) {
                showToast('error', 'Geolocation is not supported by your browser');
                return;
            }

            useCurrentLocationBtn.classList.add('is-loading');
            textEl.textContent = 'Fetching your location…';

            navigator.geolocation.getCurrentPosition(function (position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                if (userLocationLat) userLocationLat.value = lat;
                if (userLocationLng) userLocationLng.value = lng;

                function finish(text) {
                    if (locationInput) locationInput.value = text;
                    useCurrentLocationBtn.classList.remove('is-loading');
                    textEl.textContent = originalText;
                    if (locationField) locationField.classList.remove('open');
                }

                if (typeof google === 'object' && google.maps && google.maps.Geocoder) {
                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode({ location: { lat: lat, lng: lng } }, function (results, status) {
                        if (status === 'OK' && results && results[0]) {
                            finish(results[0].formatted_address);
                        } else {
                            finish('Current location');
                        }
                    });
                } else {
                    finish('Current location');
                }
            }, function (error) {
                useCurrentLocationBtn.classList.remove('is-loading');
                textEl.textContent = originalText;
                var msg = 'Unable to fetch your location.';
                if (error.code === 1) msg = 'Location permission denied. Please allow location access and try again.';
                else if (error.code === 3) msg = 'Fetching location timed out. Please try again.';
                showToast('error', msg);
            }, { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 });
        });
    }

    /* ==========================================================
       6. DATE & TIME PICKER — Fresha-style calendar dropdown
       ========================================================== */
    var dateTimeField = document.getElementById('dateTimeField');
    if (dateTimeField) {
        var dtpDisplay = document.getElementById('dateTimeDisplay');
        var dtpDateInput = document.getElementById('dateTimeDateInput');
        var dtpTimeInput = document.getElementById('dateTimeTimeInput');
        var dtpCalTitle = document.getElementById('dtpCalTitle');
        var dtpDaysGrid = document.getElementById('dtpDaysGrid');
        var dtpPrevMonth = document.getElementById('dtpPrevMonth');
        var dtpNextMonth = document.getElementById('dtpNextMonth');
        var dtpTodaySub = document.getElementById('dtpTodaySub');
        var dtpTomorrowSub = document.getElementById('dtpTomorrowSub');
        var dtpTimeOpts = document.getElementById('dtpTimeOpts');
        var dtpCustomTimeRow = document.getElementById('dtpCustomTimeRow');
        var dtpCustomTimeInput = document.getElementById('dtpCustomTimeInput');
        var dtpQuickBtns = dateTimeField.querySelectorAll('.dtp-quick-btn');

        var TIME_LABELS = { any: 'Any time', morning: 'Morning', afternoon: 'Afternoon', evening: 'Evening', custom: 'Custom' };
        var WEEKDAY_SHORT = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        var MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        var today = new Date();
        today.setHours(0, 0, 0, 0);

        var selectedDate = new Date(today);
        var selectedTime = 'any';
        var hasCustomSelection = false;
        var viewYear = today.getFullYear();
        var viewMonth = today.getMonth();

        function toISODate(d) {
            var y = d.getFullYear();
            var m = String(d.getMonth() + 1).padStart(2, '0');
            var day = String(d.getDate()).padStart(2, '0');
            return y + '-' + m + '-' + day;
        }

        function isSameDay(a, b) {
            return a.getFullYear() === b.getFullYear() && a.getMonth() === b.getMonth() && a.getDate() === b.getDate();
        }

        function formatShortDate(d) {
            return WEEKDAY_SHORT[d.getDay()] + ', ' + MONTH_NAMES[d.getMonth()].slice(0, 3) + ' ' + d.getDate();
        }

        function dateLabelFor(d) {
            var tomorrow = new Date(today); tomorrow.setDate(tomorrow.getDate() + 1);
            if (isSameDay(d, today)) return 'Today';
            if (isSameDay(d, tomorrow)) return 'Tomorrow';
            return formatShortDate(d);
        }

        function updateTriggerLabel() {
            if (!hasCustomSelection) {
                dtpDisplay.textContent = 'Any time';
                return;
            }
            var parts = [dateLabelFor(selectedDate)];
            if (selectedTime !== 'any') {
                if (selectedTime === 'custom' && dtpCustomTimeInput.value) {
                    parts.push(dtpCustomTimeInput.value);
                } else {
                    parts.push(TIME_LABELS[selectedTime]);
                }
            }
            dtpDisplay.textContent = parts.join(' · ');
        }

        function syncHiddenInputs() {
            dtpDateInput.value = toISODate(selectedDate);
            dtpTimeInput.value = selectedTime === 'custom' ? (dtpCustomTimeInput.value || 'custom') : selectedTime;
        }

        function renderQuickSubs() {
            var tomorrow = new Date(today); tomorrow.setDate(tomorrow.getDate() + 1);
            dtpTodaySub.textContent = formatShortDate(today).split(', ')[1];
            dtpTomorrowSub.textContent = formatShortDate(tomorrow).split(', ')[1];
        }

        function renderQuickActiveState() {
            var tomorrow = new Date(today); tomorrow.setDate(tomorrow.getDate() + 1);
            dtpQuickBtns.forEach(function (btn) {
                var offset = parseInt(btn.getAttribute('data-offset'), 10);
                var target = offset === 0 ? today : tomorrow;
                btn.classList.toggle('is-active', hasCustomSelection && isSameDay(selectedDate, target));
            });
        }

        function renderCalendar() {
            dtpCalTitle.textContent = MONTH_NAMES[viewMonth] + ' ' + viewYear;
            dtpDaysGrid.innerHTML = '';

            var firstOfMonth = new Date(viewYear, viewMonth, 1);
            // Monday-first offset (0 = Monday ... 6 = Sunday)
            var startOffset = (firstOfMonth.getDay() + 6) % 7;
            var daysInMonth = new Date(viewYear, viewMonth + 1, 0).getDate();

            for (var i = 0; i < startOffset; i++) {
                var empty = document.createElement('span');
                empty.className = 'dtp-day is-empty';
                dtpDaysGrid.appendChild(empty);
            }

            for (var day = 1; day <= daysInMonth; day++) {
                var cellDate = new Date(viewYear, viewMonth, day);
                var btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'dtp-day';
                btn.textContent = day;

                if (cellDate < today) {
                    btn.classList.add('is-disabled');
                    btn.disabled = true;
                } else {
                    if (isSameDay(cellDate, today)) btn.classList.add('is-today');
                    if (hasCustomSelection && isSameDay(cellDate, selectedDate)) btn.classList.add('is-selected');
                    else if (!hasCustomSelection && isSameDay(cellDate, today)) btn.classList.add('is-selected');

                    btn.addEventListener('click', function () {
                        var clicked = this;
                        var y = viewYear, m = viewMonth, d = parseInt(clicked.textContent, 10);
                        selectedDate = new Date(y, m, d);
                        hasCustomSelection = true;
                        renderCalendar();
                        renderQuickActiveState();
                        updateTriggerLabel();
                        syncHiddenInputs();
                    });
                }

                dtpDaysGrid.appendChild(btn);
            }

            var isCurrentMonth = (viewYear === today.getFullYear() && viewMonth === today.getMonth());
            dtpPrevMonth.disabled = isCurrentMonth;
        }

        dtpPrevMonth.addEventListener('click', function () {
            viewMonth -= 1;
            if (viewMonth < 0) { viewMonth = 11; viewYear -= 1; }
            renderCalendar();
        });
        dtpNextMonth.addEventListener('click', function () {
            viewMonth += 1;
            if (viewMonth > 11) { viewMonth = 0; viewYear += 1; }
            renderCalendar();
        });

        dtpQuickBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var offset = parseInt(btn.getAttribute('data-offset'), 10);
                var target = new Date(today);
                target.setDate(target.getDate() + offset);
                selectedDate = target;
                hasCustomSelection = true;
                viewYear = target.getFullYear();
                viewMonth = target.getMonth();
                renderCalendar();
                renderQuickActiveState();
                updateTriggerLabel();
                syncHiddenInputs();
            });
        });

        dtpTimeOpts.querySelectorAll('.dtp-time-chip').forEach(function (chip) {
            chip.addEventListener('click', function () {
                dtpTimeOpts.querySelectorAll('.dtp-time-chip').forEach(function (c) { c.classList.remove('is-active'); });
                chip.classList.add('is-active');
                selectedTime = chip.getAttribute('data-time');
                hasCustomSelection = true;
                dtpCustomTimeRow.classList.toggle('is-visible', selectedTime === 'custom');
                updateTriggerLabel();
                syncHiddenInputs();
            });
        });

        dtpCustomTimeInput.addEventListener('change', function () {
            updateTriggerLabel();
            syncHiddenInputs();
        });

        dateTimeField.querySelector('.sf-value').addEventListener('click', function (e) {
            e.stopPropagation();
            var willOpen = !dateTimeField.classList.contains('open');
            closeAllSearchDropdowns(dateTimeField);
            dateTimeField.classList.toggle('open', willOpen);
        });

        dateTimeField.querySelector('.dtp-panel').addEventListener('click', function (e) {
            e.stopPropagation();
        });

        renderQuickSubs();
        renderCalendar();
        renderQuickActiveState();
        syncHiddenInputs();
    }

    if (locationField) {
        locationField.querySelector('.sf-value').addEventListener('click', function (e) {
            e.stopPropagation();
            closeAllSearchDropdowns(locationField);
            locationField.classList.add('open');
        });
        var locDdPanel = document.getElementById('locationDropdownPanel');
        if (locDdPanel) {
            locDdPanel.addEventListener('click', function (e) { e.stopPropagation(); });
        }
    }

    document.addEventListener('click', function (e) {
        document.querySelectorAll('.search-card .sf.open').forEach(function (sf) {
            if (!sf.contains(e.target)) sf.classList.remove('open');
        });
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeAllSearchDropdowns(null);
        }
    });
});