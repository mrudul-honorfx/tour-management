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
        // get the name of hotel from the database
        $hotelName = DB::table('hotels')->where('id', $hotelId)->pluck('hotel_name')->first();
        // convert the hotel name to _ separated string
        $hotelName = str_replace(' ', '_', $hotelName);
        
        return Excel::download(new BookingExport($hotelId, $startDate, $endDate), $hotelName+'.xlsx');

    }
}
