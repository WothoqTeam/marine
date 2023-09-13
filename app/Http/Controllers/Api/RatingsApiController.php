<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\StoreRateRequest;
use App\Models\Employee;
use App\Models\Ratings;
use App\Models\User;
use App\Models\Yachts;
use Illuminate\Http\Request;

class RatingsApiController extends BaseApiController
{
    public function store(StoreRateRequest $request){
        $user=auth('api')->user();
        $model=$request->type;
        if ($model=='User') $model=User::class; elseif ($model=='Yachts') $model=Yachts::class; elseif ($model=='Employee') $model=Employee::class;
        $model_id=$request->type_id;
        $stars=$request->stars;
        $comment=$request->comment;

        Ratings::create([
            'model_type'=>$model,
            'model_id'=>$model_id,
            'added_by_type'=>User::class,
            'added_by_id'=>$user->id,
            'stars'=>$stars,
            'comments'=>$comment,
        ]);

        return $this->generateResponse(true,'Success');
    }
}
