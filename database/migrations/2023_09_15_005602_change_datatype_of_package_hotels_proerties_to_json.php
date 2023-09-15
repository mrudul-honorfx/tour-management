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
        Schema::table('tour_package_hotels', function (Blueprint $table) {
            //
            // Change the data type of 'room_type_id' column to JSONB
            $table->json('room_type_id')->change();

            // Change the data type of 'food_type_id' column to JSONB
            $table->json('food_type_id')->change();

            // Change the data type of 'room_view_id' column to JSONB
            $table->json('room_view_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tour_package_hotels', function (Blueprint $table) {
            //
            $table->integer('room_type_id')->change();
            $table->integer('food_type_id')->change();
            $table->integer('room_view_id')->change();
        });
    }
};
