<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Responses\ListYachts;
use App\Http\Controllers\Controller;
use App\Models\Yachts;
use Illuminate\Http\Request;

class YachtsApiController extends BaseApiController
{
    public function list(Request $request){
        $yachts = Yachts::with('city','country','provider','specifications')->where('status',true);
        //Filter By Provider ID
        if (!empty($request->provider_id)){ $yachts->where('provider_id',$request->provider_id); }
        //Filter By Name
        if (!empty($request->name)){ $yachts->where('name_en','LIKE', '%'.$request->name.'%')->orwhere('name_ar','LIKE', '%'.$request->name.'%'); }
        //Filter By limit
        if (!empty($request->limit)){ $yachts->limit($request->limit); }
        //Filter By sort
        if ($request->sort_by=='desc'){ $yachts ->orderBy('id', 'DESC');}
        elseif ($request->sort_by=='top'){}
        $yachts=$yachts->get();
        $yachts = $yachts->map(function (Yachts $yacht) {
            return new ListYachts($yacht,$this->language);
        })->values();
        return $this->generateResponse(true,'Success',$yachts);
    }
}
