<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Payment;
use App\Models\Trip;
use App\Models\User;
use App\Models\VehicleDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class BookingController extends Controller
{

    public function findNearbyDrivers(Request $request)
    {
        $pickLoc = $request->input('pick_loc');
        $dropLoc = $request->input('drop_loc');

        list($pickLat, $pickLon) = explode(',', $pickLoc);
        list($dropLat, $dropLon) = explode(',', $dropLoc);

        $distancePickToDrop = $this->haversineDistance($pickLat, $pickLon, $dropLat, $dropLon);

        $radius = 10;

        $drivers = Driver::with('user', 'vehicleDocument')
            ->where('driver_status', 0)
            ->where('profile_status', 1)
            ->get();

        $nearbyDrivers = [];

        foreach ($drivers as $driver) {
            list($driverLat, $driverLon) = explode(',', $driver->location);

            $distanceToPickup = $this->haversineDistance($pickLat, $pickLon, $driverLat, $driverLon);

            if ($distanceToPickup <= $radius) {
                $vehicleDocument = VehicleDocument::where('driver_id', $driver->id)->first();

                $nearbyDrivers[] = [
                    'driver' => $driver,
                    'distance' => $distanceToPickup,
                    'distance_pick_to_drop' => $distancePickToDrop,
                    'vehicle_image_path' => $vehicleDocument ? $vehicleDocument->vehicle_image_path : 'null',
                ];
            }
        }
        return view('vehicle_booking', ['nearbyDrivers' => $nearbyDrivers]);
    }

    protected function haversineDistance($lat1, $lon1, $lat2, $lon2)
    {
        $R = 6371; // Earth radius in kilometers

        $dlat = deg2rad($lat2 - $lat1);
        $dlon = deg2rad($lon2 - $lon1);

        $a = sin($dlat / 2) * sin($dlat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dlon / 2) * sin($dlon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $R * $c; // Distance in kilometers

        return $distance;
    }

    public function bookingSuccess(Request $request)
    {
        $driverId = $request->query('driver_id');
        $distance = $request->query('distance');


        $loggedInUser = Auth::user();
        $loggedInUserEmail = Auth::user()->email;

        $userId = Auth::id();

        $hasDesiredAdminRole = \DB::table('user_roles')
            ->where('user_id', $userId)
            ->whereIn('role_id', [1])
            ->exists();

        $hasDesiredOperatorRole = \DB::table('user_roles')
            ->where('user_id', $userId)
            ->whereIn('role_id', [4])
            ->exists();

        if ($hasDesiredAdminRole || $hasDesiredOperatorRole) {
            $passenger = \DB::table('guest_passengers')
                ->orderBy('created_at', 'desc')
                ->first();

            if ($passenger) {
                $passengerName = $passenger->name;
                $passengerContact = $passenger->mobile_number;
                $passengerId = 1;
                $loggedInUserEmail = '';
            }
        } else {
            $passengerName = $loggedInUser->name;
            $passengerContact = $loggedInUser->mobile_number;
            $passengerId = $loggedInUser->id;
        }


        if ($loggedInUser) {


            $pendingTrip = Trip::where('passenger_id', $passengerId)
                ->where(function ($query) {
                    $query->where('status', 0)
                        ->orWhere('payment_status', 0);
                })
                ->latest()
                ->first();

            $completedTrip = Trip::where('passenger_id', $passengerId)
                ->where('status', 1)
                ->where('payment_status', 1)
                ->first();


            if ($pendingTrip) {

                if ($pendingTrip->status == 1 && $pendingTrip->payment_status == 0) {
                    return redirect()->route('booking.payment', ['tripId' => $pendingTrip->id]);
                }

                if ($pendingTrip->status == 0) {
                    $trip = Trip::with(['vehicle', 'passenger', 'driver'])->find($pendingTrip->id);

                    return view('booking_success', ['trip' => $trip]);
                }
            }



            $driver = Driver::with('user')->where('id', $driverId)->first();

            if ($driver) {
                $vehicleType = $driver->vehicle_type;
                $vehicleModel = $driver->vehicle_model;
                $vehiclePlateNumber = $driver->vehicle_plate_number;
                $vehicleColor = $driver->vehicle_color;

                $fareRate = ($vehicleType == 'Car') ? 80 : (($vehicleType == 'Van') ? 120 : 0);
                $totalFare = $fareRate * $distance;

                $driverUser = User::find($driver->user_id);

                if ($driverUser) {
                    $driverName = $driverUser->name;
                    $driverContact = $driverUser->mobile_number;
                    $driverId = $driver->id;

                    $vehicleDocument = VehicleDocument::where('driver_id', $driverId)->first();
                    $vehicleId = $vehicleDocument ? $vehicleDocument->id : null;

                    $trip = Trip::create([
                        'vehicle_number' => $vehiclePlateNumber,
                        'vehicle_id' => $vehicleId,
                        'vehicle_color' => $vehicleColor,
                        'vehicle_model' => $vehicleModel,
                        'passenger_name' => $passengerName,
                        'passenger_contact' => $passengerContact,
                        'passenger_id' => $passengerId,
                        'driver_contact' => $driverContact,
                        'driver_id' => $driverId,
                        'driver_name' => $driverName,
                        'comment' => 'Your Trip Description',
                        'distance' => $distance,
                        'total_fare' => $totalFare,
                        'status' => 0,
                        'payment_status' => 0,
                        'rating' => null,
                    ]);

                    Driver::where('id', $driverId)->update(['driver_status' => 1]);


                    $trip = Trip::with(['vehicle', 'passenger', 'driver'])->find($trip->id);

                    $passengerName = $trip->passenger_name;
                    $driverName = $trip->driver_name;
                    $driverContact = $trip->driver_contact;
                    $vehicleNumber = $trip->vehicle_number;
                    $vehicleModel = $trip->vehicle_model;


                    $smsMessage = "Your booking is successful!\n"
                        . "Driver Name: $driverName\n"
                        . "Driver Contact: $driverContact\n"
                        . "Vehicle Model: $vehicleModel\n"
                        . "Vehicle Number: $vehicleNumber\n\n\n\n\n";
                    $basic  = new \Vonage\Client\Credentials\Basic("93f2e448", "Bp9VmrQgSaL15QPO");
                    $client = new \Vonage\Client($basic);

                    $client->sms()->send(
                        new \Vonage\SMS\Message\SMS("94740061046", 'Mal', $smsMessage)
                    );

                    Mail::raw($smsMessage, function ($message)  use ($loggedInUserEmail) {
                        $message->to($loggedInUserEmail)->subject('Your Booking Details');
                    });

                    return view('booking_success', ['trip' => $trip]);
                } else {
                    return view('driver_user_not_found', ['driverId' => $driverId]);
                }
            } else {
                return view('driver_not_found', ['driverId' => $driverId]);
            }
        } else {
            return view('user_not_found');
        }
    }

    // public function sendSms($to, $from, $message)
    // {
    //     $basic  = new \Vonage\Client\Credentials\Basic("b19df179", "cityTaxi1");
    //     $client = new \Vonage\Client($basic);

    //     $response = $client->sms()->send(
    //         new \Vonage\SMS\Message\SMS($to, $from, $message)
    //     );

    //     $message = $response->current();

    //     return $message->getStatus() == 0;
    // }


    public function bookingPayment($tripId)
    {
        $loggedInUser = Auth::user();

        if ($loggedInUser) {
            $passengerId = $loggedInUser->id;

            $existingTrip = Payment::where('booking_id', $tripId)
                ->first();

            if ($existingTrip) {
                // Redirect to home
                return redirect()->route('home');
            }

            $trip = Trip::with(['vehicle', 'passenger', 'driver'])->find($tripId);

            if ($trip) {
                $trip->update(['status' => 1]);

                return view('payment', ['trip' => $trip]);
            } else {
                return view('trip_not_found', ['tripId' => $tripId]);
            }
        } else {
            return view('user_not_found');
        }
    }

    public function completePayment(Request $request)
    {
        $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'payment_type' => 'required|in:bank_wire,credit_card,cash,paypal',
            'total_fare' => 'required|numeric',
        ]);

        $payment = new Payment([
            'booking_id' => $request->trip_id,
            'total_payed' => $request->total_fare,
            'payment_type' => $request->payment_type,
        ]);

        $payment->save();


        $booking = Trip::findOrFail($request->trip_id);
        $booking->update(['payment_status' => '1']);

        $driver = Driver::where('id', $booking->driver_id)->first();
        if ($driver) {
            $driver->update(['driver_status' => 0]);
        }

        $passengerName = $booking->passenger_name;
        $tripId = $booking->id;

        $smsMessage = "Your trip (ID: $tripId) payment credited successfully by passenger $passengerName.\n\n\n\n\n";


        $basic  = new \Vonage\Client\Credentials\Basic("93f2e448", "Bp9VmrQgSaL15QPO");
        $client = new \Vonage\Client($basic);

        $client->sms()->send(
            new \Vonage\SMS\Message\SMS("94740061046", 'Mal', $smsMessage)
        );

        return response()->json(['message' => 'Payment completed successfully']);
    }

    public function review(Request $request)
    {
        $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'rating' => 'required|integer|between:0,5',
            'comments' => 'nullable|string',
        ]);

        $trip = Trip::find($request->input('trip_id'));

        $review = Trip::updateOrCreate(
            ['id' => $trip->id],
            [
                'rating' => $request->input('rating'),
                'comment' => $request->input('comments'),
            ]
        );

        return response()->json(['message' => 'Review updated successfully']);
    }

    public function cancelBooking($tripId)
    {
        $trip = Trip::find($tripId);

        if (!$trip) {
            return response()->json(['error' => 'Trip not found.'], 404);
        }

        $trip->update(['status' => 2]);

        $driverId = $trip->driver_id;

        if ($driverId) {
            $driver = Driver::where('id', $driverId)->first();

            if ($driver) {
                $driver->update(['driver_status' => 0]);
            }
        }


        return response()->json(['message' => 'Booking canceled successfully.']);
    }
}
