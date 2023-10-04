<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Responses\Marasi\ListMarasi;
use App\Models\Marasi;
use Illuminate\Http\Request;

class MarasiApiController extends BaseApiController
{
    public function list(Request $request){
        $marasi = Marasi::with('city','country','employee')->orderBy('id','DESC')->where('status',true);
        //Filter By Provider ID
        if (!empty($request->employee_id)){ $marasi->where('employee_id',$request->employee_id); }
        //Filter By Name
        if (!empty($request->name)){ $marasi->where('name_en','LIKE', '%'.$request->name.'%')->orwhere('name_ar','LIKE', '%'.$request->name.'%'); }
        //Filter By limit
        if (!empty($request->limit)){ $marasi->limit($request->limit); }
        //Filter By sort
        if ($request->sort_by=='desc'){ $marasi ->orderBy('id', 'DESC');}
        elseif ($request->sort_by=='top'){}
        $marasi=$marasi->get();
        $marasi = $marasi->map(function (Marasi $row) {
            return new ListMarasi($row,$this->language);
        })->values();
        return $this->generateResponse(true,'Success',$marasi);
    }
}
