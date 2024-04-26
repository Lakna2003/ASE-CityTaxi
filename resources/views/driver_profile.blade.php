@extends('layouts.admin_header')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Driver Profile </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
                            <label class="custom-control-label" for="customSwitch1"><span
                                    style="font-weight: bold;">Available</span></label>
                        </div>
                    </ol>
                </nav>
            </div>
            <!-- Default checked -->

            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Update Location</h4>
                            <div class="form-group" style="display: flex; align-items: center;">
                                <label for="location" style="margin-right: 10px;">Location (Latitude, Longitude):</label>
                                <input type="text" class="form-control" id="location" readonly style="flex: 1;">
                                <button type="button" class="btn btn-primary" id="updateLocation"
                                    style="margin-left: 10px;">Update Location</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Your Rides</h4>

                            <table id="ridesTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Passenger Name</th>
                                        <th>Passenger Contact</th>
                                        <th>Distance</th>
                                        <th>Total Fare</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rides as $ride)
                                        <tr>
                                            <td>{{ $ride->passenger_name }}</td>
                                            <td>{{ $ride->passenger_contact }}</td>
                                            <td>{{ $ride->distance }} KM</td>
                                            <td>Rs. {{ $ride->total_fare }}</td>
                                            <td>{{ $ride->created_at }}</td>
                                            <td>
                                                @if ($ride->status == 1)
                                                    <label class="badge badge-success">Completed</label>
                                                @elseif($ride->status == 0)
                                                    <label class="badge badge-warning">Pending</label>
                                                @elseif($ride->status == 2)
                                                    <label class="badge badge-danger">Cancelled</label>
                                                @else
                                                    <!-- Handle other status values if needed -->
                                                @endif
                                            </td>
                                            <td>{{ $ride->rating }}</td>
                                        </tr>
                                    @endforeach
                                    {{-- <tr>
                                        <td>Jacob</td>
                                        <td>Photoshop</td>
                                        <td>Photoshop</td>
                                        <td class="text-danger"> 28.76% <i class="mdi mdi-arrow-down"></i></td>
                                        <td><label class="badge badge-danger">Pending</label></td>
                                    </tr> --}}

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



            </div>
        </div>




        <script>
            $(document).ready(function() {
                $.ajax({
                    url: '{{ route('check-driving-status') }}',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'busy') {

                            $('#customSwitch1').prop('disabled', true);
                            $('#customSwitch1').next('label').text('Busy');

                            $.ajax({
                                url: '{{ route('get-passenger-info') }}',
                                method: 'GET',
                                dataType: 'json',
                                success: function(passengerInfo) {
                                    Swal.fire({
                                        title: "You Are Busy with Ride",
                                        text: "Passenger: " + passengerInfo.name +
                                            " | Contact: " + passengerInfo.contact +
                                            " | TripId: " + passengerInfo.id,
                                        icon: "info",
                                        allowOutsideClick: false,
                                        showCancelButton: false,
                                        confirmButtonColor: '#28a745',
                                        confirmButtonText: 'Complete the Trip'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            completeTrip(passengerInfo.id);
                                        }
                                    });


                                },
                                error: function(error) {
                                    console.error('Error fetching passenger info:', error);
                                }
                            });
                        } else {

                            $('#customSwitch1').next('label').text('Available');

                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });


            });

            function completeTrip(tripId) {
                $.ajax({
                    url: '{{ route('complete_trip_driver') }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        tripId: tripId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            window.location.href = '';
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message,
                            });
                        }
                    },
                    error: function(error) {
                        console.error('Error completing the trip:', error);
                    }
                });
            }
        </script>

        <script>
            loadtable();

            function loadtable() {

                var table = $('#ridesTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "responsive": true,
                    "order": [
                        [4, 'desc']
                    ]

                });

            };
        </script>

        <script>
            $(document).ready(function() {


                function updateDriverStatusOnToggle(newStatus) {
                    $.ajax({
                        url: '{{ route('update-driver-status') }}',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            status: newStatus
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                $('#customSwitch1').next('label').text(newStatus === 1 ? 'Busy' :
                                    'Available');
                            } else {
                                console.error('Error updating driver status:', response.message);
                            }
                        },
                        error: function(error) {
                            console.error('Error updating driver status:', error);
                        }
                    });
                }

                function checkAndUpdateDriverStatus() {
                    $.ajax({
                        url: '{{ route('check-driver-status') }}',
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'busy') {
                                $('#customSwitch1').prop('checked', false);
                                //$('#customSwitch1').prop('disabled', true);
                                $('#customSwitch1').next('label').text('Busy');
                            } else {
                                $('#customSwitch1').prop('checked', true);
                                $('#customSwitch1').next('label').text('Available');
                            }
                        },
                        error: function(error) {
                            console.error('Error:', error);
                        }
                    });
                }

                setTimeout(function() {
                    checkAndUpdateDriverStatus();
                }, 500);

                $('#customSwitch1').on('change', function() {
                    var newStatus = $(this).prop('checked') ? 0 : 1;
                    updateDriverStatusOnToggle(newStatus);
                });
            });
        </script>

        <script>
            function getCurrentLocation() {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        var latitude = position.coords.latitude;
                        var longitude = position.coords.longitude;
                        var location = latitude + ',' + longitude;
                        $('#location').val(location);
                        updateDriverLocation(location);
                    },
                    function(error) {
                        console.error('Error getting current location:', error.message);
                    }
                );
            }

            function updateDriverLocation(location) {
                $.ajax({
                    url: '{{ route('update_driver_location') }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        location: location
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            console.log('Location updated successfully.');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Location updated successfully.',
                            });
                        } else {
                            console.error('Error updating location:', response.message);
                        }
                    },
                    error: function(error) {
                        console.error('Error updating location:', error);
                    }
                });
            }

            // Event handler for update location button
            $('#updateLocation').on('click', function() {
                // Fetch and update current location
                getCurrentLocation();
            });
        </script>
    @endsection
