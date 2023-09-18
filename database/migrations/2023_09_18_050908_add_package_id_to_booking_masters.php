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
        Schema::table('booking_masters', function (Blueprint $table) {
            
            $table->unsignedBigInteger('package_id')->nullable();
            //foreign_key
            $table->foreign('package_id')->references('id')->on('tour_packages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking_masters', function (Blueprint $table) {
            //
        });
    }
};
