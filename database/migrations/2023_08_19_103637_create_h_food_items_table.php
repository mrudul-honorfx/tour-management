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
        Schema::create('h_food_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('food_type_id')->unsigned();
            $table->foreign('food_type_id') ->references('id')->on('h_food_types');
         
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('category')->nullable()->comment('0 for Veg and 1 for Non-Veg');
            $table->timestamps();
            
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('h_food_items');
    }
};
