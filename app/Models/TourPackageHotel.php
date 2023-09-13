<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPackageHotel extends Model
{
    use HasFactory;
    /* The fillable fields are
            1. hotel id
            2. tour package id
            3. room type id
            4. food type id
            5. room view id
            6. available rooms
    */

    protected $fillable = [
        'hotel_id', 'tour_package_id', 'room_type_id', 'food_type_id', 'room_view_id', 'available_rooms'
    ];

    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class);
    }
}
