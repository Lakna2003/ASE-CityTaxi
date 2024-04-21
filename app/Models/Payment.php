<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'booking_id',
        'total_payed',
        'payment_type',
    ];

    public function booking()
    {
        return $this->belongsTo(Trip::class);
    }
}
