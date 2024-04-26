@extends('layouts.header')
@section('content')
    <section class="tj-banner-form">
        <div class="container">
            <div class="row">
                <!--Header Banner Caption Content Start-->
                <div class="col-md-8 col-sm-7">
                    <div class="banner-caption">
                        <div class="banner-inner bounceInLeft animated delay-2s">
                            <strong>More recently with desktop publishing software ncluding versions</strong>
                            <h2>Upto 25% off on first booking through your app</h2>
                            <div class="banner-btns">
                                <a href="https://themesjungle.net/html/prime-cab/faq.html" class="btn-style-1"><i
                                        class="fab fa-apple"></i> Download App</a>
                                <a href="https://themesjungle.net/html/prime-cab/faq.html" class="btn-style-2"><i
                                        class="fab fa-android"></i> Download App</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Header Banner Caption Content End-->
                <!--Header Banner Form Content Start-->
                <div class="col-md-4 col-sm-5">
                    <div class="trip-outer">
                        <div class="trip-type-tabs">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#one-way" data-toggle="tab">One Way</a></li>
                                <li><a href="#two-way" data-toggle="tab">Two Way</a></li>
                            </ul>
                        </div>
                        <!--Banner Tab Content Start-->
                        <div class="tab-content">
                            <div class="tab-pane active" id="one-way">
                                <!--Banner Form Content Start-->
                                <form method="POST" class="trip-type-frm">
                                    <div class="field-outer">
                                        <span class="fas fa-search"></span>
                                        <input type="text" name="pick_loc" placeholder="Pickup Locations">
                                    </div>
                                    <div class="field-outer">
                                        <span class="fas fa-search"></span>
                                        <input type="text" name="drop_loc" placeholder="Drop Locations">
                                    </div>
                                    <div class="field-outer">
                                        <span class="fas fa-calendar-alt"></span>
                                        <input type="text" name="pick_date" placeholder="Select your Date">
                                    </div>
                                    <div class="field-outer">
                                        <span class="far fa-clock"></span>
                                        <input type="text" name="drop_date" placeholder="Select Timings">
                                    </div>
                                    <div class="field-outer">
                                        <input type="checkbox" name="promo_code" id="promo_code">
                                        <label for="promo_code">I Have Promotional Code</label>
                                    </div>
                                    <button type="submit" class="search-btn">Search Cabs <i
                                            class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                                </form>
                                <!--Banner Form Content End-->
                            </div>
                        </div>
                        <!--Banner Tab Content End-->
                    </div>
                </div>
                <!--Header Banner Form Content End-->
            </div>
        </div>
    </section>
    <!--Header Banner Content End-->

    <!--Offer Content Start-->
    <section class="tj-offers">
        <div class="row">
            <!--Offer Box Content Start-->
            <div class="col-md-3 col-sm-6">
                <div class="offer-box">
                    <img src="{{ asset('images/offer-icon1.png') }}" alt="" />
                    <div class="offer-info">
                        <h4>Best Price Guaranteed</h4>
                        <p>A more recently with desktop softy like aldus page maker.</p>
                    </div>
                </div>
            </div>
            <!--Offer Box Content End-->
            <!--Offer Box Content Start-->
            <div class="col-md-3 col-sm-6">
                <div class="offer-box">
                    <img src="images/offer-icon2.png" alt="" />
                    <div class="offer-info">
                        <h4>24/7 Customer Care</h4>
                        <p>A more recently with desktop softy like aldus page maker.</p>
                    </div>
                </div>
            </div>
            <!--Offer Box Content End-->
            <!--Offer Box Content Start-->
            <div class="col-md-3 col-sm-6">
                <div class="offer-box">
                    <img src="images/offer-icon3.png" alt="" />
                    <div class="offer-info">
                        <h4>Home Pickups</h4>
                        <p>A more recently with desktop softy like aldus page maker.</p>
                    </div>
                </div>
            </div>
            <!--Offer Box Content End-->
            <!--Offer Box Content Start-->
            <div class="col-md-3 col-sm-6">
                <div class="offer-box">
                    <img src="images/offer-icon4.png" alt="" />
                    <div class="offer-info">
                        <h4>Easy Bookings</h4>
                        <p>A more recently with desktop softy like aldus page maker.</p>
                    </div>
                </div>
            </div>
            <!--Offer Box Content End-->
        </div>
    </section>
    <!--Offer Content End-->

    <!--Welcome Section Content Start-->
    <section class="tj-welcome">
        <div class="container">
            <div class="row">
                <!--Welcome Section Start-->
                <div class="col-md-6 col-sm-7">
                    <div class="about-info">
                        <div class="tj-heading-style">
                            <h3>Who We Are</h3>
                        </div>
                        <p>Lorem Ipsum passages, and more recently with desktop publishing software like aldus
                            pageMaker including versions of all the Lorem Ipsum generators on thet Internet tends to
                            repeat predefined chunks as necessary, making this an web evolved over the years,
                            sometimes by accident.</p>
                        <a href="https://themesjungle.net/html/prime-cab/fleet-grid.html">See all Vehicles<i
                                class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                        <ul class="facts-list">
                            <li>
                                <strong class="fact-count">100</strong>
                                <i class="fa fa-percent"></i>
                                <span>Happy Customer</span>
                            </li>
                            <li>
                                <strong class="fact-count">200</strong>
                                <i class="fas fa-plus"></i>
                                <span>Luxury Cars</span>
                            </li>
                            <li>
                                <strong class="fact-count">12,000</strong>
                                <i class="fas fa-arrow-up"></i>
                                <span>Kilometers Driven</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--Welcome Section End-->
                <!--Welcome Section Image Box Start-->
                <div class="col-md-6 col-sm-5">
                    <div class="welcome-banner">
                        <img src="images/welcome-img.jpg" alt="" />
                    </div>
                </div>
                <!--Welcome Section Image Box End-->
            </div>
        </div>
    </section>
    <!--Welcome Section Content End-->


    <section class="fleet-carousel">
        <div class="col-md-12 col-sm-12">
            <div class="tj-heading-style">
                <h3>Our Car Fleet</h3>
            </div>
        </div>
        <div class="carousel-outer">
            <div class="cab-carousel" id="cab-carousel">
                <div class="fleet-item">
                    <img src="images/fleet-carousel-img1.png" alt="" />
                    <div class="fleet-inner">
                        <h4>2017 Chevrolet Pepe</h4>
                        <ul>
                            <li><i class="fas fa-taxi"></i>Luxery</li>
                            <li><i class="fas fa-user-circle"></i>2 Passengers</li>
                            <li><i class="fas fa-tachometer-alt"></i>5.6/100 MPG</li>
                        </ul>
                        <strong class="price">$190<span> / day</span></strong>
                        <a href="https://themesjungle.net/html/prime-cab/booking-form.html">Book Now <i
                                class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="fleet-item">
                    <img src="images/fleet-carousel-img2.png" alt="" />
                    <div class="fleet-inner">
                        <h4>Mercedes Benz</h4>
                        <ul>
                            <li><i class="fas fa-taxi"></i>Luxery</li>
                            <li><i class="fas fa-user-circle"></i>5 Passengers</li>
                            <li><i class="fas fa-tachometer-alt"></i>7.6/100 MPG</li>
                        </ul>
                        <strong class="price">$390<span> / day</span></strong>
                        <a href="https://themesjungle.net/html/prime-cab/booking-form.html">Book Now <i
                                class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="fleet-item">
                    <img src="images/fleet-carousel-img3.png" alt="" />
                    <div class="fleet-inner">
                        <h4>Renault Sedan</h4>
                        <ul>
                            <li><i class="fas fa-taxi"></i>Luxery</li>
                            <li><i class="fas fa-user-circle"></i>5 Passengers</li>
                            <li><i class="fas fa-tachometer-alt"></i>5.6/100 MPG</li>
                        </ul>
                        <strong class="price">$250<span> / day</span></strong>
                        <a href="https://themesjungle.net/html/prime-cab/booking-form.html">Book Now <i
                                class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Cab Services Section Start-->
    <section class="cab-services">
        <div class="container">
            <div class="row">
                <!--Cab Services Heading Start-->
                <div class="tj-heading-style">
                    <h3>Our Services</h3>
                    <p>Lorem Ipsum passages, and more recently with desktop publishing software like aldus pageMaker
                        including versions.</p>
                </div>
                <!--Cab Services Heading End-->
                <!--Cab Services Outer Start-->
                <div class="col-md-4 col-sm-4">
                    <div class="cab-service-box">
                        <!--Cab Services Thumb Start-->
                        <figure class="service-thumb">
                            <img src="images/cab-service-icon1.png" alt="" />
                        </figure>
                        <!--Cab Services Thumb End-->
                        <!--Cab Services Info Start-->
                        <div class="service-desc">
                            <h4>Restaurants</h4>
                            <p>A more recently with desktop softy like aldus page maker.</p>
                        </div>
                        <!--Cab Services Info End-->
                    </div>
                </div>
                <!--Cab Services Outer End-->
                <!--Cab Services Outer Start-->
                <div class="col-md-4 col-sm-4">
                    <div class="cab-service-box">
                        <!--Cab Services Thumb Start-->
                        <figure class="service-thumb">
                            <img src="images/cab-service-icon2.png" alt="" />
                        </figure>
                        <!--Cab Services Thumb End-->
                        <!--Cab Services Info Start-->
                        <div class="service-desc">
                            <h4>Airports</h4>
                            <p>A more recently with desktop softy like aldus page maker.</p>
                        </div>
                        <!--Cab Services Info End-->
                    </div>
                </div>
                <!--Cab Services Outer End-->
                <!--Cab Services Outer Start-->
                <div class="col-md-4 col-sm-4">
                    <div class="cab-service-box">
                        <!--Cab Services Thumb Start-->
                        <figure class="service-thumb">
                            <img src="images/cab-service-icon3.png" alt="" />
                        </figure>
                        <!--Cab Services Thumb End-->
                        <!--Cab Services Info Start-->
                        <div class="service-desc">
                            <h4>Hospitals</h4>
                            <p>A more recently with desktop softy like aldus page maker.</p>
                        </div>
                        <!--Cab Services Info End-->
                    </div>
                </div>
                <!--Cab Services Outer End-->
                <!--Cab Services Outer Start-->
                <div class="col-md-4 col-sm-4">
                    <div class="cab-service-box">
                        <!--Cab Services Thumb Start-->
                        <figure class="service-thumb">
                            <img src="images/cab-service-icon4.png" alt="" />
                        </figure>
                        <!--Cab Services Thumb End-->
                        <!--Cab Services Info Start-->
                        <div class="service-desc">
                            <h4>Beaches</h4>
                            <p>A more recently with desktop softy like aldus page maker.</p>
                        </div>
                        <!--Cab Services Info End-->
                    </div>
                </div>
                <!--Cab Services Outer End-->
                <!--Cab Services Outer Start-->
                <div class="col-md-4 col-sm-4">
                    <div class="cab-service-box">
                        <!--Cab Services Thumb Start-->
                        <figure class="service-thumb">
                            <img src="images/cab-service-icon5.png" alt="" />
                        </figure>
                        <!--Cab Services Thumb End-->
                        <!--Cab Services Info Start-->
                        <div class="service-desc">
                            <h4>Shopping Malls</h4>
                            <p>A more recently with desktop softy like aldus page maker.</p>
                        </div>
                        <!--Cab Services Info End-->
                    </div>
                </div>
                <!--Cab Services Outer End-->
                <!--Cab Services Outer Start-->
                <div class="col-md-4 col-sm-4">
                    <div class="cab-service-box">
                        <!--Cab Services Thumb Start-->
                        <figure class="service-thumb">
                            <img src="images/cab-service-icon6.png" alt="" />
                        </figure>
                        <!--Cab Services Thumb End-->
                        <!--Cab Services Info Start-->
                        <div class="service-desc">
                            <h4>Wedding Parties</h4>
                            <p>A more recently with desktop softy like aldus page maker.</p>
                        </div>
                        <!--Cab Services Info End-->
                    </div>
                </div>
                <!--Cab Services Outer End-->
            </div>
        </div>
    </section>
    <!--Cab Services Section End-->



    <!--Testimonials Section Start-->
    <section class="tj-reviews">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="tj-heading-style">
                        <h3>Testimonials</h3>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <!--Testimonials Slider Content Start-->
                    <div id="testimonial-slider" class="reviews-slider">
                        <!--Review Item Start-->
                        <div class="review-item">
                            <figure class="img-box">
                                <img src="images/testimonial-img1.png" alt="" />
                            </figure>
                            <div class="review-info">
                                <strong>James Peter</strong>
                                <span class="icon-star-empty icomoon rating"></span>
                                <span class="icon-star-empty icomoon rating"></span>
                                <span class="icon-star-empty icomoon rating"></span>
                                <span class="icon-star-empty icomoon rating"></span>
                                <span class="icon-star-empty icomoon"></span>
                                <div class="review-quote">
                                    <p>Lorem Ipsum passages, and more recently with desktop publish soft like aldus
                                        pageMaker including versions</p>
                                </div>
                            </div>
                        </div>
                        <!--Review Item End-->
                        <!--Review Item Start-->
                        <div class="review-item">
                            <figure class="img-box">
                                <img src="images/testimonial-img2.png" alt="" />
                            </figure>
                            <div class="review-info">
                                <strong>Stefy Grafi</strong>
                                <span class="icon-star-empty icomoon rating"></span>
                                <span class="icon-star-empty icomoon rating"></span>
                                <span class="icon-star-empty icomoon rating"></span>
                                <span class="icon-star-empty icomoon rating"></span>
                                <span class="icon-star-empty icomoon"></span>
                                <div class="review-quote">
                                    <p>Lorem Ipsum passages, and more recently with desktop publish soft like aldus
                                        pageMaker including versions</p>
                                </div>
                            </div>
                        </div>
                        <!--Review Item End-->
                        <!--Review Item Start-->
                        <div class="review-item">
                            <figure class="img-box">
                                <img src="images/testimonial-img1.png" alt="" />
                            </figure>
                            <div class="review-info">
                                <strong>James Peter</strong>
                                <span class="icon-star-empty icomoon rating"></span>
                                <span class="icon-star-empty icomoon rating"></span>
                                <span class="icon-star-empty icomoon rating"></span>
                                <span class="icon-star-empty icomoon rating"></span>
                                <span class="icon-star-empty icomoon"></span>
                                <div class="review-quote">
                                    <p>Lorem Ipsum passages, and more recently with desktop publish soft like aldus
                                        pageMaker including versions</p>
                                </div>
                            </div>
                        </div>
                        <!--Review Item End-->
                    </div>
                    <!--Testimonials Slider Content End-->
                </div>
            </div>
        </div>
    </section>
    <!--Testimonials Section End-->
@endsection
