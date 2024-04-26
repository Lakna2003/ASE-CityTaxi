@extends('layouts.header')
@section('content')
    <section class="tj-banner-form">
        <div class="container">
            <div class="row">
                <!--Header Banner Caption Content Start-->
                <div class="col-md-8 col-sm-7">
                    <div class="banner-caption">
                        <div class="banner-inner bounceInLeft animated delay-2s">
                            <h2>Experience seamless travel with our City Taxi car reservation system</h2>
                            <strong>Powered by the latest desktop publishing software for a user-friendly
                                interface.</strong>
                            <div class="banner-btns">
                                {{-- <a href="{{ route('login') }}" class="btn-style-1"> Login</a> --}}
                                @guest
                                    <a href="{{ route('login') }}" class="btn-style-2">Login</a>
                                @endguest
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
                                <li class="active"><a href="#one-way" data-toggle="tab">Search Vehicles</a></li>
                            </ul>
                        </div>
                        <!--Banner Tab Content Start-->
                        <div class="tab-content">
                            <div class="tab-pane active" id="one-way">
                                <!--Banner Form Content Start-->
                                <form method="POST" class="trip-type-frm" action="{{ route('find.nearby.drivers') }}">
                                    @csrf

                                    <button type="button" id="getCurrentLocationBtn" class="btn btn-success book-btn">
                                        Get Current Location
                                    </button>
                                    <div class="field-outer">
                                        <span class="fas fa-search"></span>
                                        <input type="text" name="pick_loc" id="pickupLocation"
                                            placeholder="Pickup Locations" required>

                                    </div>
                                    <div class="field-outer">
                                        <span class="fas fa-search"></span>
                                        <input type="text" name="drop_loc" placeholder="Drop Locations" required>
                                    </div>

                                    <button type="submit" id="searchBtn" class="search-btn">Search Vehicle <i
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

    <script>
        $(document).ready(function() {
            // Event handler for Get Current Location button
            $('#getCurrentLocationBtn').on('click', function() {
                getCurrentLocation();
            });

            function getCurrentLocation() {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        var latitude = position.coords.latitude;
                        var longitude = position.coords.longitude;
                        var location = latitude + ',' + longitude;
                        $('#pickupLocation').val(location);
                    },
                    function(error) {
                        console.error('Error getting current location:', error.message);
                    }
                );
            }
        });
    </script>
@endsection
