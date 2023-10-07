<?php

namespace App\Http\Controllers;

use Validator;
use Carbon\Carbon;
use App\Models\Hotel;
use App\Models\TourPackage;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use App\Models\BookingMaster;
use Ramsey\Uuid\Type\Integer;
use App\Models\BookingDetails;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TourPackageHotel;
use App\Models\TravellerDetails;
use App\Models\TourPackageAirline;
use Illuminate\Support\Facades\DB;
use App\Models\TourPackageTransfer;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class BookingController extends Controller
{
    //

    // the model works on three models BookingMaster, BookingDetails and TravelerDetails

    //create new booking function

    public function addbooking($packageId)
    {

        try {
            $package = TourPackage::find($packageId);
            $packageAirline = DB::table('tour_package_airlines AS tpa')
                                ->select([
                                    'ap.name AS airline_name',
                                    'ap.iata_code AS code',
                                    'tpa.flight_number AS flight_number',
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
            $vehicleTypes = VehicleType::all();
            // find number of slots available for the package
            $bookedSlots = BookingMaster::where('id', '=', $packageId)->where('booking_status', '=', 1)->sum('total_passengers');
            $availableSlots = $package->total_slots - $bookedSlots;
            return view('pages.booking.addbooking', compact('package','packageAirline','hotelInfo','availableSlots','availableSlots','vehicleTypes'));

        } catch (\Exception $e) {
            dd($e->getMessage());
        }


    }


    public function createBooking(Request $request)
    {
    //    dd($request->all());

        $rules = [
            'p_traveller' => 'required',
            'email' => 'required',
            'contact_no' => 'required',
            'total_passenger' => 'required',
            'tour_start_date' => 'required',
            'return_date' => 'required',
            'package_id' => 'required',

        ];
      
        $validator = Validator::make($request->all(), $rules);

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
                'package_id' => $request->input('package_id'),
            ]);
            
            if ($request->has('group-a') && is_array($request->input('group-a')) && count($request->input('group-a')) > 0) {
                
                foreach ($request->input('group-a') as $coTravellerData) {
                    // check  if name prefix, first name, last name, ticket number and age category is not empty
                    if (!empty($coTravellerData['prefix']) || !empty($coTravellerData['firstname']) || !empty($coTravellerData['lastname']) || !empty($coTravellerData['agecat'])) {
                        $coTraveller = new TravellerDetails();
                        $coTraveller->salutation = $coTravellerData['prefix'];
                        $coTraveller->first_name = $coTravellerData['firstname'];
                        $coTraveller->last_name = $coTravellerData['lastname'];
                        $coTraveller->ticket_number = $coTravellerData['ticketnumber'];
                        $coTraveller->agecat = $coTravellerData['agecat'];
                        $coTraveller->booking_id = $master->id; // Associate with the booking
                        $coTraveller->save();
                    }
                    
                   
                }
            }
            // check if b_details is not !empty
            if ($request->has('group-b') && is_array($request->input('group-b')) && count($request->input('group-b')) > 0) {
                
                foreach ($request->input('group-b') as $bDetailData)
                {
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
                
            }

            if ($request->has('group-c') && is_array($request->input('group-c')) && count($request->input('group-c')) > 0) {
                
                foreach ($request->input('group-c') as $bTransferData)
                {
                    $bDetail = new TourPackageTransfer();
                    $bDetail->booking_master_id = $master->id;
                    $bDetail->vehicle_type = $bTransferData['vehicle_type_id'];
                    $bDetail->pickup_location = $bTransferData['pickup_location'];
                    $bDetail->pickup_time = $bTransferData['pickup_time'];
                    $bDetail->drop_off_location = $bTransferData['drop_off_location'];
                    $bDetail->save();
                }
                
            }

            flash()
                ->option('position', 'top-right')
                ->option('timeout', 3000)
                ->addSuccess('Booking has created successfully');

            return redirect()->route('blisting');

            // return response()->json(['success' => true, 'message' => 'Booking has created successfully']);
        }
        catch(\Exception $e)
        {
            Log::error('Validation failed: ' . $request->url(), [
                'errors' => $validator->errors(),
                'other' => $e->getMessage(),
            ]);
            return back()->with('error', $e->getMessage());
            // return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }

    }

    public function blisting($id = null)
    {
       
        if(!$id)
        {
            $bookings = DB::table('booking_masters as bm')
                ->select('bm.id as booking_id', 'bm.booking_date','bm.primary_traveller','bm.total_passengers','bm.booking_status as status', 'tp.tour_start_date', 'tp.tour_end_date', 'tp.departure_destination', 'tp.arrival_destination', 'ap.name as airline_name', 'h.hotel_name', 'tp.total_slots','s.name as staff_name')
                ->leftJoin('tour_packages as tp', 'bm.package_id', '=', 'tp.id')
                ->join('tour_package_airlines as tpa', 'tp.id', '=', 'tpa.tour_package_id')
                ->leftJoin('airline_providers as ap', 'tpa.airline_id', '=', 'ap.id')
                ->leftJoin('tour_package_hotels as tph', 'tp.id', '=', 'tph.tour_package_id')
                ->leftJoin('hotels as h', 'tph.hotel_id', '=', 'h.id')
                ->leftJoin('users as s', 'bm.staff_id', '=', 's.id')
                ->orderBy('bm.id', 'desc')
                ->distinct() // Add this line to remove duplicates
                ->get();
        }
        else
        {
            try
            {
                $bookings = DB::table('booking_masters as bm')
                ->select('bm.id as booking_id', 'bm.booking_date','bm.primary_traveller','bm.total_passengers','bm.booking_status as status', 'tp.tour_start_date', 'tp.tour_end_date', 'tp.departure_destination', 'tp.arrival_destination', 'ap.name as airline_name', 'h.hotel_name', 'tp.total_slots','s.name as staff_name')
                ->leftJoin('tour_packages as tp', 'bm.package_id', '=', 'tp.id')
                ->join('tour_package_airlines as tpa', 'tp.id', '=', 'tpa.tour_package_id')
                ->leftJoin('airline_providers as ap', 'tpa.airline_id', '=', 'ap.id')
                ->leftJoin('tour_package_hotels as tph', 'tp.id', '=', 'tph.tour_package_id')
                ->leftJoin('hotels as h', 'tph.hotel_id', '=', 'h.id')
                ->leftJoin('users as s', 'bm.staff_id', '=', 's.id')
                ->where('tp.id','=',$id)
                ->orderBy('bm.id', 'desc')
                ->distinct() // Add this line to remove duplicates
                ->get();

            }catch(\Exception $e)
            {
                flash()
                ->option('position', 'top-right')
                ->option('timeout', 3000)
                ->addError('Something went wrong');
                return redirect()->back();
            }
        }
        
        
        

        return view('pages.booking.bookingList',compact('bookings'));
    }


    public function downloadInvoice($bookingId)
    {
        // collect all details related to booking
        $bookingMaster = BookingMaster::find($bookingId);
        $packageInfo = TourPackage::find($bookingMaster->package_id);
        $additionalPassengers = TravellerDetails::where('booking_id', '=', $bookingId)->get();
        $bookingDetails = BookingDetails::where('booking_id', '=', $bookingId)->first();
        $packageAirline = DB::table('tour_package_airlines AS tpa')
                                ->select([
                                    'tpa.airline_id AS airline_id',
                                    'ap.name AS airline_name',
                                    'ap.iata_code AS code',
                                    'tpa.flight_number AS flight_number',
                                    'tpa.departure_date_time AS departure_date_time',
                                    'tpa.arrival_date_time AS arrival_date_time',
                                    'dd.airport_name AS departure_destination_name',
                                    'dd.country AS departure_destination_country',
                                    'ad.airport_name AS arrival_destination_name',
                                    'ad.country AS arrival_destination_country',
                                    'ad.iata_code AS arrival_destination_code',
                                    'dd.iata_code AS departure_destination_code',
                                    'tpa.luggage_capacity AS luggage_capacity',
                                    'tpa.check_in_luggage AS check_in_luggage'
                                ])
                                ->join('airline_providers AS ap', 'tpa.airline_id', '=', 'ap.id')
                                ->join('airport_locations AS dd', 'tpa.departure_destination', '=', 'dd.id')
                                ->join('airport_locations AS ad', 'tpa.arrival_destination', '=', 'ad.id')
                                ->where('tpa.tour_package_id', '=', $bookingMaster->package_id)
                                ->orderBy('tpa.id')
                                ->get();
        $packageHotel = TourPackageHotel::where('tour_package_id', '=', $bookingMaster->package_id)->get();
        $vehicleTypes = VehicleType::all();
        $hotelRoomType = DB::table('h_room_types')->where('id','')->get();
        // create new array to store the hotel information
        $hotelInfo = array();
        $bTransferData = TourPackageTransfer::where('booking_master_id', '=', $bookingId)->get();
        foreach($packageHotel as $index => $hotel)
        {
            // fetch the hotel information from the hotel id
            $hotelMain = Hotel::find($hotel->hotel_id);

            $hotelInfo[$index] = [
                'id' => $hotel->hotel_id,
                'hotel_name' => $hotelMain->hotel_name,
                'hotel_address' => $hotelMain->address,
                'rating'=>$hotelMain->rating,
                'no_of_rooms'=>$bookingDetails->no_of_rooms,
                'check_in_date' => DB::table('booking_details')->where('booking_id', '=', $bookingId)->where('hotel_id','=', $hotel->hotel_id)->value('check_in_date'),
                'check_out_date' => DB::table('booking_details')->where('booking_id', '=', $bookingId)->where('hotel_id','=', $hotel->hotel_id)->value('check_out_date'),
                'rooms' => DB::table('h_room_types')->select('id','room_type_name')->whereIn('id', explode(',', $bookingDetails->room_type_id))->get(),
                'food' => DB::table('h_food_types')->select('id','food_type_name')->whereIn('id', explode(',', $bookingDetails->food_type_id))->get(),
                'view' => DB::table('h_view_types')->select('id','view_type_name')->whereIn('id', explode(',', $bookingDetails->room_view_id))->get(),
            ];

            // convert hotelInfo array to object collection
            

        }


        $pdf = Pdf::loadView('pages.pdf.voucher', array('bookingMaster' => $bookingMaster,'packageInfo'=>$packageInfo,'additionalPassengers'=>$additionalPassengers,'packageAirline'=>$packageAirline,'hotelInfo'=>$hotelInfo,'bookingDetails'=>$bookingDetails,'vehicleTypes'=>$vehicleTypes,'bTransferData'=>$bTransferData));
        return $pdf->download('voucher.pdf');
    }


    public function generateBookingVoucher($bookingId)
    {

        // collect all details related to booking
        $bookingMaster = BookingMaster::find($bookingId);
        $packageInfo = TourPackage::find($bookingMaster->package_id);
        $additionalPassengers = TravellerDetails::where('booking_id', '=', $bookingId)->get();
        $bookingDetails = BookingDetails::where('booking_id', '=', $bookingId)->first();
        $packageAirline = DB::table('tour_package_airlines AS tpa')
                                ->select([
                                    'tpa.airline_id AS airline_id',
                                    'ap.name AS airline_name',
                                    'ap.iata_code AS code',
                                    'tpa.flight_number AS flight_number',
                                    'tpa.departure_date_time AS departure_date_time',
                                    'tpa.arrival_date_time AS arrival_date_time',
                                    'dd.airport_name AS departure_destination_name',
                                    'dd.country AS departure_destination_country',
                                    'ad.airport_name AS arrival_destination_name',
                                    'ad.country AS arrival_destination_country',
                                    'ad.iata_code AS arrival_destination_code',
                                    'dd.iata_code AS departure_destination_code',
                                    'tpa.luggage_capacity AS luggage_capacity',
                                    'tpa.check_in_luggage AS check_in_luggage'
                                ])
                                ->join('airline_providers AS ap', 'tpa.airline_id', '=', 'ap.id')
                                ->join('airport_locations AS dd', 'tpa.departure_destination', '=', 'dd.id')
                                ->join('airport_locations AS ad', 'tpa.arrival_destination', '=', 'ad.id')
                                ->where('tpa.tour_package_id', '=', $bookingMaster->package_id)
                                ->orderBy('tpa.id')
                                ->get();
        $packageHotel = TourPackageHotel::where('tour_package_id', '=', $bookingMaster->package_id)->get();
        $vehicleTypes = VehicleType::all();
        $hotelRoomType = DB::table('h_room_types')->where('id','')->get();
        // create new array to store the hotel information
        $hotelInfo = array();
        $bTransferData = TourPackageTransfer::where('booking_master_id', '=', $bookingId)->get();
        foreach($packageHotel as $index => $hotel)
        {
            // fetch the hotel information from the hotel id
            $hotelMain = Hotel::find($hotel->hotel_id);

            $hotelInfo[$index] = [
                'id' => $hotel->hotel_id,
                'hotel_name' => $hotelMain->hotel_name,
                'hotel_address' => $hotelMain->address,
                'rating'=>$hotelMain->rating,
                'no_of_rooms'=>$bookingDetails->no_of_rooms,
                'check_in_date' => DB::table('booking_details')->where('booking_id', '=', $bookingId)->where('hotel_id','=', $hotel->hotel_id)->value('check_in_date'),
                'check_out_date' => DB::table('booking_details')->where('booking_id', '=', $bookingId)->where('hotel_id','=', $hotel->hotel_id)->value('check_out_date'),
                'rooms' => DB::table('h_room_types')->select('id','room_type_name')->whereIn('id', explode(',', $bookingDetails->room_type_id))->get(),
                'food' => DB::table('h_food_types')->select('id','food_type_name')->whereIn('id', explode(',', $bookingDetails->food_type_id))->get(),
                'view' => DB::table('h_view_types')->select('id','view_type_name')->whereIn('id', explode(',', $bookingDetails->room_view_id))->get(),
            ];

            // convert hotelInfo array to object collection
            

        }
        return view('pages.pdf.voucher',compact('bookingMaster','packageInfo','additionalPassengers','packageAirline','hotelInfo','bookingDetails','vehicleTypes','bTransferData'));

    }
    public function approveBooking($bookingId)
    {
        $booking = BookingMaster::find($bookingId);
        $booking->booking_status = 2;
        $booking->save();
        flash()
            ->option('position', 'top-right')
            ->option('timeout', 3000)
            ->addSuccess('Booking has been approved');
        // redirect to booking list page
        return redirect()->back();
    }
    public function rejectBooking($bookingId)
    {
        $booking = BookingMaster::find($bookingId);
        $booking->booking_status = 0;
        $booking->save();
        flash()
            ->option('position', 'top-right')
            ->option('timeout', 3000)
            ->addSuccess('Booking has been rejected');

        return redirect()->back();
    }

    // function to get the booking details
    public function getBookingDetails($bookingId)
    {
        $bookingBasicDetails = DB::table('booking_masters as bm')
                            ->select([
                                'bm.id as booking_id',
                                'bm.booking_date',
                                'bm.primary_traveller',
                                'bm.primary_traveller_contact_number',
                                'bm.primary_traveller_email',
                                'bm.total_passengers',
                                'bm.departure_date',
                                'bm.return_date',
                                'bm.booking_status as status',
                                'tp.package_name',
                                'tp.tour_start_date',
                                'tp.tour_end_date',
                                'tp.departure_destination',
                                'tp.arrival_destination',
                                'ap.name as airline_name',
                                'h.hotel_name',
                                'tp.total_slots',
                                's.name as staff_name'
                            ])
                            ->leftJoin('tour_packages as tp', 'bm.package_id', '=', 'tp.id')
                            ->join('tour_package_airlines as tpa', 'tp.id', '=', 'tpa.tour_package_id')
                            ->leftJoin('airline_providers as ap', 'tpa.airline_id', '=', 'ap.id')
                            ->leftJoin('tour_package_hotels as tph', 'tp.id', '=', 'tph.tour_package_id')
                            ->leftJoin('hotels as h', 'tph.hotel_id', '=', 'h.id')
                            ->leftJoin('users as s', 'bm.staff_id', '=', 's.id')
                            ->where('bm.id', '=', $bookingId)
                            ->first();
        // collect all details related to booking
        $bookingMaster = BookingMaster::find($bookingId);
        $packageInfo = TourPackage::find($bookingMaster->package_id);
        $additionalPassengers = TravellerDetails::where('booking_id', '=', $bookingId)->get();
        $bookingDetails = BookingDetails::where('booking_id', '=', $bookingId)->first();
        $packageAirline = DB::table('tour_package_airlines AS tpa')
                                ->select([
                                    'tpa.airline_id AS airline_id',
                                    'ap.name AS airline_name',
                                    'ap.iata_code AS code',
                                    'tpa.flight_number AS flight_number',
                                    'tpa.departure_date_time AS departure_date_time',
                                    'tpa.arrival_date_time AS arrival_date_time',
                                    'dd.airport_name AS departure_destination_name',
                                    'dd.country AS departure_destination_country',
                                    'ad.airport_name AS arrival_destination_name',
                                    'ad.country AS arrival_destination_country',
                                    'ad.iata_code AS arrival_destination_code',
                                    'dd.iata_code AS departure_destination_code',
                                    'tpa.luggage_capacity AS luggage_capacity',
                                    'tpa.check_in_luggage AS check_in_luggage'
                                ])
                                ->join('airline_providers AS ap', 'tpa.airline_id', '=', 'ap.id')
                                ->join('airport_locations AS dd', 'tpa.departure_destination', '=', 'dd.id')
                                ->join('airport_locations AS ad', 'tpa.arrival_destination', '=', 'ad.id')
                                ->where('tpa.tour_package_id', '=', $bookingMaster->package_id)
                                ->orderBy('tpa.id')
                                ->get();
        $packageHotel = TourPackageHotel::where('tour_package_id', '=', $bookingMaster->package_id)->get();
        $vehicleTypes = VehicleType::all();
        $hotelRoomType = DB::table('h_room_types')->where('id','')->get();
        // create new array to store the hotel information
        $hotelInfo = array();
        $bTransferData = TourPackageTransfer::where('booking_master_id', '=', $bookingId)->get();
        foreach($packageHotel as $index => $hotel)
        {
            // fetch the hotel information from the hotel id
            $hotelMain = Hotel::find($hotel->hotel_id);

            $hotelInfo[$index] = [
                'id' => $hotel->hotel_id,
                'hotel_name' => $hotelMain->hotel_name,
                'hotel_address' => $hotelMain->address,
                'rating'=>$hotelMain->rating,
                'no_of_rooms'=>$bookingDetails->no_of_rooms,
                'check_in_date' => DB::table('booking_details')->where('booking_id', '=', $bookingId)->where('hotel_id','=', $hotel->hotel_id)->value('check_in_date'),
                'check_out_date' => DB::table('booking_details')->where('booking_id', '=', $bookingId)->where('hotel_id','=', $hotel->hotel_id)->value('check_out_date'),
                'rooms' => DB::table('h_room_types')->select('id','room_type_name')->whereIn('id', explode(',', $bookingDetails->room_type_id))->get(),
                'food' => DB::table('h_food_types')->select('id','food_type_name')->whereIn('id', explode(',', $bookingDetails->food_type_id))->get(),
                'view' => DB::table('h_view_types')->select('id','view_type_name')->whereIn('id', explode(',', $bookingDetails->room_view_id))->get(),
            ];

            // convert hotelInfo array to object collection
            

        }
        return view('pages.booking.bookingDetails',compact('bookingBasicDetails','bookingMaster','packageInfo','additionalPassengers','packageAirline','hotelInfo','bookingDetails','vehicleTypes','bTransferData'));
        // get the booking details from the booking id
    
    }

}
