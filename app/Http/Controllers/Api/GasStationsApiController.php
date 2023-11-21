<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Responses\GasStations\ListStations;
use App\Models\GasStations;
use Illuminate\Http\Request;

class GasStationsApiController extends BaseApiController
{
    public function list(Request $request){
        $marasi = GasStations::with('city','country')->orderBy('id','DESC')->where('status',true);
        //Filter By Name
        if (!empty($request->name)){ $marasi->where('name_en','LIKE', '%'.$request->name.'%')->orwhere('name_ar','LIKE', '%'.$request->name.'%'); }
        //Filter By limit
        if (!empty($request->limit)){ $marasi->limit($request->limit); }
        //Filter By sort
        if ($request->sort_by=='desc'){ $marasi ->orderBy('id', 'DESC');}
        elseif ($request->sort_by=='top'){}
        $marasi=$marasi->get();
        $marasi = $marasi->map(function (GasStations $row) {
            return new ListStations($row,$this->language);
        })->values();
        return $this->generateResponse(true,'Success',$marasi);
    }
}
