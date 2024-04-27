@extends('layouts.header')
@section('content')
    <section class="car-fleet">
        <div class="container">
            <div class="row">
                <!--Fleet Column Start-->
                <div class="col-md-12 col-sm-12">


                    <!--Tab Content Start-->
                    <div class="tab-content">
                        <!--Fleet Grid Tab Content Start-->
                        <div class="tab-pane active" id="car-grid">
                            <!--Fleet Grid Box Wrapper Start-->
                            <div class="fleet-grid">
                                <div class="row">
                                    <!--Fleet Grid Box Start-->
                                    @if (isset($nearbyDrivers) && count($nearbyDrivers) > 0)
                                        @foreach ($nearbyDrivers as $nearbyDriver)
                                            <div class="col-md-6 col-sm-6">

                                                <div class="fleet-grid-box">
                                                    <!--Fleet Grid Thumb Start-->
                                                    <figure class="fleet-thumb">
                                                        <img src="{{ asset($nearbyDriver['vehicle_image_path']) }}"
                                                            alt="Driver Image">
                                                        <figcaption class="fleet-caption">
                                                            <div class="price-box">
                                                                {{-- <strong>
                                                                        @if ($nearbyDriver['driver']->vehicle_type === 'Car')
                                                                            Rs 80
                                                                        @else
                                                                            Rs 120
                                                                        @endif
                                                                        <span>/ KM</span>
                                                                    </strong> --}}
                                                            </div>
                                                            <span
                                                                class="rated">{{ $nearbyDriver['driver']->vehicle_plate_number }}</span>
                                                        </figcaption>
                                                    </figure>
                                                    <!--Fleet Grid Thumb End-->
                                                    <!--Fleet Grid Text Start-->

                                                    <div class="fleet-info-box">
                                                        <div class="fleet-info">
                                                            <h3>{{ $nearbyDriver['driver']->vehicle_model }} |
                                                                {{ $nearbyDriver['driver']->vehicle_plate_number }}

                                                            </h3>
                                                            <span class="fas fa-star"></span>
                                                            <span class="fas fa-star"></span>
                                                            <span class="fas fa-star"></span>
                                                            <span class="fas fa-star"></span>
                                                            <span class="fas fa-star"></span>
                                                            <br>
                                                            <h4>{{ number_format($nearbyDriver['distance'], 1) }} kilometers
                                                                away
                                                            </h4>

                                                            <h3> {{ $nearbyDriver['driver']->user->name }} |
                                                                {{ $nearbyDriver['driver']->user->mobile_number }}
                                                            </h3>


                                                            <ul class="fleet-meta">
                                                                <li><i
                                                                        class="fas fa-taxi"></i>{{ $nearbyDriver['driver']->vehicle_type }}
                                                                </li>

                                                                <li><i
                                                                        class="fas fa-user-circle"></i>{{ $nearbyDriver['driver']->seats }}
                                                                    Passengers</li>
                                                                <li><i
                                                                        class="fas fa-tachometer-alt"></i>{{ $nearbyDriver['driver']->vehicle_color }}
                                                                    Color
                                                                </li>

                                                            </ul>
                                                        </div>
                                                        <a href="javascript:void(0);"
                                                            onclick="confirmBooking({'successRoute': '{{ route('booking.success', ['driver_id' => $nearbyDriver['driver']->id]) }}','driverData': '{{ json_encode($nearbyDriver['driver']) }}', // Wrap in quotes
'distance': '{{ $nearbyDriver['distance_pick_to_drop'] }}'
   })"
                                                            class="tj-btn">
                                                            Book Now <i class="fa fa-arrow-circle-right"
                                                                aria-hidden="true"></i>
                                                        </a>




                                                    </div>

                                                    <!--Fleet Grid Text End-->
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p>No nearby drivers found.</p>
                                    @endif
                                    <!--Fleet Grid Box End-->

                                    <!--Fleet Grid Box Start-->


                                </div>
                            </div>
                        </div>

                    </div>

                    <!--Pagination Section End-->
                </div>
                <!--Fleet Column End-->
            </div>
        </div>


    </section>

    <script>
        function confirmBooking(data) {
            Swal.fire({
                title: 'Confirm Booking',
                text: 'Are you sure you want to book?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, book it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Construct the URL with additional data
                    let separator = data.successRoute.includes('?') ? '&' : '?';
                    let url = `${data.successRoute}${separator}distance=${data.distance}`;

                    // Redirect to the success route with the data if confirmed
                    window.location.href = url;
                } else {
                    // Handle cancellation
                    Swal.fire('Booking canceled!', 'Your booking is not confirmed.', 'error');
                }
            });
        }
    </script>


@endsection
