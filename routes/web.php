<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DriverController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth'], function () {

    Route::get('/driver-register', [DriverController::class, 'index'])->name('driver.register');
    Route::post('/driver-save', [DriverController::class, 'saveDriver'])->name('driver.save');
    Route::post('/driver-documents/save', [DriverController::class, 'saveDriverDocuments'])->name('driver.saveDocuments');
    Route::get('/driver-register-get', [DriverController::class, 'isRegisteredDriver'])->name('check.driver.registered');
    Route::get('/driver-register-status-check', [DriverController::class, 'checkDriverProfileStatus'])->name('check.driver.profile.status');
    Route::match(['get', 'post'], '/find-nearby-drivers', [BookingController::class, 'findNearbyDrivers'])->name('find.nearby.drivers');


    Route::get('/booking', [BookingController::class, 'index'])->name('booking');

    Route::get('/booking-success', [BookingController::class, 'bookingSuccess'])->name('booking.success');
    Route::get('/booking/payment/{tripId}', [BookingController::class, 'bookingPayment'])->name('booking.payment');
    Route::post('/booking/review', [BookingController::class, 'review'])->name('review');
    Route::post('booking/cancel/{tripId}', [BookingController::class, 'cancelBooking'])->name('booking.cancel');

});

//admin routes

Route::group(['middleware' => 'admin'], function () {
   
});


