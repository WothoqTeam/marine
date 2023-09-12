<?php

namespace Database\Seeders;

use App\Models\Specifications;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Specifications::updateOrCreate(
            ['id' => 1],[
            'name_ar' => 'غرف نوم',
            'name_en' => 'Bedroom',
        ]);
        Specifications::updateOrCreate(
            ['id' => 2],[
            'name_ar' => 'حمام',
            'name_en' => 'Bathroom',
        ]);
        Specifications::updateOrCreate(
            ['id' => 3],[
            'name_ar' => 'زائر',
            'name_en' => 'guests',
        ]);
    }
}
