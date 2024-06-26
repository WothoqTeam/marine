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
        Schema::create('service_types', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->boolean('status')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });

        \App\Models\ServiceTypes::insert([
                ['name_en'=>'yacht','name_ar'=>'يخت'],
                ['name_en'=>'boat','name_ar'=>'قارب'],
                ['name_en'=>'jet-ski','name_ar'=>'جت سكي']
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_types');
    }
};
