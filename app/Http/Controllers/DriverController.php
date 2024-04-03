<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Trip;
use App\Models\User;
use App\Models\UserRole;
use App\Models\VehicleDocument;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Vonage\Laravel\Facade\Vonage;

class DriverController extends Controller
{
    public function isRegisteredDriver()
    {
        $userId = auth()->user()->id;

        $isRegisteredDriver = Driver::where('user_id', $userId)->exists();

        if ($isRegisteredDriver) {
            $driverTableId = Driver::where('user_id', $userId)->value('id');
            $vehicleDocumentExists = VehicleDocument::where('driver_id', $driverTableId)->exists();

            if ($vehicleDocumentExists) {
                return response()->json(['success' => true, 'message' => 'Form submitted successfully']);
            }
        } else {
            return response()->json(['success' => false, 'message' => $userId]);
        }
    }
    public function index()
    {
        $userId = auth()->user()->id;

        $userIsDriver = Driver::where('user_id', $userId)->first();
        $isRegisteredDriver = "";
        if ($userIsDriver) {
            $isRegisteredDriver = VehicleDocument::where('driver_id', $userIsDriver->id)->exists();

            if ($isRegisteredDriver) {
                return redirect()->route('home');
            }
        }


        return view('driver_register', ['userIsDriver' => $userIsDriver], ['isRegisteredDriver' => $isRegisteredDriver]);
    }

    public function saveDriver(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'vehicle_type' => 'required',
            'location' => 'required',
            'vehicle_model' => 'required',
            'vehicle_number' => 'required',
            'vehicle_color' => 'required',
            'seats' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $user_id = auth()->id();

        Driver::create([
            'user_id' => $user_id,
            'vehicle_type' => $request->input('vehicle_type'),
            'location' => $request->input('location'),
            'vehicle_model' => $request->input('vehicle_model'),
            'vehicle_plate_number' => $request->input('vehicle_number'),
            'vehicle_color' => $request->input('vehicle_color'),
            'seats' => $request->input('seats'),
        ]);

        return response()->json(['success' => true, 'message' => 'Form submitted successfully']);
    }

