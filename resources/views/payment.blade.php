@extends('layouts.header')
@section('content')

    <head>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/starability-all.css') }}" />
    </head>
    <section class="tj-payment">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-8">
                    <div class="tj-tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active"><a href="#payment" data-toggle="tab">Payment Method</a></li>
                            <li class="hidden"><a href="#confirm_booking" data-toggle="tab">Rating</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="payment">
                            <form class="payment-frm" method="POST">
                                @csrf
                                <div class="col-md-12 col-sm-12">
                                    <div class="payment-field">
                                        <label for="bank_wire">
                                            <input type="radio" name="payment_type" id="bank_wire">Direct Bank Transfer
                                        </label>

                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="payment-field">
                                        <label for="credit_card">
                                            <input type="radio" name="payment_type" id="credit_card"> Credit Card
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="payment-field">
                                        <label for="cash">
                                            <input type="radio" name="payment_type" id="cash" value="cash">Cash
                                            Payment
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="payment-field">
                                        <label for="paypal">
                                            <input type="radio" name="payment_type" id="paypal">PayPal
                                        </label>
                                        <img src="{{ asset('images/payment.jpg') }}" alt="PayPal Image" />
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">

                                    <button type="submit" class="book-btn">Complete <i class="fa fa-arrow-circle-right"
                                            aria-hidden="true"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="confirm_booking">
                            <form class="account-frm" method="POST">
                                @csrf
                                <fieldset class="starability-basic" onchange="logRating()">
                                    <legend>Rate your Experience:</legend>
                                    <input type="radio" id="no-rate" class="input-no-rate" name="rating" value="0"
                                        checked aria-label="No rating." />
                                    <input type="radio" id="first-rate1" name="rating" value="1" />
                                    <label for="first-rate1" title="Terrible">1 star</label>
                                    <input type="radio" id="first-rate2" name="rating" value="2" />
                                    <label for="first-rate2" title="Not good">2 stars</label>
                                    <input type="radio" id="first-rate3" name="rating" value="3" />
                                    <label for="first-rate3" title="Average">3 stars</label>
                                    <input type="radio" id="first-rate4" name="rating" value="4" />
                                    <label for="first-rate4" title="Very good">4 stars</label>
                                    <input type="radio" id="first-rate5" name="rating" value="5" />
                                    <label for="first-rate5" title="Amazing">5 stars</label>
                                </fieldset>
                                <div class="col-md-12 col-sm-12">
                                    <div class="account-field">
                                        <label></label>
                                        <textarea placeholder="Comments"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6">
                                    <button type="submit" class="cancel-btn">Submit <i class="fa fa-arrow-circle-right"
                                            aria-hidden="true"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>

                <div class="col-md-4 col-sm-4">
                    <div class="booking-summary">
                        <h3>Booking Summary</h3>
                        <ul class="booking-info">
                            <li><span>Booking Reference: </span> {{ $trip->id }}</li>
                            <li><span>Driver Contact: {{ $trip->driver->user->mobile_number }}</li>
                            <li><span>Distance: </span>{{ $trip->distance }} km </li>
                        </ul>
                        <div class="journey-info">
                            <h4>Journey</h4>
                            <i class="far fa-edit"></i>
                        </div>
                        <ul class="service-info">
                            <li><span>Vehicle Number: {{ $trip->driver->vehicle_plate_number }}</li>
                            <li><span>Vehicle Color: {{ $trip->vehicle_color }}</li>
                            <li><span>Vehicle Type: {{ $trip->driver->vehicle_type }}</li>
                            <li><span>Driver Name: {{ $trip->driver->user->name }}</li>
                            <li><span>Booking Date: </span>{{ $trip->created_at }}</li>
                            <li><span> </span>Basic Amount: RS.{{ $trip->total_fare }}</li>
                        </ul>
                        <div class="fare-box">
                            <strong>Total Fare: <span>RS.{{ $trip->total_fare }}</span></strong>
                            <span>( inclusive of All Taxes )</span>
                        </div>

                    </div>
                </div>

            </div>
        </div>


    </section>

    <script>
        function showReviewTab() {
            // Show the second tab when the "Complete" button is clicked
            $('a[href="#payment"]').closest('li').removeClass('active');

            // Hide the "Payment Method" tab
            $('a[href="#payment"]').closest('li').addClass('hidden');
            $('#payment').removeClass('active in');

            showConfirmBooking();
        }

        function showConfirmBooking() {
            $('a[href="#confirm_booking"]').closest('li').removeClass('hidden');

            // Activate the "confirm_booking" tab
            $('a[href="#confirm_booking"]').closest('li').addClass('active');
            $('#confirm_booking').addClass('active in');

            // Activate the "confirm_booking" tab
            $('a[href="#confirm_booking"]').tab('show');

            $('a[href="#confirm_booking"]').closest('li').addClass('active');
            $('#confirm_booking').addClass('active in');
        }

        function logRating() {
            // Get the selected radio button value
            var selectedValue = document.querySelector('input[name="rating"]:checked').value;

            // Log the value to the console
            console.log("Selected Rating: " + selectedValue);
        }
    </script>

    <script>
        $(document).ready(function() {
            // Disable other payment options
            $('input[name="payment_type"]').not('#cash').prop('disabled', true);

            // Enable and focus on the "Cash Payment" option
            $('#cash').prop('disabled', false).prop('checked', true);

            // Optional: You can add a class to style the disabled options differently
            $('input[name="payment_type"]').not('#cash').closest('.payment-field').addClass(
                'disabled-payment-option');

            // Handle form submission
            $('.payment-frm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('payment.complete') }}',
                    method: 'POST',
                    data: {
                        trip_id: '{{ $trip->id }}',
                        payment_type: $('input[name="payment_type"]:checked').val(),
                        total_fare: '{{ $trip->total_fare }}',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        showReviewTab();
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });

            });

            $('.account-frm').submit(function(e) {
                e.preventDefault();
                // Get the rating value
                var selectedValue = document.querySelector('input[name="rating"]:checked').value;

                $.ajax({
                    url: '{{ route('review') }}',
                    method: 'POST',
                    data: {
                        trip_id: '{{ $trip->id }}',
                        rating: selectedValue,
                        comments: $('textarea').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire({
                            title: "Success",
                            text: "Review submitted successfully!",
                            icon: "success",
                            button: "OK",
                        }).then(function() {
                            window.location.href = '{{ route('home') }}';
                        });;
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
@endsection
