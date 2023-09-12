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
        Schema::create('yachts_specifications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('specification_id')->unsigned();
            $table->bigInteger('yacht_id')->unsigned();
            $table->timestamps();
            $table->foreign('yacht_id')->references('id')->on('yachts')->onDelete('cascade');
            $table->foreign('specification_id')->references('id')->on('specifications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yachts_specifications');
    }
};
