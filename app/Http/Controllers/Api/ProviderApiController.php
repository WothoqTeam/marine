<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Responses\ListProviders;
use App\Models\Ratings;
use App\Models\Reservations;
use App\Models\User;
use Carbon\Carbon;
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

    public function statistics(){
        $yachts = $this->user->yachts->pluck('id');
        $reservations = Reservations::with('yacht','user')->whereIn('yacht_id',$yachts)->where('reservations_status','completed')->get();

        $firstDay = Carbon::now()->subMonth()->startOfMonth();
        $lastDay = Carbon::now()->subMonth()->endOfMonth();
        $statistics=[
            'total_income'=>$reservations->sum('total')??0,
            'last_income'=>$reservations->whereBetween('created_at',[$firstDay,$lastDay])->sum('total')??0,
            'total_reservations'=>$reservations->count()??0,
            'rate'=>Ratings::where('model_type',User::class)->where('model_id',$this->user->id)->avg('stars')??0,
        ];
        return $this->generateResponse(true,'Success',$statistics);
    }
}
