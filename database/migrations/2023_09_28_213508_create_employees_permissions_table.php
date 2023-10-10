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
        Schema::create('employees_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('employees_id');
            $table->unsignedBigInteger('permission_id');

            //FOREIGN KEY
            $table->foreign('employees_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');

            //PRIMARY KEYS
            $table->primary(['employees_id','permission_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees_permissions');
    }
};
