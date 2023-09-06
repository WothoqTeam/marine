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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->enum('is_active', [0, 1, 2, 3])->default(1)->comment("0 => not active, 1 => active, 2 => suspended , 3 => terminated");
            $table->tinyInteger('role_id');
            $table->enum('type', ['dash', 'delivery']);
            $table->text('token')->nullable();
            $table->text('fcm_token')->nullable();
            $table->enum('language', ['en', 'ar'])->default('ar');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
