@extends('user.layouts.app')

@section('content')
    <div class="inner-banner about-pages">
        <div class="container-fluid">
            <!-- <div class="row align-items-center">
          <div class="col-lg-12 mx-auto text-center">
            <div class="inner-title">
              <h3>About Us</h3>
              <ul>
                <li>
                  <a href="index.html">Home</a>
                </li>
                <li>About Us</li>
              </ul>
            </div>
          </div>

        </div> -->
        </div>
    </div>
    <div class="about-area pt-100 pb-70">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-item">
                        <div class="about-slider owl-carousel owl-theme">
                            @if (!is_null($record) && !is_null($record->images))
                                @foreach (json_decode($record->images, true) as $image)
                                    <div class="about-img">

                                        <div class="top-border"></div>

                                        <img src="{{ asset(Storage::url($image ?? '')) }}" alt="About" />

                                        <div class="bottom-border bottom-border-color"></div>

                                    </div>
                                @endforeach
                            @endif

                        </div>
                        <div class="about-vector">
                            <img src="assets/images/about/about-vector.png" alt="About" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content pl-20">
                        <div class="section-title">
                            <span>{{ $record->heading ?? '' }}</span>
                            <h2>{{ $record->title ?? '' }}</h2>
                            <p class="mt-3">
                                {{ $record->description ?? '' }}
                            </p>
                        </div>
                        <a href="about.html" class="default-btn border-radius-5">Learn More <i
                                class="flaticon-arrow-pointing-to-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="intro-video-area section-bg pb-100">
        <div class="container">
            <div class="video-content"
                style="background-image: url({{ asset(Storage::url($record->video_background_image ?? '')) }})">
                <a href="{{ $record->video_link ?? '' }} " class="play-btn">
                    <i class="ri-play-fill"></i>
                </a>
            </div>
            <div class="section-title text-center pt-100">
                <span class="color1">{{ $record->section_heading ?? '' }}</span>
                <h2 class="color1">{{ $record->section_title ?? '' }}</h2>
            </div>
        </div>
    </div>

    <div class="testimonial-area section-bg pt-100 pb-70">
        <div class="container">
            <div class="section-title mb-45 text-center">
                <span>Our Testimonial</span>
                <h2>What Our Clients Feedback</h2>
            </div>
            <div class="testimonial-slider owl-carousel owl-theme">
                <div class="testimonial-item">
                    <img src="assets/images/testimonial/testimonial-img1.jpg" alt="Testimonial" />
                    <h3>Emanuele Ebrew</h3>
                    <p>Pellentesque habitant morbi tristique senectus netus et malesuada fames ac turpis egestas
                        vestibulum tortor quam feugiat vit tristique senectus</p>
                    <div class="rating">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-line"></i>
                        <i class="ri-star-line"></i>
                    </div>
                </div>
                <div class="testimonial-item">
                    <img src="assets/images/testimonial/testimonial-img2.jpg" alt="Testimonial" />
                    <h3>Giovanni Loren</h3>
                    <p>Pellentesque habitant morbi tristique senectus netus et malesuada fames ac turpis egestas
                        vestibulum tortor quam feugiat vit tristique senectus</p>
                    <div class="rating">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-line"></i>
                        <i class="ri-star-line"></i>
                    </div>
                </div>
                <div class="testimonial-item">
                    <img src="assets/images/testimonial/testimonial-img3.jpg" alt="Testimonial" />
                    <h3>Massimo Pasquale</h3>
                    <p>Pellentesque habitant morbi tristique senectus netus et malesuada fames ac turpis egestas
                        vestibulum tortor quam feugiat vit tristique senectus</p>
                    <div class="rating">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-line"></i>
                        <i class="ri-star-line"></i>
                    </div>
                </div>
                <div class="testimonial-item">
                    <img src="assets/images/testimonial/testimonial-img4.jpg" alt="Testimonial" />
                    <h3>Gabriele Edoardo </h3>
                    <p>Pellentesque habitant morbi tristique senectus netus et malesuada fames ac turpis egestas
                        vestibulum tortor quam feugiat vit tristique senectus</p>
                    <div class="rating">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-line"></i>
                        <i class="ri-star-line"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="blog-area pt-100 pb-70 section-bg">
        <div class="container">
            <div class="section-title mb-45 text-center">
                <span>News Feeds</span>
                <h2>Our Latest Blog Update</h2>
            </div>
            <div class="row justify-content-center">
                @foreach ($blogs as $blog)
                    <div class="col-lg-4 col-md-6">
                        <div class="blog-card">
                            <a href="{{ route('blog.details', $blog->slug ?? '') }}" class="img">
                                <img src="{{ asset(Storage::url($blog->image ?? '')) }}" alt="Blog" />
                            </a>
                            <div class="content">
                                <ul>
                                    <li>
                                        <i class="flaticon-user"></i>
                                        <a href="author.html">{{ $blog->user->name ?? '' }}</a>
                                    </li>
                                    <li>
                                        <i class="flaticon-clock"></i>
                                        {{ \Carbon\Carbon::parse($blog->created_at)->format('M d, Y') }}

                                    </li>
                                </ul>
                                <h3>
                                    <a href="{{ route('blog.details', $blog->slug ?? '') }}">{{ $blog->title ?? '' }}</a>
                                </h3>
                                <a href="{{ route('blog.details', $blog->slug ?? '') }}"
                                    class="default-btn two border-radius-5">Read More <i
                                        class="flaticon-arrow-pointing-to-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
