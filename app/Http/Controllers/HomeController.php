<?php

namespace App\Http\Controllers;

use App\Models\BankDetails;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (view()->exists($request->path())) {
            return view($request->path());
        }
        return abort(404);
    }

    public function root()
    {
        
        $user = auth()->user();
        $tourPackages = DB::table('tour_packages as tp')
                        ->select(
                            'tp.package_name',
                            'tp.departure_destination',
                            'tpa.airline_id',
                            'ap.name as airline_name',
                            'tph.hotel_id',
                            'h.hotel_name',
                            DB::raw('COUNT(tp.id) as package_count')
                        )
                        ->join('tour_package_airlines as tpa', 'tp.id', '=', 'tpa.tour_package_id')
                        ->join('airline_providers as ap', 'tpa.airline_id', '=', 'ap.id')
                        ->leftjoin('tour_package_hotels as tph', 'tp.id', '=', 'tph.tour_package_id')
                        ->leftJoin('hotels as h', 'tph.hotel_id', '=', 'h.id')
                       ->where('tp.tour_start_date', '>=', now()->toDateString())
                        ->groupBy('tp.package_name', 'tp.departure_destination', 'tpa.airline_id', 'ap.name', 'tph.hotel_id', 'h.hotel_name')
                        ->orderBy('tp.departure_destination')
                        ->orderBy('tph.hotel_id')
                        ->orderBy('tpa.airline_id')
                        ->distinct('tp.id')
                        ->get();
               
        $latestBooking = DB::table('booking_masters as bm')
            ->select('bm.id as booking_id', 'bm.booking_date','bm.primary_traveller','bm.total_passengers', 'tp.tour_start_date', 'tp.tour_end_date', 'tp.departure_destination', 'tp.arrival_destination', 'ap.name as airline_name', 'h.hotel_name', 'tp.total_slots','s.name as staff_name')
            ->leftJoin('tour_packages as tp', 'bm.package_id', '=', 'tp.id')
            ->leftJoin('tour_package_airlines as tpa', 'tp.id', '=', 'tpa.tour_package_id')
            ->leftJoin('airline_providers as ap', 'tpa.airline_id', '=', 'ap.id')
            ->leftJoin('tour_package_hotels as tph', 'tp.id', '=', 'tph.tour_package_id')
            ->leftJoin('hotels as h', 'tph.hotel_id', '=', 'h.id')
            ->leftJoin('users as s', 'bm.staff_id', '=', 's.id')
            ->where('bm.booking_date', '<=', DB::raw('CURDATE()'))
            ->orderBy('bm.booking_date', 'asc')
            ->distinct('bm.id')
            ->limit(12);
        
        $stats = [
        // get some stats for the dashboard 
        'totalBookings' => $user->role_id === 4 ? DB::table('booking_masters')->where('staff_id',$user->id)->count() : DB::table('booking_masters')->count(),
        'totalBookingsMonth'=> $user->role_id === 4 ? DB::table('booking_masters')->where('staff_id',$user->id)->whereMonth('booking_date', '=', date('m'))->count() : DB::table('booking_masters')->whereMonth('booking_date', '=', date('m'))->count(),
        
        'totalPackages' => DB::table('tour_packages')->count(),
        'totalActivePackages' => DB::table('tour_packages')->where('tour_start_date', '>=', now()->toDateString())->count(),
        // total bookings in the current month
        'totalBookingsByMonth' => $user->role_id === 4 ? DB::table('booking_masters')->where('staff_id',$user->id)->whereMonth('booking_date', '=', date('m'))->count() : DB::table('booking_masters')->whereMonth('booking_date', '=', date('m'))->count(),
        'totalBookingsLastMonth'=> $user->role_id === 4 ? DB::table('booking_masters')->where('staff_id',$user->id)->whereMonth('booking_date', '=', date('m', strtotime('-1 month')))->count() : DB::table('booking_masters')->whereMonth('booking_date', '=', date('m', strtotime('-1 month')))->count(),
        // booking on hold
        'totalBookingsOnHold' => $user->role_id === 4 ? DB::table('booking_masters')->where('staff_id',$user->id)->where('booking_status', '=', '1')->count():DB::table('booking_masters')->where('booking_status', '=', '1')->count(),
        'totalRejectedBookings'=> $user->role_id === 4 ? DB::table('booking_masters')->where('staff_id',$user->id)->where('booking_status', '=', '0')->count():DB::table('booking_masters')->where('booking_status', '=', '0')->count(),
        ];

            // Check if the user's role is staff
     // Check if the user's role is staff
     if ($user->role_id === 4) {
        // Add a condition to fetch only the bookings made by the logged-in staff
        $latestBooking->where('bm.staff_id', '=', $user->id);
    }

    $latestBooking = $latestBooking->limit(12)->get();

        return view('index',compact('tourPackages', 'latestBooking','stats'));
    }
    

    public function getPackageByFilters()
    {
        $tourPackages = DB::table('tour_packages as tp')
            ->select('tp.package_name','tp.departure_destination', 'tpa.airline_id', 'ap.name as airline_name', 'tph.hotel_id', 'h.hotel_name', DB::raw('COUNT(tp.id) as package_count'))
            ->join('tour_package_airlines as tpa', 'tp.id', '=', 'tpa.tour_package_id')
            ->join('airline_providers as ap', 'tpa.airline_id', '=', 'ap.id')
            ->join('tour_package_hotels as tph', 'tp.id', '=', 'tph.tour_package_id')
            ->leftJoin('hotels as h', 'tph.hotel_id', '=', 'h.id')
            ->where('tp.tour_start_date', '>=', now()->toDateString())
            ->groupBy('tp.departure_destination', 'tph.hotel_id', 'ap.id',  'tpa.airline_id','tp.package_name')
            ->orderBy('tp.departure_destination')
            ->orderBy('tph.hotel_id')
            ->orderBy('tpa.airline_id')
            ->get();

        return $tourPackages;
    
    }

    /*Language Translation*/
    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }

    public function FormSubmit(Request $request)
    {
        return view('form-repeater');
    }

   
}
