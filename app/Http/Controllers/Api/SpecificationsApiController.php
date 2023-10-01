<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Responses\Specifications\ListSpecifications;
use App\Models\Specifications;
use Illuminate\Http\Request;

class
SpecificationsApiController extends BaseApiController
{
    public function list(){
        $specifications=Specifications::where('status',true)->get();
        $specifications = $specifications->map(function (Specifications $specification) {
            return new ListSpecifications($specification,$this->language);
        })->values();
        return $this->generateResponse(true,'Success',$specifications);
    }
}
