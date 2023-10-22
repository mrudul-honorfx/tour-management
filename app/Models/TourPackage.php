<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPackage extends Model
{
    use HasFactory;
    // fillable fields are tour start date, tour end date, tour start destination, tour total slots where the field names have _ instead of spaces
    
    protected $fillable = [
        'id','package_name' ,'package_name_ar','tour_start_date', 'tour_end_date', 'departure_destination', 'arrival_destination','total_slots'
    ];

    public function tourPackageHotels()
    {
        return $this->hasMany(TourPackageHotel::class);
    }

    public function tourPackageAirlines()
    {
        return $this->hasMany(TourPackageAirline::class);
    }

}
