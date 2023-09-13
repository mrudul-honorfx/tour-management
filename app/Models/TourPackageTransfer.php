<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPackageTransfer extends Model
{
    use HasFactory;

    /* The schema has the following fields
            1. tour package id
            2. vehicle type
            3. pickup location
            4. pickup time
            5. drop off location
            6. drop off time
        */
    protected $fillable = [
        'tour_package_id', 'vehicle_type', 'pickup_location', 'pickup_time', 'drop_off_location', 'drop_off_time'
    ];

    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class);
    }
}
