<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HFoodType;
use App\Models\HRoomType;
use App\Models\TourPackage;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use App\Models\AirlineProviders;
use App\Models\AirportLocations;
use App\Models\HViewType;

class PackageController extends Controller
{


    //function to show the add package page
    // the function to send the airline provider list, airport list and vehicle type list to the add package page   

    public function index()
    {
        $airlineProviders = AirlineProviders::all();
        $airportLocations = AirportLocations::all();
        $vehicleTypes = VehicleType::all();
        $hotelList = Hotel::all();
        $roomTypeList = HRoomType::all();
        $foodTypeList = HFoodType::all();
        $roomViewList = HViewType::all();
        return view('pages.package.addPackage', compact('airlineProviders', 'airportLocations', 'vehicleTypes', 'hotelList', 'roomTypeList', 'foodTypeList', 'roomViewList'));
    }



    //create new package function
    /* 
     The function will recieve the following inputs
        1. tour start date *
        2. tour end date *
        3. tour start destination *
        4. tour end destination *
        4. tour total slots  *
        5. hotel information array 
            1. hotel id 
            3. room type id
            4. food type id
            5. room view id
            6. available rooms
        6. airline information array
            2. airline id
            3. fligt number
            4. departure date and time
            5. arrival date and time
            6. departure destination
            7. arrival destination
            8. available seats
            9. luggage capacity
            10. check in luggage 
        7. transfer information array
            2. vehicle type
            3. pickup location
            4. pickup time
            5. drop off location
            6. drop off time
    where * denotes required fields

    The function should perform the followin functions.
        1. Validate required inputs
        2. Create a new tour package
        3. Store the airline information of the package
        4. Store the hotel information of the package
        5. Store the transfer information of the package
    */

    public function createTourPackage(Request $request)
    {
        // Validate required inputs and return if there is error
        $request->validate([
            'tour_start_date' => 'required',
            'tour_end_date' => 'required',
            'departure_destination' => 'required',
            'total_slots' => 'required',
        ]);

        // Create a new tour package

        $package = TourPackage::create([
            'tour_start_date' => $request->tour_start_date,
            'tour_end_date' => $request->tour_end_date,
            'departure_destination' => $request->departure_destination,
            'total_slots' => $request->total_slots,
        ]);

        // Store the airline information of the package
        $package->tourPackageAirlines()->createMany($request->airlines);

        // Store the hotel information of the package
        $package->tourPackageHotels()->createMany($request->hotels);

        // Store the transfer information of the package
        $package->tourPackageTransfers()->createMany($request->transfers);

        // Return the package information
        return response()->json([
            'package' => $package
        ]);
       
    }

}
