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
        //
        Schema::table('traveller_details', function (Blueprint $table) {
             // Change the data type of the 'agecat' column back to 'string'
             $table->enum('agecat', ['adult', 'child', 'infant'])->default('adult')->after('gender');;
             $table->dropColumn('gender');
        });
        

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('traveller_details', function (Blueprint $table) {
            // Change the data type of the 'agecat' column back to 'string'
            $table->enum('agecat', ['adult', 'child', 'infant'])->default('adult')->after('gender');;
            $table->dropColumn('gender');
        });
    }
};
