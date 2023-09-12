<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Responses\ListProviders;
use App\Models\User;
use Illuminate\Http\Request;

class ProviderApiController extends BaseApiController
{
    public function list(Request $request){
        $providers = User::whereHas('role_type',function ($q) use ($request){
            $q->where('role_id',2);
        })->where('users.is_active','1');
        if (!empty($request->name)){ $providers->where('users.name','LIKE', '%'.$request->name.'%'); }
        if (!empty($request->limit)){ $providers->limit($request->limit); }
        if ($request->sort_by=='desc'){ $providers ->orderBy('users.id', 'DESC');}
        elseif ($request->sort_by=='top'){}
        $providers=$providers->get();
        $providers = $providers->map(function (User $user) {
            return new ListProviders($user);
        })->values();
        return $this->generateResponse(true,'Success',$providers);
    }
}
