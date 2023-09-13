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
        Schema::create('tour_package_hotels', function (Blueprint $table) {
            $table->id();
            $table->integer('hotel_id');
            $table->integer('tour_package_id');
            $table->integer('room_type_id');
            $table->integer('food_type_id');
            $table->integer('room_view_id');
            $table->integer('available_rooms');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_package_hotels');
    }
};
