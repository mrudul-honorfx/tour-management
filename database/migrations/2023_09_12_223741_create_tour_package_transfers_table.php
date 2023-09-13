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
        Schema::create('tour_package_transfers', function (Blueprint $table) {
            $table->id();
            $table->integer('tour_package_id');
            $table->string('vehicle_type');
            $table->string('pickup_location');
            $table->dateTime('pickup_time');
            $table->string('drop_off_location');
            $table->dateTime('drop_off_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_package_transfers');
    }
};
