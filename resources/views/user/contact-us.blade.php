@extends('user.layouts.app')

@section('title', 'Contact Us | Kimih')

@section('styles')
    <link rel="preconnect" href="https://api.fontshare.com">
    <link href="https://api.fontshare.com/v2/css?f[]=gambetta@400,500,600&f[]=switzer@400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/kimih.css') }}?v={{ time() }}">
    <style>
        .contact-hero {
            position: relative;
            padding: clamp(100px, 12vw, 140px) 0 clamp(40px, 5vw, 60px);
            background: linear-gradient(165deg, #FFF 0%, #F8F5FB 100%);
            overflow: hidden;
        }
        .contact-card-wrap {
            position: relative;
            z-index: 2;
            background: #ffffff;
            border: 1px solid var(--line);
            border-radius: var(--r-card);
            box-shadow: var(--sh-lg);
            padding: clamp(24px, 4vw, 48px);
        }
        .contact-info-card {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 24px;
            border-radius: var(--r-card);
            background: var(--surface);
            border: 1px solid var(--line);
            height: 100%;
            transition: transform 0.28s, border-color 0.28s, box-shadow 0.28s;
        }
        .contact-info-card:hover {
            transform: translateY(-4px);
            border-color: var(--violet-soft);
            box-shadow: var(--sh-md);
        }
        .contact-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: var(--violet-soft);
            color: var(--violet);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }
        .contact-form-group {
            position: relative;
            margin-bottom: 20px;
        }
        .contact-form-group label {
            display: block;
            font-size: 0.76rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--violet);
            margin-bottom: 6px;
        }
        .contact-input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }
        .contact-input-wrap .ic {
            position: absolute;
            left: 16px;
            color: var(--body);
            opacity: 0.6;
            width: 1.1em;
            height: 1.1em;
            pointer-events: none;
        }
        .contact-input {
            width: 100%;
            min-height: 50px;
            padding: 12px 16px 12px 46px;
            border-radius: 14px;
            border: 1px solid var(--line);
            background: var(--surface);
            font-family: var(--ff-ui);
            font-size: 0.95rem;
            color: var(--ink);
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        }
        .contact-input:focus {
            outline: none;
            border-color: var(--violet);
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(109, 40, 217, 0.1);
        }
        textarea.contact-input {
            min-height: 130px;
            padding-top: 14px;
            resize: vertical;
        }
        .breadcrumb-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--violet-soft);
            color: var(--violet);
            font-size: 0.8rem;
            font-weight: 600;
            padding: 6px 16px;
            border-radius: var(--r-pill);
            margin-bottom: 16px;
        }
    </style>
@endsection

