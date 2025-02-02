<?php

namespace App\Http\Controllers\Api\Responses\GasStations;

use App\Http\Controllers\Api\Base\Interfaces\DataInterface;
use App\Models\GasStations;

class ListStations extends DataInterface
{
    public int $id;
    public string $name;
    public string|null $address;
    public string|null $description;
    public bool $status;
    public float|null $longitude;
    public float|null $latitude;
    public string $language;
    public array $image;

    /**
     * @param GasStations $gasStations
     * @param string $language
     */

    public function __construct(GasStations $gasStations, string $language = 'ar')
    {
        $images = array();
        $medias = $gasStations->getMedia('cover');
        foreach ($medias as $image) {
            $images[] = $image->getFullUrl();
        }
        $this->id = $gasStations->id;
        $this->name = $language == 'en' ? $gasStations->name_en : $gasStations->name_ar;
        $this->address = $language == 'en' ? $gasStations->address_en : $gasStations->address_ar;
        $this->description = $language == 'en' ? $gasStations->description_en : $gasStations->description_ar;
        $this->status = $gasStations->status;
        $this->longitude = $gasStations->longitude;
        $this->latitude = $gasStations->latitude;
        $this->image = $images;
    }
}
