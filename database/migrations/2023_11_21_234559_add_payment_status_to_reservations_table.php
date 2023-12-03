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
        Schema::table('marasi_reservations', function (Blueprint $table) {
            $table->boolean('payment_status')->after('payment_method')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('marasi_reservations', function (Blueprint $table) {
            $table->dropColumn('payment_status');
        });
    }
};
