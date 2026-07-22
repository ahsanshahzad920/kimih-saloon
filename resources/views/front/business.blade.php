@extends('user.layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/landing-page.css') }}?v={{ time() }}">
@endsection

@section('content')
    {{-- Redesigned Business Banner --}}
    <section class="for-business-banner-modern">
        {{-- Background glow blobs --}}
        <div class="hero-blob hero-blob-1"></div>
        <div class="hero-blob hero-blob-2"></div>

        <div class="container">
            <h1>{{ $data->title ?? 'Transform Your Business with Kimih' }}</h1>
            <h4>{{ $data->sub_title ?? 'Join the leading marketplace for beauty and wellness providers.' }}</h4>
            <a href="{{ route('auth-business-sign-up') }}" class="default-btn">Join For Free <i class="fa-solid fa-arrow-right"></i></a>
        </div>

        {{-- SVG Wave shape divider --}}
        <div class="hero-wave-divider">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" preserveAspectRatio="none">
                <path d="M0,32L120,42.7C240,53,480,75,720,74.7C960,75,1200,53,1320,42.7L1440,32L1440,120L1320,120C1200,120,960,120,720,120C480,120,240,120,120,120L0,120Z"></path>
            </svg>
        </div>
    </section>

    {{-- Floating visual mockup card section --}}
    <section class="business-info-img bg-transparent">
        <div class="container">
            <div class="business-mockup-wrapper" data-aos="zoom-in">
                <img class="img-fluid" src="{{ asset('banners/dashboard.png') }}" alt="Kimih Business Dashboard Mockup" />
            </div>
        </div>
    </section>

    {{-- Business Stats --}}
    <section class="business-stats">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <h1>{{ $data->top_rating_title ?? 'Loved by thousands of businesses globally' }}</h1>
                    <p>{{ $data->top_rating_description ?? 'Manage appointments, streamline payments, and connect with beauty & wellness clients near you.' }}</p>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="row g-4">
                        <div class="col-sm-6 col-12">
                            <div class="business-metric-card">
                                <h4>{{ $data->business_partner_count ?? '10k+' }}</h4>
                                <p>{{ $data->business_partner_title ?? 'Active Partners' }}</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="business-metric-card">
                                <h4>{{ $data->stylists_count ?? '50k+' }}</h4>
                                <p>{{ $data->stylists_title ?? 'Registered Professionals' }}</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="business-metric-card">
                                <h4>{{ $data->appointmens_count ?? '2M+' }}</h4>
                                <p>{{ $data->appointmens_title ?? 'Bookings Managed' }}</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="business-metric-card">
                                <h4>{{ $data->countries_count ?? '15+' }}</h4>
                                <p>{{ $data->countries_title ?? 'Countries Active' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Grow Business features list --}}
    <section class="grow-business">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <h1>{{ $featurePage->title ?? 'Scale Your Business Features' }}</h1>
                    <h6>{{ $featurePage->description ?? 'Utilize state of the art tools to increase revenue and build client retention.' }}</h6>
                </div>
            </div>
            <div class="row g-4 mt-2">
                @forelse ($features as $feature)
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="feature-card-modern" data-aos="fade-up">
                            <img class="img-fluid" src="{{ asset(Storage::url($feature->icon ?? '')) }}" alt="{{ $feature->title ?? 'Feature' }}" />
                            <h4>{{ $feature->title ?? '' }}</h4>
                            <p>{{ $feature->description ?? '' }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">
                        <p>No features loaded yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Alternate Detailed Sections --}}
    @forelse ($businessInfo as $index => $info)
        <section class="business-info-section-modern bg-white">
            <div class="container">
                <div class="row align-items-center g-5">
                    @if ($index % 2 == 0)
                        <div class="col-lg-5" data-aos="fade-right">
                            <img class="img-fluid"
                                src="{{ $info->image ? asset(Storage::url($info->image)) : asset('banners/dashboard.png') }}"
                                alt="{{ $info->title ?? 'Business Details' }}" />
                        </div>
                        <div class="col-lg-7" data-aos="fade-left">
                            <h2>{{ $info->title ?? 'No Title' }}</h2>
                            <p>{!! $info->description ?? 'No description available.' !!}</p>
                        </div>
                    @else
                        <div class="col-lg-7 order-lg-1 order-2" data-aos="fade-right">
                            <h2>{{ $info->title ?? 'No Title' }}</h2>
                            <p>{!! $info->description ?? 'No description available.' !!}</p>
                        </div>
                        <div class="col-lg-5 order-lg-2 order-1" data-aos="fade-left">
                            <img class="img-fluid"
                                src="{{ $info->image ? asset(Storage::url($info->image)) : asset('banners/dashboard.png') }}"
                                alt="{{ $info->title ?? 'Business Details' }}" />
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @empty
        <p class="text-center text-muted py-5">No additional details configured.</p>
    @endforelse

    {{-- Redesigned Testimonials --}}
    <section class="testimonial-area kimih-section-spacing bg-light">
        <div class="container">
            <div class="kimih-section-header text-center mb-5">
                <span>Testimonials</span>
                <h2>See what our partners say</h2>
            </div>
            <div class="row g-4 mt-2">
                @forelse ($feedback as $feedback_item)
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="testimonial-card-modern" data-aos="fade-up">
                            <div class="testimonial-quote">
                                {{ $feedback_item->feedback ?? 'Incredible partner features!' }}
                            </div>
                            <div class="testimonial-user">
                                <img src="{{ isset($feedback_item->image) ? asset($feedback_item->image) : asset('assets/images/testimonial/testimonial-img1.jpg') }}"
                                    class="testimonial-avatar" alt="{{ $feedback_item->name ?? 'Partner' }} avatar" />
                                <div class="testimonial-info">
                                    <h4>{{ $feedback_item->name ?? 'Partner' }}</h4>
                                    <div class="testimonial-rating">
                                        @for ($i = 0; $i < ($feedback_item->rating ?? 5); $i++)
                                            <i class="fa-solid fa-star"></i>
                                        @endfor
                                    </div>
                                    <span class="testimonial-verified">
                                        <i class="fa-solid fa-circle-check"></i> Verified Partner
                                    </span>
                                </div>
                              </div>
                          </div>
                      </div>
                  @empty
                      <div class="col-12 text-center text-muted">
                          <p>No testimonials available yet.</p>
                      </div>
                  @endforelse
              </div>
          </div>
      </section>

      {{-- Selectable service cards grid section --}}
      <section class="business-started bg-white">
          <div class="container">
              <div class="kimih-section-header text-center mb-5">
                  <span>Get Started</span>
                  <h2>Pick a business type to get started for free</h2>
              </div>
              
              <div class="services-card-grid">
                  
                  <div class="service-selectable-card">
                      <input type="checkbox" id="srv_nail" value="1">
                      <div class="service-card-inner">
                          <img src="{{ asset('assets/images/Nail services.svg') }}" alt="Nail icon">
                          <span>Nails</span>
                      </div>
                  </div>
                  
                  <div class="service-selectable-card">
                      <input type="checkbox" id="srv_hair" value="1">
                      <div class="service-card-inner">
                          <img src="{{ asset('assets/images/Haircut-styling.svg') }}" alt="Hair icon">
                          <span>Haircut & styling</span>
                      </div>
                  </div>

                  <div class="service-selectable-card">
                      <input type="checkbox" id="srv_eyebrows" value="1">
                      <div class="service-card-inner">
                          <img src="{{ asset('assets/images/Eyebrows-lashes.svg') }}" alt="Eyebrow icon">
                          <span>Eyebrows & lashes</span>
                      </div>
                  </div>

                  <div class="service-selectable-card">
                      <input type="checkbox" id="srv_inject" value="1">
                      <div class="service-card-inner">
                          <img src="{{ asset('assets/images/injection.png') }}" alt="Injectables icon">
                          <span>Injectables</span>
                      </div>
                  </div>

                  <div class="service-selectable-card">
                      <input type="checkbox" id="srv_makeup" value="1">
                      <div class="service-card-inner">
                          <img src="{{ asset('assets/images/Makeup.svg') }}" alt="Makeup icon">
                          <span>Makeup</span>
                      </div>
                  </div>

                  <div class="service-selectable-card">
                      <input type="checkbox" id="srv_massage" value="1">
                      <div class="service-card-inner">
                          <img src="{{ asset('assets/images/Massage.svg') }}" alt="Massage icon">
                          <span>Massage</span>
                      </div>
                  </div>

                  <div class="service-selectable-card">
                      <input type="checkbox" id="srv_hairext" value="1">
                      <div class="service-card-inner">
                          <img src="{{ asset('assets/images/Hair extention.svg') }}" alt="Hair extensions icon">
                          <span>Extensions</span>
                      </div>
                  </div>

                  <div class="service-selectable-card">
                      <input type="checkbox" id="srv_hairrem" value="1">
                      <div class="service-card-inner">
                          <img src="{{ asset('assets/images/Hair removel.svg') }}" alt="Hair removal icon">
                          <span>Hair removal</span>
                      </div>
                  </div>

                  <div class="service-selectable-card">
                      <input type="checkbox" id="srv_tattoo" value="1">
                      <div class="service-card-inner">
                          <img src="{{ asset('assets/images/Fitness.svg') }}" alt="Tattoo icon">
                          <span>Tattoo & piercing</span>
                      </div>
                  </div>

                  <div class="service-selectable-card">
                      <input type="checkbox" id="srv_dental" value="1">
                      <div class="service-card-inner">
                          <img src="{{ asset('assets/images/Dental.png') }}" alt="Dental icon">
                          <span>Dental</span>
                      </div>
                  </div>

                  <div class="service-selectable-card">
                      <input type="checkbox" id="srv_therapy" value="1">
                      <div class="service-card-inner">
                          <img src="{{ asset('assets/images/tharapy.png') }}" alt="Therapy icon">
                          <span>Therapy</span>
                      </div>
                  </div>

                  <div class="service-selectable-card">
                      <input type="checkbox" id="srv_spa" value="1">
                      <div class="service-card-inner">
                          <img src="{{ asset('assets/images/spa.png') }}" alt="Spa icon">
                          <span>Spa</span>
                      </div>
                  </div>

              </div>

              {{-- Centered Get Started button linking to register --}}
              <div class="text-center mt-5">
                  <a href="{{ route('auth-business-sign-up') }}" class="btn-business-primary py-3 px-5 fs-5">
                      Get Started Now <i class="fa-solid fa-arrow-right ms-2"></i>
                  </a>
              </div>
          </div>
      </section>
@endsection
