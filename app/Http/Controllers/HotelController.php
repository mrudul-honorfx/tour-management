<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelController extends Controller
{
    
    public function HotelRoomType()
    {
        return view('pages.hotel.room_type_list');
    }
}
