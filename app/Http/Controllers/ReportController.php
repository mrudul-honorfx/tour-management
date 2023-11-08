<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\BookingExport;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    public function viewHotelReport()
    {
        // get the list of hotels and pass it to the view
        $hotelList = DB::table('hotels')->select('id', 'hotel_name')->get();
        return view('pages.reports.hotelReport',compact('hotelList'));
    }


    //generate a report/consolidated sheet for the selected hotel and date range and download it as a csv file
    public function generateHotelReport(Request $request)
    {
        // get the hotel id and the dates from the request
        // get the list of all the bookings for the hotel for the given date range with the traveller data and the preferences  included
        // generate the csv file with the data
        // download the file

        $hotelId = $request->hotel_id;
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $results = DB::table('tour_package_hotels as tph')
            ->leftJoin('tour_packages as tpk', 'tpk.id', '=', 'tph.tour_package_id')
            ->leftJoin('booking_masters as bm', 'bm.package_id', '=', 'tph.tour_package_id')
            ->select('tph.tour_package_id', 'tpk.package_name', 'tpk.package_name_ar', 'tpk.arrival_destination', 'tpk.total_slots', 'bm.id as booking_id',
            'tpk.arrival_destination', 'bm.booking_date', 'bm.primary_traveller', 'bm.primary_traveller_contact_number', 'bm.total_passengers', 
            'bm.booking_status', 'tph.food_type_id', 'tph.room_view_id', 'tph.room_type_id')
            ->where('tph.hotel_id', $request->hotel_id)
            ->where('tpk.tour_start_date', '>=', $request->start_date)
            ->where('tpk.tour_end_date', '>=', $request->end_date)
            ->get();

foreach ($results as $result) {
    $roomTypeIds = json_decode($result->room_type_id, true);
    $food_type_ids= json_decode($result->food_type_id, true);
    $room_view_ids = json_decode($result->room_type_id, true);

    $roomTypes = DB::table('h_room_types')
                    ->select('room_type_code','room_type_name')
                    ->whereIn('id', $roomTypeIds)
                    ->get();
    $foodTypes =  DB::table('h_food_types')
                    ->select('food_type_name','description')
                    ->whereIn('id', $food_type_ids)
                    ->get(); 
    $viewTypes =  DB::table('h_view_types')
                    ->select('view_type_name','description')
                    ->whereIn('id', $room_view_ids)
                    ->get();                              
    $bookingId = $result->booking_id;

    $PassangerDetails =  DB::table('traveller_details as td')
                    ->select('td.*')
                    ->where('booking_id', $bookingId)
                    ->get(); 
    // Add room_types array to the result object
    $result->room_types = $roomTypes;
    $result->food_types = $foodTypes;
    $result->view_types = $viewTypes;
    $result->passanger_details = $PassangerDetails;

}
dd($results);
        // get the name of hotel from the database
        $hotelName = DB::table('hotels')->where('id', $hotelId)->pluck('hotel_name')->first();
        // convert the hotel name to _ separated string
        $hotelName = str_replace(' ', '_', $hotelName);
        
        return Excel::download(new BookingExport($hotelId, $startDate, $endDate), $hotelName+'.xlsx');

    }
}
