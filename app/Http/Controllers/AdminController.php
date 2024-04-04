<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\GuestPassenger;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function adminDashboard()
    {
        return view('operator_dashboard');
    }

    public function adminDrivers()
    {
        $drivers = Driver::with('user')->get();

        return view('admin_drivers', ['drivers' => $drivers]);
    }

    public function saveGuestPassenger(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string',
            'contact' => 'required|string',

        ]);

        $guestPassenger = new GuestPassenger([
            'name' => $request->input('full_name'),
            'mobile_number' => $request->input('contact'),
        ]);
        $guestPassenger->save();

        return response()->json(['success' => true, 'message' => 'Guest passenger data saved successfully']);
    }
}