@section('content')
<main id="main">

    <!-- ============ HERO SECTION ============ -->
    <header class="contact-hero">
        <div class="hero-bg" aria-hidden="true">
            <span class="blob blob-1"></span>
            <span class="blob blob-2"></span>
        </div>

        <div class="container text-center">
            <span class="breadcrumb-pill">
                <a href="/" style="color:var(--violet)">Home</a> / Contact Us
            </span>
            <h1 class="mb-3">We're here to help.</h1>
            <p class="lead mx-auto">Have a question about booking, partnerships, or your account? Send us a message and our support team will reply promptly.</p>
        </div>
    </header>

    <!-- ============ CONTACT INFO CARDS ============ -->
    <section class="sec pt-0">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="contact-info-card">
                        <div class="contact-icon-box">
                            <svg class="ic"><use href="#i-bell"/></svg>
                        </div>
                        <div>
                            <h3 class="h-card mb-1" style="font-size:1.1rem">Customer Support</h3>
                            <p class="mb-1" style="font-size:0.9rem">support@kimih.com</p>
                            <span style="font-size:0.8rem;color:var(--violet);font-weight:600">Average response: &lt; 2 hrs</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="contact-info-card">
                        <div class="contact-icon-box">
                            <svg class="ic"><use href="#i-geo"/></svg>
                        </div>
                        <div>
                            <h3 class="h-card mb-1" style="font-size:1.1rem">Our Headquarters</h3>
                            <p class="mb-1" style="font-size:0.9rem">Clifton Block 4, Karachi, Pakistan</p>
                            <span style="font-size:0.8rem;color:var(--body);opacity:0.8">Open Mon–Sat: 9am – 8pm</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="contact-info-card">
                        <div class="contact-icon-box">
                            <svg class="ic"><use href="#i-shop"/></svg>
                        </div>
                        <div>
                            <h3 class="h-card mb-1" style="font-size:1.1rem">Partner With Us</h3>
                            <p class="mb-1" style="font-size:0.9rem">Grow your salon or spa business</p>
                            <a href="{{ route('register') }}" style="font-size:0.84rem;color:var(--violet);font-weight:700">List Your Salon &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ============ CONTACT FORM SECTION ============ -->
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="contact-card-wrap">
                        <div class="text-center mb-4">
                            <span class="eyebrow">Send a message</span>
                            <h2 class="h-sec">Do you have any questions?</h2>
                        </div>

                        <form id="contactForm" action="{{ route('contact-us.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                {{-- Full Name --}}
                                <div class="col-md-6">
                                    <div class="contact-form-group">
                                        <label for="name">Your Name</label>
                                        <div class="contact-input-wrap">
                                            <svg class="ic"><use href="#i-usercircle"/></svg>
                                            <input type="text" name="name" id="name" class="contact-input" placeholder="e.g. Ayesha Khan" required>
                                        </div>
                                    </div>
                                </div>

                                {{-- Email Address --}}
                                <div class="col-md-6">
                                    <div class="contact-form-group">
                                        <label for="email">Email Address</label>
                                        <div class="contact-input-wrap">
                                            <svg class="ic"><use href="#i-bell"/></svg>
                                            <input type="email" name="email" id="email" class="contact-input" placeholder="e.g. ayesha@example.com" required>
                                        </div>
                                    </div>
                                </div>

                                {{-- Phone Number --}}
                                <div class="col-md-6">
                                    <div class="contact-form-group">
                                        <label for="phone">Phone Number</label>
                                        <div class="contact-input-wrap">
                                            <svg class="ic"><use href="#i-card"/></svg>
                                            <input type="tel" name="phone" id="phone" class="contact-input" placeholder="+92 300 1234567" required>
                                        </div>
                                    </div>
                                </div>

                                {{-- Subject --}}
                                <div class="col-md-6">
                                    <div class="contact-form-group">
                                        <label for="subject">Subject</label>
                                        <div class="contact-input-wrap">
                                            <svg class="ic"><use href="#i-doc"/></svg>
                                            <input type="text" name="subject" id="subject" class="contact-input" placeholder="e.g. Appointment Inquiry" required>
                                        </div>
                                    </div>
                                </div>

                                {{-- Message --}}
                                <div class="col-12">
                                    <div class="contact-form-group">
                                        <label for="message">Your Message</label>
                                        <div class="contact-input-wrap">
                                            <svg class="ic" style="top:18px;"><use href="#i-megaphone"/></svg>
                                            <textarea name="message" id="message" class="contact-input" placeholder="Write your question or message here..." required></textarea>
                                        </div>
                                    </div>
                                </div>

                                {{-- Terms Agreement --}}
                                <div class="col-12">
                                    <div class="d-flex align-items-center gap-2 my-2">
                                        <input type="checkbox" id="agree" checked required style="width:18px;height:18px;accent-color:var(--violet);">
                                        <label for="agree" style="font-size:0.88rem;color:var(--body);margin:0;text-transform:none;letter-spacing:normal;font-weight:400">
                                            I agree to the <a href="#" style="color:var(--violet);font-weight:600">Terms &amp; Conditions</a> and <a href="#" style="color:var(--violet);font-weight:600">Privacy Policy</a>.
                                        </label>
                                    </div>
                                </div>

                                {{-- Submit Button --}}
                                <div class="col-12 text-center mt-3">
                                    <button type="submit" class="btn-k btn-hero px-5 min-h-50">
                                        Send Message <svg class="ic"><use href="#i-arrow"/></svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ FAQ SECTION ============ -->
    <section class="sec sec-tint" id="faq">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <span class="eyebrow">Frequently asked</span>
                    <h2 class="h-sec">Quick answers before you write.</h2>
                    <p class="lead mt-3">Check out our most common questions for instant guidance.</p>
                </div>
                <div class="col-lg-8" id="faqList"></div>
            </div>
        </div>
    </section>

</main>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/kimih.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/content.js') }}?v={{ time() }}"></script>
@endsection
