<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravellerDetails extends Model
{
     // The Traveller Details Table contains the following fields
    // 1. Traveller ID
    // 2. Booking ID
    // 3. First Name
    // 4. Last Name
    // 5. Gender
    // 6.ticket_number
    use HasFactory;
    protected $table = 'traveller_details';
    protected $fillable = [
        'booking_id',
        'first_name',
        'last_name',
        'agecat',
        'ticket_number'
    ];

    public function bookingMaster()
    {
        return $this->belongsTo(BookingMaster::class, 'booking_id');
    }

}
