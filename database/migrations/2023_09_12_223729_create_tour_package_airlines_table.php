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
        Schema::create('tour_package_airlines', function (Blueprint $table) {
            $table->id();
            $table->integer('tour_package_id');
            $table->integer('airline_id');
            $table->string('flight_number');
            $table->dateTime('departure_date_time');
            $table->dateTime('arrival_date_time');
            $table->string('departure_destination');
            $table->string('arrival_destination');
            $table->integer('available_seats');
            $table->integer('luggage_capacity');
            $table->integer('check_in_luggage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_package_airlines');
    }
};
