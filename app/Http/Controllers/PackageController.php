<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HFoodType;
use App\Models\HRoomType;
use App\Models\HViewType;
use App\Models\TourPackage;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use App\Models\AirlineProviders;
use App\Models\AirportLocations;
use App\Models\TourPackageHotel;
use Illuminate\Support\Facades\DB;

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
            'arrival_destination' => 'required',
            'total_slots' => 'required',
        ]);

        // Create a new tour package

        $package = TourPackage::create([
            'tour_start_date' => $request->tour_start_date,
            'tour_end_date' => $request->tour_end_date,
            'departure_destination' => $request->departure_destination,
            'arrival_destination' => $request->arrival_destination,
            'total_slots' => $request->total_slots,
        ]);

        // Store the airline information of the package
        $package->tourPackageAirlines()->createMany($request->airline);

        $data = [
            'hotel_id' => $request->input('hotel_id'),
            'tour_package_id' => $package->id,
            'room_type_id' => json_encode($request->input('room_type')),
            'food_type_id' => json_encode($request->input('food_type')),
            'room_view_id' => json_encode($request->input('room_view_id')),
            'available_rooms' => 10, // You need to specify how you want to set this value
        ];
    
        // Create a new TourPackageHotel instance and save it to the database
        $tourPackageHotel = TourPackageHotel::create($data);

        // // Store the transfer information of the package
        // $package->tourPackageTransfers()->createMany($request->transfers);

        // Return the package information
        return back()->with('success', 'Package Added Successfully');
       
    }

    // function to return the packages that are not expired. The expiery of packages are based on the tour start date
    // the function will return the following information
    // 1. tour start date
    // 2. tour end date
    // 3. departure destination
    // 4. arrival destination
    // 5. total slots
    // 7. Hotel Name
    public function viewPackages()
    {
        // sql query to get the packages that are not expired along with the hotel informations and the associated airline information
        $packages = TourPackage::where('tour_start_date', '>=', date('Y-m-d'))->with('tourPackageHotels')->with('tourPackageAirlines')->get();
        
        //$packages = TourPackage::all();
        return $packages;
        // return view('pages.package.viewPackages', compact('packages'));
    }
    public function getPackageList(Request $request)
    {
        $tourPackages = DB::table('tour_packages as tp')
        ->select('tp.id as package_id', 'tp.tour_start_date', 'tp.tour_end_date', 'tp.departure_destination', 'tp.arrival_destination', 'ap.name as airline_name', 'h.hotel_name', 'tp.total_slots')
        ->leftJoin('tour_package_airlines as tpa', 'tp.id', '=', 'tpa.tour_package_id')
        ->leftJoin('airline_providers as ap', 'tpa.airline_id', '=', 'ap.id')
        ->leftJoin('tour_package_hotels as tph', 'tp.id', '=', 'tph.tour_package_id')
        ->leftJoin('hotels as h', 'tph.hotel_id', '=', 'h.id')
        ->where('tp.tour_start_date', '>=', DB::raw('CURDATE()'))
        ->orderBy('tp.tour_start_date', 'asc')
        ->limit(12)
        ->get();

        $airportLocations = AirportLocations::all();
        $airlineProviders = AirlineProviders::all();



    return view('pages.package.packageListing',compact('tourPackages','airportLocations','airlineProviders'));
    }
  
    public function getFilteredPackageList(Request $request)
    {  

        $startDate = $request['date_range'];
        $endDate = $request['date_range'];

        // Check if a date range is provided
        if (strpos($request['date_range'], ' to ') !== false) {
            // Split the "date_range" parameter into start and end dates for a range
            $dateRange = explode(" to ", $request['date_range']);
            $startDate = $dateRange[0];
            $endDate = $dateRange[1];
        }

        $tourPackagesQuery = DB::table('tour_packages as tp')
        ->select('tp.id as package_id', 'tp.tour_start_date', 'tp.tour_end_date', 'tp.departure_destination', 'tp.arrival_destination', 'ap.name as airline_name', 'h.hotel_name', 'tp.total_slots')
        ->leftJoin('tour_package_airlines as tpa', 'tp.id', '=', 'tpa.tour_package_id')
        ->leftJoin('airline_providers as ap', 'tpa.airline_id', '=', 'ap.id')
        ->leftJoin('tour_package_hotels as tph', 'tp.id', '=', 'tph.tour_package_id')
        ->leftJoin('hotels as h', 'tph.hotel_id', '=', 'h.id')
        ->where(function ($query) use ($startDate, $endDate) {
            $query->where('tp.tour_start_date', '>=', $startDate)
                  ->where('tp.tour_end_date', '<=', $endDate);
        })
        ->orderBy('tp.tour_start_date', 'asc');
        
        // Apply additional filters based on other request parameters
        if ($request['departure_airport'] != 'Select') {
            $tourPackagesQuery->where('tp.departure_destination', $request['departure_airport']);
        }

        if ($request['arrival'] != 'Select') {
            $tourPackagesQuery->where('tp.arrival_destination', $request['arrival']);
        }

        if ($request['airline'] != 'Select') {
            $tourPackagesQuery->where('ap.id', $request['airline']);
        }

        // Execute the query and get the results
        $tourPackages = $tourPackagesQuery->get();

        $airportLocations = AirportLocations::all();
        $airlineProviders = AirlineProviders::all();
        $dateRange = $request['date_range'];
        $departureAirport= $request['departure_airport'];
        $arrivalAirport= $request['arrival'];
        $flight= $request['airline'];
         
        return view('pages.package.packageListing',compact('tourPackages','flight','arrivalAirport','dateRange','departureAirport','airportLocations','airlineProviders'));

    }

    public function getFilteredPackage(Request $request)
    {  
       
        $tourPackagesQuery = DB::table('tour_packages as tp')
        ->select(
            'tp.package_name',
            'tp.departure_destination',
            'tpa.airline_id',
            'ap.name as airline_name',
            'tph.hotel_id',
            'h.hotel_name',
          
        )
        ->join('tour_package_airlines as tpa', 'tp.id', '=', 'tpa.tour_package_id')
        ->join('airline_providers as ap', 'tpa.airline_id', '=', 'ap.id')
        ->leftjoin('tour_package_hotels as tph', 'tp.id', '=', 'tph.tour_package_id')
        ->leftJoin('hotels as h', 'tph.hotel_id', '=', 'h.id')
        ->orderBy('tp.departure_destination')
        ->orderBy('tph.hotel_id')
        ->orderBy('tpa.airline_id')
        ->orderBy('tp.tour_start_date', 'asc');
       
        
        
        if ($request['departure_destination']) {
            
            $tourPackagesQuery->where('tp.departure_destination', '=','Dubai');
            
        }
      
        if ($request['airline_id']) {
            $tourPackagesQuery->where('ap.id', $request['airline_id']);
        }
        if ($request['hotel_id']) {
            $tourPackagesQuery->where('tph.hotel_id', $request['hotel_id']);
        }

        // Execute the query and get the results
        $tourPackages = $tourPackagesQuery->get();

        return view('pages.dashboard.filteredList',compact('tourPackages'));

         

    }

}
