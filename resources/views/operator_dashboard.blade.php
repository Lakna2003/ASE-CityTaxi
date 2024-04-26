@extends('layouts.admin_header')
@section('content')

    <head>
        <style>
            .hidden {
                display: none;
            }
        </style>
    </head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Operator Dashboard </h3>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Guest Passenger </h4>
                            <form class="form-sample" id="guestPassengerForm" action="{{ route('find.nearby.drivers') }}"
                                method="POST">
                                @csrf
                                <p class="card-description"> Personal info </p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Full Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="full_name" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Contact</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="contact" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row pickup-dropoff hidden">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Pickup Location</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="pick_loc" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Dropoff Location</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="drop_loc" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="button" class="btn btn-primary" id="saveAndFindDrivers">
                                            Save Guest Passenger
                                        </button>
                                    </div>
                                </div>
                                <div class="row find-drivers hidden">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary" id="saveAndFindDrivers">
                                            Find Nearby Drivers
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @php
            $findNearbyDriversRoute = route('find.nearby.drivers');
        @endphp


        <script>
            $(document).ready(function() {
                // Attach click event to the button
                $('#saveAndFindDrivers').on('click', function() {
                    // Make an asynchronous request to save data
                    $.ajax({
                        url: "{{ route('save.guest.passenger') }}", // Replace with your actual route
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: $('#guestPassengerForm').serialize(),
                        success: function(response) {
                            if (response.success) {
                                // Show Pickup and Dropoff Location inputs
                                $('.pickup-dropoff').removeClass('hidden');
                                // Hide Name and Contact inputs
                                $('.name-contact').addClass('hidden');
                                // Hide Save Guest Passenger button
                                $('#saveAndFindDrivers').addClass('hidden');
                                // Show Find Nearby Drivers button
                                $('.find-drivers').removeClass('hidden');
                                $('input[name="full_name"], input[name="contact"]').prop('disabled',
                                    true);

                            } else {
                                // Handle error if needed
                                console.error('Error: ', response.message);
                            }
                        },
                        error: function(error) {
                            console.error('Error in AJAX request:', error);
                        }
                    });
                });
            });
        </script>
    @endsection
