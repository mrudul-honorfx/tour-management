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
        Schema::create('h_food_mappings', function (Blueprint $table) {
            $table->id();



            $table->bigInteger('hotel_id')->unsigned();
            $table->foreign('hotel_id') ->references('id')->on('hotels');

            $table->bigInteger('food_type_id')->unsigned();
            $table->foreign('food_type_id') ->references('id')->on('h_food_types');

            $table->bigInteger('food_items_id')->unsigned();
            $table->foreign('food_items_id') ->references('id')->on('h_food_items');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('h_food_mappings');
    }
};
