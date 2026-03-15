@extends('user.layouts.app')

@section('content')
    <div class="inner-banner">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center">
                    <div class="inner-title">
                        <h3>Affiliate program</h3>
                        <ul>
                            <li>
                                <a href="{{ route('index') }}">Home</a>
                            </li>
                            <li>Affiliate program</li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="col-lg-5 col-md-5">
                <div class="inner-img">
                  <img src="assets/images/inner-banner/inner-banner10.png" alt="Inner Banner" />
                </div>
              </div> -->
            </div>
        </div>
    </div>
    <div class="services-area ptb-100">
        <div class="container">
            <div class="section-title mb-45 text-center">
                <span>Our Services</span>
                <h2>What We Offer</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="services-item-two">
                        <a href="service-details.html">
                            <img src="assets/images/services/services-img7.jpg" alt="Services" />
                        </a>
                        <div class="content">
                            <div class="icon">
                                <i class="flaticon-face-mask"></i>
                            </div>
                            <h3>
                                <a href="service-details.html">Makeup Lesson</a>
                            </h3>
                            <p>Lorem Ipsum has been the industry sta dummy text ever since the 1500s, when an unknown
                                printer took a galley of type </p>
                            <a href="#" class="learn-btn"> Learn More <i
                                    class="flaticon-arrow-pointing-to-right"></i>
                            </a>
                            <div class="content-right">
                                <img src="assets/images/services/services-vector-2.png" alt="Service" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-item-two">
                        <a href="#">
                            <img src="assets/images/services/services-img8.jpg" alt="Services" />
                        </a>
                        <div class="content">
                            <div class="icon">
                                <i class="flaticon-makeup-1"></i>
                            </div>
                            <h3>
                                <a href="#">Bridal Beauty Makeup</a>
                            </h3>
                            <p>Lorem Ipsum has been the industry sta dummy text ever since the 1500s, when an unknown
                                printer took a galley of type </p>
                            <a href="#" class="learn-btn"> Learn More <i
                                    class="flaticon-arrow-pointing-to-right"></i>
                            </a>
                            <div class="content-right">
                                <img src="assets/images/services/services-vector-2.png" alt="Service" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-item-two">
                        <a href="#">
                            <img src="assets/images/services/services-img9.jpg" alt="Services" />
                        </a>
                        <div class="content">
                            <div class="icon">
                                <i class="flaticon-hair-dye-brush"></i>
                            </div>
                            <h3>
                                <a href="#">Hair Coloring</a>
                            </h3>
                            <p>Lorem Ipsum has been the industry sta dummy text ever since the 1500s, when an unknown
                                printer took a galley of type </p>
                            <a href="#" class="learn-btn"> Learn More <i
                                    class="flaticon-arrow-pointing-to-right"></i>
                            </a>
                            <div class="content-right">
                                <img src="assets/images/services/services-vector-2.png" alt="Service" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-item-two">
                        <a href="#">
                            <img src="assets/images/services/services-img10.jpg" alt="Services" />
                        </a>
                        <div class="content">
                            <div class="icon">
                                <i class="flaticon-relax"></i>
                            </div>
                            <h3>
                                <a href="#">Body Message</a>
                            </h3>
                            <p>Lorem Ipsum has been the industry sta dummy text ever since the 1500s, when an unknown
                                printer took a galley of type </p>
                            <a href="#" class="learn-btn"> Learn More <i
                                    class="flaticon-arrow-pointing-to-right"></i>
                            </a>
                            <div class="content-right">
                                <img src="assets/images/services/services-vector-2.png" alt="Service" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-item-two">
                        <a href="#">
                            <img src="assets/images/services/services-img15.jpg" alt="Services" />
                        </a>
                        <div class="content">
                            <div class="icon">
                                <i class="flaticon-make-up"></i>
                            </div>
                            <h3>
                                <a href="#">Art Nail & Effects</a>
                            </h3>
                            <p>Lorem Ipsum has been the industry sta dummy text ever since the 1500s, when an unknown
                                printer took a galley of type </p>
                            <a href="service-details.html" class="learn-btn"> Learn More <i
                                    class="flaticon-arrow-pointing-to-right"></i>
                            </a>
                            <div class="content-right">
                                <img src="assets/images/services/services-vector-2.png" alt="Service" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-item-two">
                        <a href="service-details.html">
                            <img src="assets/images/services/services-img14.jpg" alt="Services" />
                        </a>
                        <div class="content">
                            <div class="icon">
                                <i class="flaticon-makeup"></i>
                            </div>
                            <h3>
                                <a href="service-details.html">Classic Nail</a>
                            </h3>
                            <p>Lorem Ipsum has been the industry sta dummy text ever since the 1500s, when an unknown
                                printer took a galley of type </p>
                            <a href="service-details.html" class="learn-btn"> Learn More <i
                                    class="flaticon-arrow-pointing-to-right"></i>
                            </a>
                            <div class="content-right">
                                <img src="assets/images/services/services-vector-2.png" alt="Service" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 text-center">
                    <div class="pagination-area">
                        <a href="blog-1.html" class="prev page-numbers">
                            <i class="flaticon-arrow-pointing-to-left"></i>
                        </a>
                        <span class="page-numbers current" aria-current="page">1</span>
                        <a href="blog-1.html" class="page-numbers">2</a>
                        <a href="blog-1.html" class="page-numbers">3</a>
                        <a href="blog-1.html" class="next page-numbers">
                            <i class="flaticon-arrow-pointing-to-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="services-shape">
            <img src="assets/images/services/services-vector-3.png" alt="Services" />
        </div>
    </div>
@endsection
