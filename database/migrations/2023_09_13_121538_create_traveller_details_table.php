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
        // The Traveller Details Table contains the following fields
        // 1. Traveller ID
        // 2. Booking ID
        // 3. First Name
        // 4. Last Name
        // 5. Gender
        // 6.ticket_number
        Schema::create('traveller_details', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->string('ticket_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traveller_details');
    }
};
