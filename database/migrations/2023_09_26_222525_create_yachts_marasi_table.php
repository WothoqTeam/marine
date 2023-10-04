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
        Schema::create('yachts_marasi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('marasi_id')->unsigned();
            $table->bigInteger('yacht_id')->unsigned();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('yacht_id')->references('id')->on('yachts')->onDelete('cascade');
            $table->foreign('marasi_id')->references('id')->on('marasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yachts_marasis');
    }
};
