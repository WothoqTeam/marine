<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Responses\Reservations\ListProviderReservations;
use App\Http\Requests\Api\Reservations\Provider\PayMarasiReservationsRequest;
use App\Http\Requests\Api\Reservations\Provider\StoreMarasiReservationsRequest;
use App\Http\Requests\Api\Reservations\Provider\UpdateMarasiReservationsRequest;
use App\Models\Employee;
use App\Models\MarasiReservations;
use Illuminate\Http\Request;

class MarasiReservationsApiController extends BaseApiController
{
    public function List(Request $request){
        $user=auth('api')->user();
        $reservations = MarasiReservations::with('provider','marasi')->where('provider_id',$user->id);
        //Filter Status
        if (!empty($request->status)){ $reservations->where('reservations_status',$request->status); }
        //Filter By limit
        if (!empty($request->limit)){ $reservations->limit($request->limit); }
        //Filter By sort
        if ($request->sort_by=='desc'){ $reservations ->orderBy('id', 'DESC');}
        $reservations=$reservations->get();
        $reservations = $reservations->map(function (MarasiReservations $reservation) {
            return new ListProviderReservations($reservation,$this->language);
        })->values();
        return $this->generateResponse(true,'Success',$reservations);
    }

    public function store(StoreMarasiReservationsRequest $request){
        $user=auth('api')->user();
        $reservations=MarasiReservations::create([
            'provider_id'=>$user->id,
            'marasi_id'=>$request->marasi_id,
            'start_day'=>$request->start_day,
            'end_day'=>$request->end_day,
            'note'=>$request->note,
        ]);
        $data=[
            'title_en'=>'New Marasi Reservations #'.$reservations->id,
            'title_ar'=>'حجز مرسى جديد #'.$reservations->id,
            'body_en'=>'A New Marasi Reservations has been added #'.$reservations->id,
            'body_ar'=>'تم اضافة حجز مرسى جديد #'.$reservations->id,
        ];
        $this->sendNotifications(Employee::class,[$reservations->marasi->employee_id],$data);
        return $this->generateResponse(true,'Success');
    }

    public function update($id, UpdateMarasiReservationsRequest $request){
        $user=auth('api')->user();
        $reservations=MarasiReservations::where('provider_id',$user->id)->WhereIn('reservations_status',['pending','rejected'])->find($id);
        if($reservations){
            $reservations->update([
                'start_day'=>$request->start_day,
                'end_day'=>$request->end_day,
                'note'=>$request->note,
            ]);
            return $this->generateResponse(true,'Success');
        }else{
            return $this->generateResponse(false,"User Cannot Take This Action",[],410);
        }
    }

    public function cancel($id){
        $user=auth('api')->user();
        $reservations=MarasiReservations::where('provider_id',$user->id)->WhereIn('reservations_status',['pending','in progress'])->find($id);
        if($reservations){
            $reservations->update([
                'reservations_status'=>'canceled',
            ]);
            $data=[
                'title_en'=>'Marasi Reservations Cancelled #'.$reservations->id,
                'title_ar'=>'تم الغاء حجز المرسى #'.$reservations->id,
                'body_en'=>'Marasi Reservation num #'.$reservations->id.' has been Cancelled',
                'body_ar'=>'تم الغاء حجز المرسى رقم #'.$reservations->id,
            ];
            $this->sendNotifications(Employee::class,[$reservations->marasi->employee_id],$data);
            return $this->generateResponse(true,'Success');
        }else{
            return $this->generateResponse(false,"User Cannot Take This Action",[],410);
        }
    }

    public function Pay($id, PayMarasiReservationsRequest $request){
        $user=auth('api')->user();
        $reservations=MarasiReservations::where('provider_id',$user->id)->WhereIn('reservations_status',['in progress'])->find($id);
        if($reservations){
            $reservations->update([
                'payment_method'=>$request->payment_method,
                'sub_total'=>$request->sub_total,
                'vat'=>$request->vat,
                'service_fee'=>$request->service_fee,
                'total'=>$request->total
            ]);
            $data=[
                'title_en'=>'New Marasi Reservations #'.$reservations->id,
                'title_ar'=>'حجز مرسى جديد #'.$reservations->id,
                'body_en'=>'A New Marasi Reservations has been added #'.$reservations->id,
                'body_ar'=>'تم اضافة حجز مرسى جديد #'.$reservations->id,
            ];
            $this->sendNotifications(Employee::class,[1],$data);
            return $this->generateResponse(true,'Success');
        }else{
            return $this->generateResponse(false,"User Cannot Take This Action",[],410);
        }
    }
}
