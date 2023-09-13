<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirportLocations extends Model
{
    use HasFactory;

    protected $fillable = [
        'airport_name','iata_code','country'
    ];
}
