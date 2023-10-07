<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class BookingExport implements FromCollection
{
    use Exportable;

    protected $hotelId;
    protected $startDate;
    protected $endDate;

    public function __construct($hotelId, $startDate, $endDate)
    {
        $this->hotelId = $hotelId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function query()
    {
        return DB::table('booking_masters as b')
            ->select(
                'b.id',
                'b.booking_date',
                'b.primary_traveller',
                'b.primary_traveller_contact_number',
                'b.booking_status',
                'bd.room_type_id',
                'hrt.room_type_name',
                'hvt.view_type_name',
                'hft.food_type_name',
                'bd.check_in_date',
                'bd.check_out_date',
                'bd.number_of_rooms'
            )
            ->leftJoin('booking_details as bd', 'b.id', '=', 'bd.booking_id')
            ->leftJoin('h_room_types as hrt', 'bd.room_type_id', '=', 'hrt.id')
            ->leftJoin('h_view_types as hvt', 'bd.room_view_id', '=', 'hvt.id')
            ->leftJoin('h_food_types as hft', 'bd.food_type_id', '=', 'hft.id')
            ->where('b.hotel_id', $this->hotelId)
            ->whereBetween('b.booking_date', [$this->startDate, $this->endDate])
            ->orderBy('b.booking_date');
    }
}
