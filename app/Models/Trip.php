<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'vehicle_number',
        'vehicle_id',
        'vehicle_color',
        'vehicle_model',
        'passenger_name',
        'passenger_contact',
        'passenger_id',
        'driver_contact',
        'driver_id',
        'driver_name',
        'comment',
        'distance',
        'total_fare',
        'status',
        'payment_status',
        'rating',
    ];

    public function vehicle()
    {
        return $this->belongsTo(VehicleDocument::class, 'vehicle_id'); // Change 'id' to 'vehicle_id'
    }

    public function passenger()
    {
        return $this->belongsTo(User::class, 'passenger_id'); // Change 'id' to 'passenger_id'
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id'); // Change 'user_id' to 'driver_id'
    }
}
