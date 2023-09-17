<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::updateOrCreate(
            ['id' => 1],[
            'name_ar' => 'يونافيد مارين',
            'name_en' => 'Unified Marine',
            'vat' => '3',
            'service_fee' => '2',
        ]);
    }
}
