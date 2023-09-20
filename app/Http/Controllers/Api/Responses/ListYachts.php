<?php

namespace App\Http\Controllers\Api\Responses;

use App\Http\Controllers\Api\Base\Interfaces\DataInterface;
use App\Models\Ratings;
use App\Models\Reservations;
use App\Models\Yachts;

class ListYachts extends DataInterface
{
    public int $id;
    public string $name;
    public float $price;
    public float $is_discount;
    public float $discount_value;
    public string|null $address;
    public string|null $description;
    public string|null $add_info;
    public string|null $booking_info;
    public bool $status;
    public string $language;
    public array $image;
    public int $reservations;
    public float $rate;
    public array|null $provider;
    public object|null $specifications;

    /**
     * @param Yachts $yacht
     * @param string $language
     */

    public function __construct(Yachts $yacht, string $language = 'ar')
    {
        $images = array();
        $medias = $yacht->getMedia('cover');
        foreach ($medias as $image) {
            $images[] = $image->getFullUrl();
        }
        $this->id = $yacht->id;
        $this->name = $language == 'en' ? $yacht->name_en : $yacht->name_ar;
        $this->price = $yacht->price;
        $this->is_discount = $yacht->is_discount;
        $this->discount_value = $yacht->discount_value;
        $this->address = $language == 'en' ? $yacht->address_en : $yacht->address_ar;
        $this->description = $language == 'en' ? $yacht->description_en : $yacht->description_ar;
        $this->add_info = $language == 'en' ? $yacht->add_info_en : $yacht->add_info_ar;
        $this->booking_info = $language == 'en' ? $yacht->booking_info_en : $yacht->booking_info_ar;
        $this->status=$yacht->status;
        $this->image = $images;
        $this->reservations = Reservations::where('yacht_id',$yacht->id)->count();
        $this->rate = number_format(Ratings::where('model_type',Yachts::class)->where('model_id',$yacht->id)->avg('stars'),1);
        $this->provider = [
            'id' => $yacht->provider->id,
            'name' => $yacht->provider->name,
            'image' => $yacht->provider->image,
        ];
        $this->specifications = $yacht->specifications;
    }
}
