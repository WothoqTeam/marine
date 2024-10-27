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
            $table->integer('canceled_by')->after('total')->nullable();
            $table->text('canceled_reason')->after('canceled_by')->nullable();
            $table->float('num_meters')->after('canceled_reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('marasi_reservations', function (Blueprint $table) {
            $table->dropColumn('canceled_by');
            $table->dropColumn('canceled_reason');
            $table->dropColumn('num_meters');
        });
    }
};
