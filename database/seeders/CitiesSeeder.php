<?php

namespace Database\Seeders;

use App\Models\Cities;
use App\Models\Countries;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $country = Countries::updateOrCreate([
            "id" => 1
        ],[
            "name_en" => 'SAUDI ARABIA',
            "name_ar" => 'المملكة العربية السعودية',
            "currency_en" => 'Sar',
            "currency_ar" => 'رس',
            "iso_code" => 966,
            "status" => 1,
        ]);

        $saudiArabiaCities = array(
            "Riyadh" => "الرياض",
            "Jeddah" => "جدة",
            "Mecca" => "مكة",
            "Medina" => "المدينة",
            "Dammam" => "الدمام",
            "Taif" => "الطائف",
            "Khobar" => "الخبر",
            "Abha" => "أبها",
            "Tabuk" => "تبوك",
            "Buraidah" => "بريدة",
            "Najran" => "نجران",
            "Hail" => "حائل",
            "Khamis Mushait" => "خميس مشيط",
            "Al-Ahsa" => "الأحساء",
            "Yanbu" => "ينبع",
            "Al Jubail" => "الجبيل",
            "Al Qatif" => "القطيف",
            "Al Khobar" => "الخبر",
            "Dhahran" => "الظهران",
            "Al Hufuf" => "الهفوف"
        );
        $index=1;
        foreach ($saudiArabiaCities as $key => $value) {
            $city = Cities::updateOrCreate([
                'id'=>$index
            ], [
                "name_en" => $key,
                "name_ar" => $value,
                "status" => 1,
                "country_id" => $country->id
            ]);
            $index++;
        }
    }
}
