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
        Schema::table('yachts', function (Blueprint $table) {
            $table->integer('num_guests')->after('address_ar')->nullable();
            $table->string('owner_name')->after('num_guests')->nullable();
            $table->string('id_num')->after('owner_name')->nullable();
            $table->string('license_num')->after('id_num')->nullable();
            $table->string('captain_name')->after('license_num')->nullable();
            $table->string('captain_id_num')->after('captain_name')->nullable();
            $table->string('captain_license_num')->after('captain_id_num')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('yachts', function (Blueprint $table) {
            $table->dropColumn('num_guests');
            $table->dropColumn('owner_name');
            $table->dropColumn('id_num');
            $table->dropColumn('license_num');
            $table->dropColumn('captain_name');
            $table->dropColumn('captain_id_num');
            $table->dropColumn('captain_license_num');
        });
    }
};
