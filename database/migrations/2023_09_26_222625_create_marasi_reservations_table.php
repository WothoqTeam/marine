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
        Schema::create('marasi_reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_id');
            $table->unsignedBigInteger('marasi_id');
            $table->dateTime('start_day');
            $table->dateTime('end_day');
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
            $table->foreign('provider_id')->references('id')->on('users');
            $table->foreign('marasi_id')->references('id')->on('marasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marasi_reservations');
    }
};
