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
        Schema::table('tour_package_transfers', function (Blueprint $table) {
            //
            $table->integer('booking_master_id')->after('tour_package_id');
            $table->dropColumn('tour_package_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tour_package_transfers', function (Blueprint $table) {
            //
        });
    }
};
