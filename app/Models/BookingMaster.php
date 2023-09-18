<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BookingMaster;

class BookingMaster extends Model
{
    /* Booking Master Table contains the following fields
        1. Booking ID
        2. Booking Date
        3. Primary Traveller
        3. Primary Traveller Contact Number
        4. Primary Traveller Email
        5. Total Passengers
        6. Departure Date
        7. Return Date
    */
    use HasFactory;
    protected $table = 'booking_masters';
    protected $fillable = [
        'booking_date',
        'primary_traveller',
        'primary_traveller_contact_number',
        'primary_traveller_email',
        'total_passengers',
        'departure_date',
        'return_date',
        'booking_status',
        'staff_id',
        'package_id'

    ];

    public function bookingDetails()
    {
        return $this->hasMany(BookingDetails::class, 'booking_id');
    }

    public function travellerDetails()
    {
        return $this->hasMany(TravellerDetails::class, 'booking_id');
    }
}
