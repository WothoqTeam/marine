<?php

namespace App\Http\Controllers\Api\Responses;

use App\Http\Controllers\Api\Base\Interfaces\DataInterface;
use App\Models\AdvBanners;

class ListBanners extends DataInterface
{
    public int $id;
//    public string $name;
//    public string $content;
    public string $image;

    /**
     * @param AdvBanners $banner
     * @param string $language
     */

    public function __construct(AdvBanners $banner, string $language)

    {
        $this->id = $banner->id;
        $this->image=$banner->getFirstMediaUrl('cover','thumb');
    }
}
