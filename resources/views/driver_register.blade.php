@extends('layouts.header')
@section('content')
    <section class="tj-booking-frm">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div class="tj-tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active"><a href="#point" data-toggle="tab">Register as a Driver</a></li>
                            <li style="display:none;"><a href="#document" id="document-tab-link" data-toggle="tab">Documents
                                    Upload</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="point">
                            <form class="booking-frm" method="POST" id="ride-bform">
                                @csrf
                                <div class="col-md-12 col-sm-12">
                                    <div class="field-holder">
                                        <label for="one_way">
                                            <input type="radio" name="vehicle_type" id="car" checked
                                                value="Car">Car
                                        </label>
                                        <label for="two_way">
                                            <input type="radio" name="vehicle_type" id="van" value="Van">Van
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="field-holder">
                                        <span class="fas fa-map-marker-alt"></span>
                                        <input type="text" name="location" id="location" placeholder="Your Location"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="field-holder">
                                        <span class="fas fa-car"></span>
                                        <input type="text" name="vehicle_model" placeholder="Vehicle Model" required>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6">
                                    <div class="field-holder">
                                        <span class="fas fa-list-ol"></span>
                                        <input type="text" name="vehicle_number" placeholder="Vehicle Plate Number"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6">
                                    <div class="field-holder">
                                        <span class="fas fa-palette"></span>
                                        <input type="text" name="vehicle_color" placeholder="Vehicle Color" required>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6">
                                    <div class="field-holder">
                                        <span class="fas fa-palette"></span>
                                        <input type="text" name="seats" placeholder="Seats Available" required>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <p class="ride-terms">I understand and agree with the <a href="">Terms</a> of
                                        Service and Cancellation </p>
                                    <label for="book_terms">
                                        <input name="book_terms" id="book_terms" type="checkbox" checked>
                                    </label>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <button type="submit" class="book-btn">Next Step <i class="fa fa-arrow-circle-right"
                                            aria-hidden="true"></i></button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="document" style="display:none;">
                            <form class="booking-frm" method="POST" id="documents-form">
                                @csrf
                                <div class="col-md-12 col-sm-12">
                                    <div class="field-holder">
                                        <div class="col-md-12 col-sm-12">
                                            <label for="formFile" class="form-label"><span style="color: black;">Revenue
                                                    Licence <span style="color: red;">(Required)</label>
                                            <input class="form-control mt-2 mb-2" type="file" id="revenue_licence"
                                                name="revenue_licence" accept="image/*" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="field-holder">
                                        <div class="col-md-12 col-sm-12">
                                            <label for="formFile" class="form-label"><span style="color: black;">Driver
                                                    Image <span style="color: red;">(Required)</label>
                                            <input class="form-control mt-2" type="file" id="driver_image"
                                                name="driver_image" accept="image/*" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="field-holder">
                                        <div class="col-md-12 col-sm-12">
                                            <label for="formFile" class="form-label"><span
                                                    style="color: black;">Insurance
                                                    Certificate <span style="color: red;">(Required)</label>
                                            <input class="form-control mt-2" type="file" id="insurance"
                                                name="insurance" accept="image/*" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="field-holder">
                                        <div class="col-md-12 col-sm-12">
                                            <label for="formFile" class="form-label"><span style="color: black;">Vehicle
                                                    Image <span style="color: red;">(Required)</label>
                                            <input class="form-control mt-2" type="file" id="vehicle_image"
                                                name="vehicle_image" accept="image/*" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="field-holder">
                                        <div class="col-md-12 col-sm-12">
                                            <label for="formFile" class="form-label" style="color: black;">National
                                                Identity Card (Optional)</label>
                                            <input class="form-control mt-2 mb-2" type="file" name="nic"
                                                id="nic" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="field-holder">
                                        <div class="col-md-12 col-sm-12">
                                            <label for="formFile" class="form-label" style="color: black;">Billing Proof
                                                (Optional)</label>
                                            <input class="form-control mt-2 mb-2" type="file" name="billing_proof"
                                                id="billing_proof" accept="image/*">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 text-right">
                                    <button type="submit" class="book-btn">Submit <i class="fa fa-check"
                                            aria-hidden="true"></i></button>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="booking-summary">
                        <h3>Required Documents</h3>

                        <ul class="booking-info">
                            <div class="journey-info">
                                <h4>Mandatory Documents</h4>
                            </div>
                            <li><span>Revenue Licence </span>

                            </li>
                            <li><span>Drivers Photo </span>

                            </li>
                            <li><span>Insurance Certificate</span>

                            </li>
                            <li><span>Vehicle Photo</span>

                            </li>
                            <li><span></span>

                            </li>
                            <div class="journey-info mt-2">
                                <h4>Non-mandatory Documents</h4>
                            </div>
                            <li><span>National Identity Card </span>

                            </li>
                            <li><span>Billing Proof </span>

                            </li>
                        </ul>

                        <ul class="service-info">


                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <script>
        $(document).ready(function() {
            @if ($userIsDriver)
                $("#ride-bform").hide();
                $("#document").show();
                $("ul.nav-tabs li.active a").text("Documents Upload");
            @endif

            $("#ride-bform").submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "{{ route('driver.save') }}",
                    data: formData,
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            // Swal.fire({
                            //     icon: 'success',
                            //     title: 'Driver Register Success',
                            // });
                            $("#ride-bform").hide();
                            $("#document").show();
                            $("ul.nav-tabs li.active a").text("Documents Upload");
                        } else {
                            console.error('Form submission failed:', data.message);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Form submission failed!',
                            });
                        }

                    },
                    error: function(error) {
                        console.error("Error submitting form:", error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Form submission failed!',
                        });
                    }
                });
            });

            //! save documents

            $("#documents-form").submit(function(e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                console.log(formData);
                $.ajax({
                    type: "POST",
                    url: "{{ route('driver.saveDocuments') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Documents Saved',
                                text: 'Registration Successfully.'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "{{ route('home') }}";
                                } else {
                                    setTimeout(() => {
                                        window.location.href =
                                            "{{ route('home') }}";
                                    }, 4000);
                                }
                            });
                        } else if (response.error_code === 'validation_error') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message,
                            });

                        } else if (response.error_code === 'duplicate') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message,
                            });

                        } else {
                            console.error('Documents submission failed:', response.message);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Documents submission failed!',
                            });
                        }
                    },
                    error: function(error) {
                        console.error("Error submitting form:", error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Documents submission failed!',
                        });
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            getCurrentLocation();

            function getCurrentLocation() {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        var latitude = position.coords.latitude;
                        var longitude = position.coords.longitude;
                        var location = latitude + ',' + longitude;
                        $('#location').val(location);
                    },
                    function(error) {
                        console.error('Error getting current location:', error.message);
                    }
                );
            }
        });
    </script>
@endsection
