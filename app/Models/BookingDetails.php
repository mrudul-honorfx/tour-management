<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetails extends Model
{
    /*

        Booking Details Table contains the following fields
        1. Booking ID
        2. Hotel ID
        3. Room Type ID
        4. Food Type ID
        5. Room View ID
        6. Check In Date
        7. Check Out Date
        8. Number of Rooms
        9. Flight Class

    */
    use HasFactory;
    protected $table = 'booking_details';
    protected $fillable = [
        'booking_id',
        'hotel_conformation_id',
        'hotel_id',
        'room_type_id',
        'food_type_id',
        'room_view_id',
        'check_in_date',
        'check_out_date',
        'number_of_rooms',
        'flight_class',
    ];

    public function bookingMaster()
    {
        return $this->belongsTo(BookingMaster::class, 'booking_id');
    }
}
