<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'user_id',
        'location',
        'vehicle_model',
        'vehicle_type',
        'vehicle_plate_number',
        'vehicle_color',
        'profile_status',
        'driver_status',
        'seats'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicleDocument()
    {
        return $this->hasOne(VehicleDocument::class);
    }
}
