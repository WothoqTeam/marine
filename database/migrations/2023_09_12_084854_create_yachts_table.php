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
        Schema::create('yachts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_id');
            $table->string('name_en');
            $table->string('name_ar');
            $table->string('description_en')->nullable();
            $table->string('description_ar')->nullable();
            $table->string('add_info_en')->nullable();
            $table->string('add_info_ar')->nullable();
            $table->string('booking_info_en')->nullable();
            $table->string('booking_info_ar')->nullable();
            $table->string('address_en')->nullable();
            $table->string('address_ar')->nullable();
            $table->float('price');
            $table->boolean('is_discount')->default(false);
            $table->float('discount_value')->default(0);
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->boolean('status')->default(true);
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->timestamps();
            $table->softDeletes();

            //FOREIGN KEY
            $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yachts');
    }
};
