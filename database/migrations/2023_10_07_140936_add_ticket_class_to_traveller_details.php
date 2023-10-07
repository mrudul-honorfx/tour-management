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
        Schema::table('traveller_details', function (Blueprint $table) {
            // add columns ticket_class after agecat with datat type string
            $table->string('ticket_class')->after('agecat')->default('economy');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('traveller_details', function (Blueprint $table) {
            //
        });
    }
};
