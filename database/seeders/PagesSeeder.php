<?php

namespace Database\Seeders;

use App\Models\Pages;
use App\Models\Specifications;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pages::updateOrCreate(
            ['id' => 1],[
            'name_en'=>'Privacy Policy',
            'name_ar'=>'سياسة الخصوصية',
            'content_en'=>'test',
            'content_ar'=>'تجريبي',
        ]);
        Pages::updateOrCreate(
            ['id' => 2],[
            'name_en' => 'Terms & Conditions',
            'name_ar'=>'الشروط و الاحكام',
            'content_en'=>'test',
            'content_ar'=>'تجريبي',
        ]);
    }
}
