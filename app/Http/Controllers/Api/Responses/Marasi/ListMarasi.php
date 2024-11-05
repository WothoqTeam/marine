<?php

namespace App\Http\Controllers\Api\Responses\Marasi;

use App\Http\Controllers\Api\Base\Interfaces\DataInterface;
use App\Models\Marasi;
use App\Models\MarasiReservations;
use App\Models\Ratings;

class ListMarasi extends DataInterface
{
    public int $id;
    public string $name;
    public string $profile;
    public float $price;
    public float $is_discount;
    public float $discount_value;
    public string|null $address;
    public string|null $description;
    public bool $status;
    public float|null $longitude;
    public float|null $latitude;
    public string $language;
    public array $image;
    public int $reservations;
    public float $rate;
     public object|null $services;
    public array|null $employee;

    /**
     * @param Marasi $marasi
     * @param string $language
     */

    public function __construct(Marasi $marasi, string $language = 'ar')
    {
        $images = array();
        $medias = $marasi->getMedia('cover');
        foreach ($medias as $image) {
            $images[] = $image->getFullUrl();
        }
        $this->id = $marasi->id;
        $this->name = $language == 'en' ? $marasi->name_en : $marasi->name_ar;
        $this->profile=$marasi->getFirstMediaUrl('profile','thumb');
        $this->price = $marasi->price;
        $this->is_discount = $marasi->is_discount;
        $this->discount_value = $marasi->discount_value;
        $this->address = $language == 'en' ? $marasi->address_en : $marasi->address_ar;
        $this->description = $language == 'en' ? $marasi->description_en : $marasi->description_ar;
        $this->status=$marasi->status;
        $this->longitude=$marasi->longitude;
        $this->latitude=$marasi->latitude;
        $this->image = $images;
        $this->reservations = MarasiReservations::where('marasi_id',$marasi->id)->count();
        $this->rate = number_format(Ratings::where('model_type',Marasi::class)->where('model_id',$marasi->id)->avg('stars'),1);
        $this->services = $marasi->services;
        $this->employee = [
            'id' => $marasi->employee->id,
            'name' => $language == 'en' ? $marasi->employee->name_en : $marasi->employee->name_ar,
            'image' => $marasi->employee->image,
        ];
    }
}
