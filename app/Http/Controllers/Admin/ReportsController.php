<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarasiReservations;
use App\Models\Reservations;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function create()
    {
        return view('admin.Reports.reservations');
    }

    public function search(Request $request)
    {
        $totalReservationsAmount=0;
        $totalPlatformRatio=0;
        $ratio=settings()->platform_ratio;
        if ($request->user_type=='1'){
            $totalReservationsAmount=MarasiReservations::whereBetween('start_day', [$request->startDate, $request->endDate])->sum('total');
            $totalPlatformRatio=($totalReservationsAmount*$ratio)/100;
        }elseif ($request->user_type=='2'){
            $totalReservationsAmount=Reservations::whereBetween('start_day', [$request->startDate, $request->endDate]);
            if (!empty($request->status_name)){
                $totalReservationsAmount=$totalReservationsAmount->where('reservations_status',$request->status_name);
            }
            $totalReservationsAmount=$totalReservationsAmount->sum('total');
            $totalPlatformRatio=($totalReservationsAmount*$ratio)/100;
        }
        $data=['totalReservationsAmount'=>$totalReservationsAmount,'totalPlatformRatio'=>$totalPlatformRatio];
        return $data;
    }
}
