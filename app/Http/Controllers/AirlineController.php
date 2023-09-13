<?php

namespace App\Http\Controllers;

use App\Models\AirlineProviders;
use App\Models\AirportLocations;


use Illuminate\Http\Request;

class AirlineController extends Controller
{
    // function to fetch all airport locations

    public function fetchAirlineLocations()
    {
        $airlineLocations = Airline::all();
        return $airlineLocations;
    }

    // function to list all airline providers

    public function fetchAirlineProviders()
    {
        $airlineProviders = Airline::all();
        return $airlineProviders;
    }

}
