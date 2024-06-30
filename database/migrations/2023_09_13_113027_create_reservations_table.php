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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('yacht_id');
            $table->dateTime('start_day')->nullable();
            $table->dateTime('end_day')->nullable();
            $table->text('note')->nullable();
            $table->string('payment_method')->nullable();
            $table->enum('reservations_status',['pending','in progress','rejected','canceled','completed'])->default('pending');
            $table->float('sub_total')->default(0);
            $table->float('vat')->default(0);
            $table->float('service_fee')->default(0);
            $table->float('total')->default(0);
            $table->timestamps();
            $table->softDeletes();
            //FOREIGN KEY
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('yacht_id')->references('id')->on('yachts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
