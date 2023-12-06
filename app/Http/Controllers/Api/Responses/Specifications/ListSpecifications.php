<?php

namespace App\Http\Controllers\Api\Responses\Specifications;

use App\Http\Controllers\Api\Base\Interfaces\DataInterface;
use App\Models\Specifications;
use App\Models\User;

class ListSpecifications extends DataInterface
{
    public int $id;
    public string $name;
    public string $image;

    /**
     * @param Specifications $specification
     */

    public function __construct(Specifications $specification, string $language = 'ar')

    {
        $this->id = $specification->id;
        $this->name = $language == 'en' ? $specification->name_en : $specification->name_ar;
//        $this->image=$specification->getFirstMediaUrl('icon');
    }
}
