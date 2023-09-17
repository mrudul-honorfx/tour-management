<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\BookingMaster;
use App\Models\TravellerDetails;
use App\Models\Hotel;

use App\Models\HRoomType;

use App\Models\HFoodType;

use App\Models\HViewType;
use App\Models\BookingDetails;


class BookingController extends Controller
{
    //

    // the model works on three models BookingMaster, BookingDetails and TravelerDetails
   
    //create new booking function

    public function addbooking()
    {
        
        
        $hotelList = Hotel::all();
        $roomTypeList = HRoomType::all();
        $foodTypeList = HFoodType::all();
        $roomViewList = HViewType::all(); 
        return view('pages.booking.addbooking',compact('hotelList', 'roomTypeList', 'foodTypeList', 'roomViewList'));
        ;
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
            
        ]);


        $master = BookingMaster::create([
            
            'primary_traveller' => $request->input('p_traveller'),
            'booking_date' =>  Carbon::now(),
            'primary_traveller_contact_number' =>$request->input('contact_no'),
            'primary_traveller_email' => $request->input('email'),
            'total_passengers' => $request->input('total_passenger'),
            
            'departure_date' => $request->input('tour_start_date'),
            'return_date' => $request->input('return_date'),
            'booking_status' => 1,
           
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
        
        $itenary= BookingDetails::create([

            'hotel_id' => $request->input('hotel_id'),
            'room_type_id' =>  $request->input('room_type_id') ? json_encode($request->input('room_type_id')): '',
            'food_type_id' =>$request->input('food_type_id') ? json_encode($request->input('food_type')): '',
            'room_view_id' => $request->input('room_view_id') ? json_encode($request->input('room_view_id')): '',
            'check_in_date' => $request->input('check_in_data'),
            'check_out_date' => $request->input('check_out_data'),
            'number_of_rooms' => $request->input('number_of_rooms'),
            'flight_class' => $request->input('return_date'),
            'booking_id'=>$master->id
           


        ]);


        return back()->with('success', 'Booking Added Successfully');
        
    }

}
