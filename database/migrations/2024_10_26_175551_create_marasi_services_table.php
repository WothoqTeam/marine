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
        Schema::create('marasi_services', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('marasi_id')->unsigned();
            $table->bigInteger('services_id')->unsigned();
            $table->timestamps();
            $table->foreign('marasi_id')->references('id')->on('marasi')->onDelete('cascade');
            $table->foreign('services_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marasi_services');
    }
};
