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
            $table->dropColumn('drop_off_time');
            // add nullable column for assistant and his contact number
            $table->string('assistant_name')->nullable();
            $table->string('assistant_contact_number')->nullable();
            
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