    public function saveDriverDocuments(Request $request)
    {
        try {
            $userId = auth()->user()->id;

            $userDriver = Driver::where('user_id', $userId)->first();
            $driverId = $userDriver->id;


            $validator = Validator::make($request->all(), [
                'revenue_licence' => 'required|mimes:jpeg,png,jpg,gif',
                'driver_image' => 'required|mimes:jpeg,png,jpg,gif',
                'insurance' => 'required|mimes:jpeg,png,jpg,gif',
                'vehicle_image' => 'required|mimes:jpeg,png,jpg,gif',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'error_code' => 'validation_error', 'message' => $validator->errors()->first()]);
            }

            $existingDocument = VehicleDocument::where('driver_id', $userId)->first();
            if ($existingDocument) {
                return response()->json(['success' => false, 'error_code' => 'duplicate', 'message' => 'User is already registered as a driver']);
            }

            // Save documents to the server
            $documentPaths = [];
            foreach ($request->allFiles() as $key => $file) {
                $fileName = $this->generateFileName($key);
                $file->move(public_path("uploads/drivers/$driverId"), $fileName);
                $relativePath = "uploads/drivers/$driverId/$fileName";
                $documentPaths[$key] = $relativePath;
            }

            // Save document paths to the database
            $vehicleDocument = new VehicleDocument([
                'driver_id' => $driverId,
                'revenue_license_path' => $documentPaths['revenue_licence'] ?? null,
                'driver_image_path' => $documentPaths['driver_image'] ?? null,
                'insurance_path' => $documentPaths['insurance'] ?? null,
                'vehicle_image_path' => $documentPaths['vehicle_image'] ?? null,
                'nic_path' => $documentPaths['nic'] ?? null,
                'bill_proof_path' => $documentPaths['bill_proof'] ?? null,
            ]);

            $vehicleDocument->save();

            $existingUserRole = UserRole::where('user_id', $userId)->where('role_id', DRIVER)->first();

            if (!$existingUserRole) {
                $userRole = new UserRole([
                    'user_id' => $userId,
                    'role_id' => DRIVER,
                ]);

                $userRole->save();
            }



            return response()->json(['success' => true, 'message' => 'Documents saved successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to save documents']);
        }
    }

    private function generateFileName($key)
    {
        return uniqid() . '_' . $key . '.jpg';
    }

    public function checkDriverProfileStatus()
    {
        $userId = auth()->user()->id;

        $driver = Driver::where('user_id', $userId)->first();

        if ($driver) {
            $profileStatus = $driver->profile_status;

            switch ($profileStatus) {
                case 1:
                    return response()->json(['code' => 'active', 'message' => 'Driver profile is active']);
                case 0:
                    return response()->json(['code' => 'inactive', 'message' => 'Driver profile is inactive']);
                case 3:
                    return response()->json(['code' => 'pending', 'message' => 'Driver profile is pending approval, please wait few Hours']);
                case 2:
                    return response()->json(['code' => 'declined', 'message' => 'Driver profile is declined']);
                default:
                    return response()->json(['code' => 'unknown', 'message' => 'Unknown driver profile status']);
            }
        } else {
            return response()->json(['code' => 'not_found', 'message' => 'Driver record not found']);
        }
    }

    public function driverProfile()
    {
        $userId = auth()->user()->id;

        if ($userId) {
            $driver = Driver::where('user_id', $userId)->first();

            $driverId = $driver->id;
            $rides = Trip::where('driver_id', $driverId)->latest()->get();

            return view('driver_profile', ['rides' => $rides]);
        }

        // return view('driver_profile');
    }

    public function checkDrivingStatus()
    {
        $user = auth()->user();

        if ($user) {
            $driver = Driver::where('user_id', $user->id)->first();

            if ($driver && $driver->driver_status == 1) {
                $activeTrip = Trip::where('driver_id', $driver->id)
                    ->where('status', 0)
                    ->first();

                if ($activeTrip) {
                    return response()->json(['status' => 'busy']);
                }
            }
        }

        return response()->json(['status' => 'available']);
    }

    public function getPassengerInfo()
    { {
            $user = auth()->user();

            if ($user) {
                $driver = Driver::where('user_id', $user->id)->first();

                if ($driver && $driver->driver_status == 1) {
                    $trip = Trip::where('driver_id', $driver->id)
                        ->where(function ($query) {
                            $query->where('status', 0)
                                ->where('payment_status', 0);
                        })
                        ->orWhere(function ($query) {
                            $query->where('status', 1)
                                ->orWhere('payment_status', 0);
                        })
                        ->latest()
                        ->first();

                    if ($trip) {

                        return response()->json([
                            'name' => $trip->passenger_name,
                            'contact' => $trip->passenger_contact,
                            'id' => $trip->id,
                        ]);
                    }
                }
            }

            return response()->json(['error' => 'Passenger information not found']);
        }
    }

    public function completeTripByDriver(Request $request)
    {
        $tripId = $request->input('tripId');

        $trip = Trip::find($tripId);

        if (!$trip) {
            return response()->json(['success' => false, 'message' => 'Trip not found.'], 404);
        }

        $trip->update([
            'status' => 1,
            'payment_status' => 1,
        ]);

        $driverId = $trip->driver_id;
        if ($driverId) {
            // Assuming you have a Driver model
            $driver = Driver::where('id', $driverId)->first();
            if ($driver) {
                $driver->update(['driver_status' => 0]);
            }
        }

        return response()->json(['success' => true, 'message' => 'Trip completed successfully.']);
    }

    public function updateDriverStatus(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not authenticated.']);
        }

        $driver = Driver::where('user_id', $user->id)->first();

        if (!$driver) {
            return response()->json(['success' => false, 'message' => 'Driver not found.']);
        }

        $newStatus = $request->input('status');


        $driver->update(['driver_status' => $newStatus]);

        return response()->json(['success' => true, 'message' => 'Driver status updated successfully.']);
    }

    public function checkDriverStatus()
    {
        $user = auth()->user();

        if ($user) {
            $driver = Driver::where('user_id', $user->id)->first();

            if ($driver && $driver->driver_status == 1) {

                return response()->json(['status' => 'busy']);
            }
        }

        return response()->json(['status' => 'available']);
    }

    public function updateDriverLocation(Request $request)
    {
        $location = $request->input('location');

        $user_id = auth()->user()->id;
        Driver::where('user_id', $user_id)->update(['location' => $location]);

        return response()->json(['success' => true, 'message' => 'Location updated successfully']);
    }

    public function getDriverById($id)
    {
        $driver = Driver::with('user')->findOrFail($id);
        return response()->json($driver);
    }

    public function updateDriver(Request $request, $driverId)
    {
        try {
            // Find the driver by ID
            $driver = Driver::findOrFail($driverId);

            // Update driver data
            $driver->update([
                'vehicle_color' => $request->input('editDriverVehicleColor'),
                'vehicle_model' => $request->input('editDriverVehicleModel'),
                'location' => $request->input('editDriverLocation'),
                'vehicle_type' => $request->input('editDriverVehicleType'),
                'vehicle_plate_number' => $request->input('editDriverVehiclePlateNumber'),

            ]);

            $user = User::findOrFail($driver->user_id);
            $user->update([
                'name' => $request->input('editDriverName'),
                'mobile_number' => $request->input('editDriverMobileNumber'),

            ]);


            // Return success response
            return response()->json(['message' => $driver]);
        } catch (QueryException $e) {
            // Handle database query exceptions
            return response()->json(['error' => 'Database error: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json(['error' => 'Error updating driver: ' . $e->getMessage()], 500);
        }
    }

    public function getDriverDocuments($driverId)
    {
        // Retrieve image paths for the given driverId
        $documents = VehicleDocument::where('driver_id', $driverId)
            ->select('revenue_license_path', 'driver_image_path', 'insurance_path', 'vehicle_image_path', 'nic_path', 'bill_proof_path')
            ->first();

        // Remove null values from the documents array
        $filteredDocuments = collect($documents)->filter(function ($value, $key) {
            return !is_null($value);
        })->toArray();

        // Return JSON response with the filtered documents
        return response()->json(['documents' => $filteredDocuments]);
    }

    public function updateDriverProfileStatus(Request $request, $driverId)
    {
        $driver = Driver::find($driverId);
        if ($driver) {
            $status = $request->input('status');
            // Validate the status input if needed

            // Update the driver profile status
            $driver->profile_status = $status;
            $driver->save();

            // Optionally, you can return a response indicating success
            return response()->json(['message' => 'Driver profile status updated successfully']);
        } else {
            // Handle if driver not found
            return response()->json(['error' => 'Driver not found'], 404);
        }
    }
}
