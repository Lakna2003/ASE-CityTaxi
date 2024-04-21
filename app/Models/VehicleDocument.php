<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleDocument extends Model
{
    protected $fillable = [
        'driver_id',
        'revenue_license_path',
        'driver_image_path',
        'insurance_path',
        'vehicle_image_path',
        'nic_path',
        'bill_proof_path',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
