@extends('layouts.admin_header')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="main-panel">
        <div class="content-wrapper">

            <!-- Default checked -->

            <div class="row">



                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Drivers</h4>

                            <table id="ridesTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Driver Name</th>
                                        <th>Contact</th>
                                        <th>Location</th>
                                        <th>Vehicle Model</th>
                                        <th>Vehicle Type</th>
                                        <th>Vehicle Number</th>
                                        <th>Vehicle Color</th>
                                        <th>Status</th>
                                        <th>Register Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($drivers as $driver)
                                        <tr>
                                            <td>{{ $driver->user->name }}</td>
                                            <td>{{ $driver->user->mobile_number }}</td>
                                            <td>{{ $driver->location }}</td>
                                            <td>{{ $driver->vehicle_model }}</td>
                                            <td>{{ $driver->vehicle_type }}</td>
                                            <td>{{ $driver->vehicle_plate_number }}</td>
                                            <td>{{ $driver->vehicle_color }}</td>
                                            <td>
                                                @if ($driver->profile_status == 1)
                                                    <label class="badge badge-success">Active</label>
                                                @elseif($driver->profile_status == 3)
                                                    <label class="badge badge-warning">Pending</label>
                                                @elseif($driver->profile_status == 2)
                                                    <label class="badge badge-danger">Cancelled</label>
                                                @else
                                                    <!-- Handle other status values if needed -->
                                                @endif
                                            </td>
                                            <td>{{ $driver->created_at }}</td>
                                            <td>
                                                <a href="#" class="viewDriverBtn"
                                                    data-driver-id="{{ $driver->id }}"><i class="mdi mdi-eye"
                                                        style="color: blue;"></i></a>
                                                <a href="#" class="editDriverBtn"
                                                    data-driver-id="{{ $driver->id }}">
                                                    <i class="mdi mdi-pencil" style="color: orange;"></i>

                                                </a> <a href=""><i class="mdi mdi-delete"
                                                        style="color: red;"></i></a>
                                            </td>
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


        <div class="modal" id="editDriverModal" tabindex="-1" role="dialog" aria-labelledby="editDriverModalLabel"
            aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDriverModalLabel">Edit Driver</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editDriverForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="editDriverId">ID:</label>
                                        <input type="text" class="form-control" id="editDriverId" name="editDriverId"
                                            value="{{ $driver->id }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="editDriverName">Name:</label>
                                        <input type="text" class="form-control" id="editDriverName" name="editDriverName"
                                            value="{{ $driver->user->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="editDriverMobileNumber">Mobile Number:</label>
                                        <input type="text" class="form-control" id="editDriverMobileNumber"
                                            name="editDriverMobileNumber" value="{{ $driver->user->mobile_number }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="editDriverLocation">Location:</label>
                                        <input type="text" class="form-control" id="editDriverLocation"
                                            name="editDriverLocation" value="{{ $driver->location }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="editDriverVehicleModel">Vehicle Model:</label>
                                        <input type="text" class="form-control" id="editDriverVehicleModel"
                                            name="editDriverVehicleModel" value="{{ $driver->vehicle_model }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="editDriverVehicleType">Vehicle Type:</label>
                                        <input type="text" class="form-control" id="editDriverVehicleType"
                                            name="editDriverVehicleType" value="{{ $driver->vehicle_type }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="editDriverVehiclePlateNumber">Vehicle Plate Number:</label>
                                        <input type="text" class="form-control" id="editDriverVehiclePlateNumber"
                                            name="editDriverVehiclePlateNumber"
                                            value="{{ $driver->vehicle_plate_number }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="editDriverVehicleColor">Vehicle Color:</label>
                                        <input type="text" class="form-control" id="editDriverVehicleColor"
                                            name="editDriverVehicleColor" value="{{ $driver->vehicle_color }}">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveChangesBtn">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal" id="approvePhotosModal" tabindex="-1" role="dialog"
            aria-labelledby="approvePhotosModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="approvePhotosModalLabel">Driver Documents</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" id="editDriverId" name="editDriverId"
                            value="{{ $driver->id }}" readonly hidden>
                        <div class="row" id="documentImages">
                            <!-- Document images will be dynamically added here -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="approveButton">Approve</button>
                        <button type="button" class="btn btn-danger" id="declineButton">Decline</button>
                    </div>
                </div>
            </div>
        </div>





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
            // Function to fetch driver data and populate modal
            function editDriver(driverId) {
                $.ajax({
                    url: '/drivers/' + driverId, // URL to fetch driver data
                    type: 'GET',
                    success: function(response) {
                        // Check if the response is not empty and contains the expected data
                        if (response && response.id) {
                            // Populate modal fields with fetched data

                            // Show the modal
                            $('#editDriverModal').modal('show');
                        } else {
                            // Handle empty or invalid response
                            console.error('Invalid response or missing data');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching driver data:', error);
                    }
                });
            }

            // Event listener for edit icon click
            $(document).ready(function() {
                // Event listener for edit icon click
                $('.editDriverBtn').click(function(event) {
                    event.preventDefault(); // Prevent default anchor behavior
                    var driverId = $(this).data('driver-id');
                    editDriver(driverId);
                });
            });

            // Function to handle form submission
            $('#saveChangesBtn').click(function() {
                var formData = $('#editDriverForm').serialize(); // Serialize form data
                var driverId = $('#editDriverId').val();
                // Perform AJAX request to update driver data
                $.ajax({
                    url: '/update-driver/' + driverId, // URL to update driver data
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Handle success response
                        console.log('Driver data updated successfully:', response);
                        // Optionally, close the modal or perform other actions
                        $('#editDriverModal').modal('hide');
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error('Error updating driver data:', error);
                    }
                });
            });

            $(document).ready(function() {
                // Event listener for view driver button click
                $('.viewDriverBtn').click(function(event) {
                    event.preventDefault(); // Prevent default anchor behavior
                    var driverId = $(this).data('driver-id');

                    // Make AJAX request to fetch driver documents
                    $.ajax({
                        url: '/get-driver-documents/' + driverId,
                        type: 'GET',
                        success: function(response) {
                            // Check if response is valid
                            if (response && response.documents) {
                                // Clear previous content in the modal body
                                $('#approvePhotosModal .modal-body .row').empty();

                                // Define base URL for assets
                                var baseUrl = "{{ asset('') }}";

                                // Iterate over each document
                                for (var key in response.documents) {
                                    if (response.documents.hasOwnProperty(key)) {
                                        // Get the path of the document
                                        var documentPath = response.documents[key];
                                        var label = key.replace('_path', '');

                                        // Generate HTML for the document
                                        var html = '<div class="col-md-4">' +
                                            '<a href="' + baseUrl + documentPath +
                                            '" target="_blank">' +
                                            '<img src="' + baseUrl + documentPath +
                                            '" class="img-fluid" alt="' + key + '">' +
                                            '</a>' +
                                            '<button type="button" class="btn btn-link mt-2">' +
                                            '<a href="' + baseUrl + documentPath +
                                            '" target="_blank" class="text-decoration-none text-dark">' +
                                            'View Full Size (' + label + ')' +
                                            '</a>' +
                                            '</button>' +
                                            '</div>';

                                        // Append the HTML to the modal body
                                        $('#approvePhotosModal .modal-body .row').append(html);
                                    }
                                }

                                // Show the modal
                                $('#approvePhotosModal').modal('show');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching driver documents:', error);
                        }
                    });
                });
            });



            $('#approveButton').click(function() {
                var driverId = $('#editDriverId').val();

                // Display a SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You are about to approve the driver profile',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, approve it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If user confirms, make AJAX request to update driver profile status to 1 (approved)
                        $.ajax({
                            url: '/update-driver-profile-status/' + driverId,
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                status: 1
                            },
                            success: function(response) {
                                console.log('Driver profile approved:', response);
                                // Optionally, display a success message
                                Swal.fire('Approved!', 'Driver profile has been approved.',
                                    'success').then((result) => {
                                    // Check if the user clicked "OK"
                                    if (result.isConfirmed) {
                                        // Reload the page immediately
                                        location.reload();
                                    }
                                });
                                // Reload the page after 4 seconds
                                setTimeout(function() {
                                    location.reload();
                                }, 4000)
                            },
                            error: function(xhr, status, error) {
                                console.error('Error approving driver profile:', error);
                                // Display an error message
                                Swal.fire('Error!', 'Failed to approve driver profile.', 'error');
                            }
                        });
                    }
                });
            });

            $('#declineButton').click(function() {
                var driverId = $('#editDriverId').val();

                // Display a SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You are about to decline the driver profile',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, decline it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If user confirms, make AJAX request to update driver profile status to 2 (declined)
                        $.ajax({
                            url: '/update-driver-profile-status/' + driverId,
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                status: 2
                            },
                            success: function(response) {
                                console.log('Driver profile declined:', response);
                                // Optionally, display a success message
                                Swal.fire('Declined!', 'Driver profile has been declined.',
                                    'success').then((result) => {
                                    // Check if the user clicked "OK"
                                    if (result.isConfirmed) {
                                        // Reload the page immediately
                                        location.reload();
                                    }
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 4000)
                            },
                            error: function(xhr, status, error) {
                                console.error('Error declining driver profile:', error);
                                // Display an error message
                                Swal.fire('Error!', 'Failed to decline driver profile.', 'error');
                            }
                        });
                    }
                });
            });
        </script>
    @endsection
