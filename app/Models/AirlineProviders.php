<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class AirlineProviders extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','iata_code','status'
    ];
}
