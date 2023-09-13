<?php

namespace App\Http\Controllers;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    //function to list all vehicle types

    public function fetchVehicleTypes()
    {
        $vehicleTypes = VehicleType::all();
        return $vehicleTypes;
    }
}
