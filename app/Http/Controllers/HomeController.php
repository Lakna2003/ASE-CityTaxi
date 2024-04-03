<?php

namespace App\Http\Controllers;

use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {
            $userId = Auth::id();

            // Check if the user has the appropriate roles
            $userRoles = UserRole::where('user_id', $userId)->pluck('role_id')->toArray();

            // Determine the new role
            $newRole = 2; // Default to role_id 2

            if (in_array(1, $userRoles)) {
                $newRole = 1; // If the user has role_id 1, set newRole to 1
            } elseif (in_array(4, $userRoles)) {
                $newRole = 4; // If the user has role_id 4, set newRole to 4
            }

            // Redirect based on the new role
            if ($newRole == 1) {
                // Redirect to admin drivers route
                return redirect()->route('admin.drivers');
            } elseif ($newRole == 4) {
                // Redirect to admin dashboard route
                return redirect()->route('operator.dashboard');
            } else {
                // For other roles, show the welcome page
                return view('welcome');
            }
        }
    }
}
