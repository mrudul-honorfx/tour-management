<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Hotel;
use App\Models\TourPackage;
use Illuminate\Http\Request;
use App\Models\BookingMaster;
use Ramsey\Uuid\Type\Integer;
use App\Models\BookingDetails;
use App\Models\TourPackageHotel;
use App\Models\TravellerDetails;
use App\Models\TourPackageAirline;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class BookingController extends Controller
{
    //

    // the model works on three models BookingMaster, BookingDetails and TravelerDetails
   
    //create new booking function

    public function addbooking($packageId)
    {
        /* $airlineProviders = AirlineProviders::all();
        $airportLocations = AirportLocations::all();
        $vehicleTypes = VehicleType::all();
        $hotelList = Hotel::all();
        $roomTypeList = HRoomType::all();
        $foodTypeList = HFoodType::all();
        $roomViewList = HViewType::all(); */

        // fetch the package information from the package id
        

        try {
            $package = TourPackage::find($packageId);
            $packageAirline = DB::table('tour_package_airlines AS tpa')
                                ->select([
                                    'ap.name AS airline_name',
                                    'ap.iata_code AS code',
                                    'tpa.flight_number AS flight_number',
                                    'tpa.pnr AS pnr',
                                    'tpa.departure_date_time AS departure_date_time',
                                    'tpa.arrival_date_time AS arrival_date_time',
                                    'dd.airport_name AS departure_destination_name',
                                    'dd.country AS departure_destination_country',
                                    'ad.airport_name AS arrival_destination_name',
                                    'ad.country AS arrival_destination_country',
                                    'tpa.luggage_capacity AS luggage_capacity',
                                    'tpa.check_in_luggage AS check_in_luggage'
                                ])
                                ->join('airline_providers AS ap', 'tpa.airline_id', '=', 'ap.id')
                                ->join('airport_locations AS dd', 'tpa.departure_destination', '=', 'dd.id')
                                ->join('airport_locations AS ad', 'tpa.arrival_destination', '=', 'ad.id')
                                ->where('tpa.tour_package_id', '=', $packageId)
                                ->get();
        
            $packageHotel = TourPackageHotel::where('tour_package_id', '=', $packageId)->get();
        
            // create new array to store the hotel information
            $hotelInfo = array();

            foreach($packageHotel as $index => $hotel)
            {
                // fetch the hotel information from the hotel id
                $hotelMain = Hotel::find($hotel->hotel_id);

                $hotelInfo[$index] = [
                    'id' => $hotel->hotel_id,
                    'hotel_name' => $hotelMain->hotel_name,
                    'hotel_address' => $hotelMain->address,
                    'rooms' => DB::table('h_room_types')->select('id','room_type_name')->whereIn('id', json_decode($hotel->room_type_id, true, 512, JSON_NUMERIC_CHECK))->get(),
                    'food' => DB::table('h_food_types')->select('id','food_type_name')->whereIn('id', json_decode($hotel->food_type_id, true, 512, JSON_NUMERIC_CHECK))->get(),
                    'view' => DB::table('h_view_types')->select('id','view_type_name')->whereIn('id', json_decode($hotel->room_view_id, true, 512, JSON_NUMERIC_CHECK))->get(),
                ];
                
            }

            // find number of slots available for the package
            $bookedSlots = BookingMaster::where('id', '=', $packageId)->where('booking_status', '=', 1)->sum('total_passengers');
            $availableSlots = $package->total_slots - $bookedSlots;
            return view('pages.booking.addbooking', compact('package','packageAirline','hotelInfo','availableSlots','availableSlots'));
            
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
       
    }


    public function createBooking(Request $request)
    {
       
        $validatedData = $request->validate([
                
            'p_traveller' => 'required',
            'email' => 'required',
            'contact_no' => 'required',
            'total_passenger' => 'required',
            'tour_start_date' => 'required',
            'return_date' => 'required',
            //check for bdetails array individually
            'b_details.hotel_id' => 'required',
            'b_details.room_type_id' => 'required',
            'b_details.food_type_id' => 'required',
            'b_details.view_type_id' => 'required',
            'b_details.no_of_rooms' => 'required',
            'b_details.check_in_date' => 'required',
            'b_details.check_out_date' => 'required',

            
        ]);

        

        try{
            $master = BookingMaster::create([
            
                'primary_traveller' => $request->input('p_traveller'),
                'booking_date' =>  Carbon::now(),
                'primary_traveller_contact_number' =>$request->input('contact_no'),
                'primary_traveller_email' => $request->input('email'),
                'total_passengers' => $request->input('total_passenger'),
                
                'departure_date' => $request->input('tour_start_date'),
                'return_date' => $request->input('return_date'),
                'booking_status' => 1, 
                'staff_id' => Auth::id(),
            ]);
            if ($request->has('group-a') && is_array($request->input('group-a')) && count($request->input('group-a')) > 0) {
                foreach ($request->input('group-a') as $coTravellerData) {
                    $coTraveller = new TravellerDetails();
                    $coTraveller->first_name = $coTravellerData['firstname'];
                    $coTraveller->last_name = $coTravellerData['lastname'];
                    $coTraveller->ticket_number = $coTravellerData['ticketnumber'];
                    $coTraveller->gender = $coTravellerData['gender'];
                    $coTraveller->booking_id = $master->id; // Associate with the booking
                    $coTraveller->save();
                }
            }
            // check if b_details is not empty
            if ($request->has('b_details')) {
                $bDetailData = $request->input('b_details');
                $bDetail = new BookingDetails();
                $bDetail->hotel_id = $bDetailData['hotel_id'];
                $bDetail->room_type_id = $bDetailData['room_type_id'];
                $bDetail->food_type_id = $bDetailData['food_type_id'];
                $bDetail->room_view_id = $bDetailData['view_type_id'];
                $bDetail->check_in_date = $bDetailData['check_in_date'];
                $bDetail->check_out_date = $bDetailData['check_out_date'];
                $bDetail->booking_id = $master->id; // Associate with the booking
                $bDetail->number_of_rooms = $bDetailData['no_of_rooms'];
                $bDetail->save();
            }
    
            return back()->with('success', 'Booking Added Successfully');
        }
        catch(\Exception $e)
        {
            dd($e->getMessage());
        }
        
    }

}
