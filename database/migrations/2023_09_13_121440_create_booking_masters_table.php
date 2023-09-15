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
        /* Booking Master Table contains the following fields
        1. Booking ID
        2. Booking Date
        3. Primary Traveller
        3. Primary Traveller Contact Number
        4. Primary Traveller Email
        5. Total Passengers
        6. Departure Date
        7. Return Date
        */
        Schema::create('booking_masters', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id');
            $table->date('booking_date');
            $table->string('primary_traveller');
            $table->string('primary_traveller_contact_number');
            $table->string('primary_traveller_email');
            $table->integer('total_passengers');
            $table->date('departure_date');
            $table->date('return_date');
            $table->string('booking_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_masters');
    }
};
