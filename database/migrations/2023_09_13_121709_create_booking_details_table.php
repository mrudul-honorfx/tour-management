<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*

        Booking Details Table contains the following fields
        1. Booking ID
        2. Hotel ID
        3. Room Type ID
        4. Food Type ID
        5. Room View ID
        6. Check In Date
        7. Check Out Date
        8. Number of Rooms
        9. Flight Class

        */
        Schema::create('booking_details', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id');
            $table->bigInteger('hotel_conformation_id')->nullable();
            $table->integer('hotel_id');
            $table->string('room_type_id');
            $table->string('food_type_id');
            $table->string('room_view_id');
            $table->dateTime('check_in_date');
            $table->dateTime('check_out_date');
            $table->integer('number_of_rooms');
            $table->string('flight_class');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_details');
    }
};
