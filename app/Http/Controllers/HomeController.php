<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;

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

        return view('index',compact('tourPackages'));
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
