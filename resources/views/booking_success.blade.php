@extends('layouts.header')
@section('content')
    <section class="tj-payment" id="success-payment">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-8">
                    <div class="success-msg">
                        <span class="fas fa-check"></span>
                        <h3>{{ $trip->passenger->name }} Your Booking Successful!
                        </h3>
                        <p>Your booking for the vehicle with number {{ $trip->driver->vehicle_plate_number }} has been
                            processed
                            successfully! We'll send you a confirmation email and SMS shortly.</p>

                        <a href="https://themesjungle.net/html/prime-cab/home-1.html"><i class="fa fa-arrow-circle-left"
                                aria-hidden="true"></i> Back to Home</a>
                        <div class="col-md-12 col-sm-12">


                            <button type="submit" class="btn btn-success book-btn"
                                onclick="confirmEndTrip('{{ $trip->id }}')">
                                End Trip and Do Payment
                            </button>
                            <button type="submit" class="btn btn-secondary book-btn"
                                onclick="confirmCancelBooking('{{ $trip->id }}')">
                                Cancel Booking
                            </button>

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
    <!--Booking Form Section End-->

    <!--Call To Action Content Start-->
    <section class="tj-cal-to-action">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="cta-box">
                        <img src="images/cta-icon1.png" alt="" />
                        <div class="cta-text">
                            <strong>Best Price Guaranteed</strong>
                            <p>A more recently with desktop softy like aldus page maker.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="cta-box">
                        <img src="images/cta-icon2.png" alt="" />
                        <div class="cta-text">
                            <strong>24/7 Customer Care</strong>
                            <p>A more recently with desktop softy like aldus page maker.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="cta-box">
                        <img src="images/cta-icon3.png" alt="" />
                        <div class="cta-text">
                            <strong>Easy Bookings</strong>
                            <p>A more recently with desktop softy like aldus page maker.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function confirmEndTrip(tripId) {
            Swal.fire({
                title: 'End Trip and Do Payment',
                text: 'Are you sure you want to end the trip and proceed with the payment?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, end trip!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ url('booking/payment') }}/' + tripId;



                } else {
                    Swal.fire('End trip canceled!', 'Your trip is not ended.', 'error');
                }
            });
        }

        function confirmCancelBooking(tripId) {
            Swal.fire({
                title: 'Cancel Booking',
                text: 'Are you sure you want to cancel the booking?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, cancel!',
                cancelButtonText: 'No, keep booking!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ url('booking/cancel') }}/' +
                            tripId,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire('Booking Canceled!', 'Your booking has been canceled.', 'success')
                                .then(() => {
                                    window.history.back();
                                });
                        },
                        error: function(error) {
                            Swal.fire('Error', 'Unable to cancel booking. Please try again.', 'error');
                        }
                    });
                } else {
                    Swal.fire('Booking cancellation canceled!', 'Your booking is not canceled.', 'error');
                }
            });
        }
    </script>
@endsection
