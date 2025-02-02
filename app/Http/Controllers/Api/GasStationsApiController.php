<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Responses\GasStations\ListStations;
use App\Models\GasStations;
use Illuminate\Http\Request;

class GasStationsApiController extends BaseApiController
{
    public function list(Request $request){
        $stations = GasStations::with('city','country')->orderBy('id','DESC')->where('status',true);
        //Filter By Name
        if (!empty($request->name)){ $stations->where('name_en','LIKE', '%'.$request->name.'%')->orwhere('name_ar','LIKE', '%'.$request->name.'%'); }
        //Filter By Country ID
        if (!empty($request->country_id)){ $stations->where('country_id',$request->country_id); }
        //Filter By City ID
        if (!empty($request->city_id)){ $stations->where('city_id',$request->city_id); }
        //Filter By limit
        if (!empty($request->limit)){ $stations->limit($request->limit); }
        //Filter By sort
        if ($request->sort_by=='desc'){ $stations ->orderBy('id', 'DESC');}
        elseif ($request->sort_by=='top'){}
        $stations=$stations->get();
        $stations = $stations->map(function (GasStations $row) {
            return new ListStations($row,$this->language);
        })->values();
        return $this->generateResponse(true,'Success',$stations);
    }
}
