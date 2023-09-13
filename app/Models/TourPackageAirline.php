<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPackageAirline extends Model
{
    use HasFactory;
    /* 
        The fillable fields are
        1. tour package id
        2. airline id
        3. fligt number
        4. departure date and time
        5. arrival date and time
        6. departure destination
        7. arrival destination
        8. available seats
        9. luggage capacity
        10. check in luggage 
        */

    protected $fillable = [
        'tour_package_id', 'airline_id', 'flight_number', 'departure_date_time', 'arrival_date_time', 'departure_destination', 'arrival_destination', 'available_seats', 'luggage_capacity', 'check_in_luggage'
    ];

    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class);
    }

}
