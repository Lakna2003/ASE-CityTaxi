<?php

namespace App\Http\Middleware;

use App\Models\UserRole;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsOperator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $userId = Auth::id();

            // Check if the user has the appropriate role
            //$userRole = UserRole::where('user_id', $userId)->first();

            $userRoles = UserRole::where('user_id', $userId)->pluck('role_id')->toArray();


            if (in_array(4, $userRoles) || in_array(1, $userRoles)) {
                return $next($request);
            } else {
                return back();
            }
        }

        // Allow access to the route if the user is not authenticated or doesn't have the appropriate role
        return $next($request);
    }
}
