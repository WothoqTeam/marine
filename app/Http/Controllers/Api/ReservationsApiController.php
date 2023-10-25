<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Responses\Reservations\ListUserReservations;
use App\Http\Controllers\Api\Responses\Reservations\ReservationDetails;
use App\Http\Requests\Api\Reservations\PayReservationsRequest;
use App\Http\Requests\Api\Reservations\ReservationsRequest;
use App\Http\Requests\Api\Reservations\StoreReservationsRequest;
use App\Http\Requests\Api\Reservations\UpdateReservationsRequest;
use App\Models\Employee;
use App\Models\Reservations;
use App\Models\User;
use App\Models\Yachts;
use Illuminate\Http\Request;

class ReservationsApiController extends BaseApiController
{
    public function userList(Request $request){
        $user=auth('api')->user();
        $reservations = Reservations::with('yacht','user')->where('user_id',$user->id);
        //Filter By Provider ID
        if (!empty($request->status)){ $reservations->where('reservations_status',$request->status); }
        //Filter By limit
        if (!empty($request->limit)){ $reservations->limit($request->limit); }
        //Filter By sort
        if ($request->sort_by=='desc'){ $reservations ->orderBy('id', 'DESC');}
        $reservations=$reservations->get();
        $reservations = $reservations->map(function (Reservations $reservation) {
            return new ListUserReservations($reservation,$this->language);
        })->values();
        return $this->generateResponse(true,'Success',$reservations);
    }

    public function details($id){
        $user=auth('api')->user();
        $reservation = Reservations::with('yacht','user')->where('user_id',$user->id)->find($id);
        if ($reservation){
            $details=new ReservationDetails($reservation,$this->language,$this->user);
            return $this->generateResponse(true,'Success',$details);
        }else{
            return $this->generateResponse(false,"User Cannot Take This Action",[],410);
        }
    }

    public function store(StoreReservationsRequest $request){
        $user=auth('api')->user();
        $reservations=Reservations::create([
            'user_id'=>$user->id,
            'yacht_id'=>$request->yacht_id,
            'start_day'=>$request->start_day,
            'end_day'=>$request->end_day,
            'note'=>$request->note,
        ]);
        $data=[
            'title_en'=>'New reservations #'.$reservations->id,
            'title_ar'=>'حجز جديد #'.$reservations->id,
            'body_en'=>'A new reservations has been added #'.$reservations->id,
            'body_ar'=>'تم اضافة حجز جديد #'.$reservations->id,
        ];
        $this->sendNotifications(User::class,[$reservations->yacht->provider_id],$data);
        return $this->generateResponse(true,'Success');
    }

    public function update($id,UpdateReservationsRequest $request){
        $user=auth('api')->user();
        $reservations=Reservations::where('user_id',$user->id)->WhereIn('reservations_status',['pending','rejected'])->find($id);
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
        $reservations=Reservations::where('user_id',$user->id)->WhereIn('reservations_status',['pending','in progress'])->find($id);
        if($reservations){
            $reservations->update([
                'reservations_status'=>'canceled',
            ]);
            $data=[
                'title_en'=>'Reservations Cancelled #'.$reservations->id,
                'title_ar'=>'تم الغاء الحجز #'.$reservations->id,
                'body_en'=>'Reservation num #'.$reservations->id.' has been Cancelled',
                'body_ar'=>'تم الغاء الحجز رقم #'.$reservations->id,
            ];
            $this->sendNotifications(User::class,[$reservations->yacht->provider_id],$data);
            return $this->generateResponse(true,'Success');
        }else{
            return $this->generateResponse(false,"User Cannot Take This Action",[],410);
        }
    }

    public function Pay($id,PayReservationsRequest $request){
        $user=auth('api')->user();
        $reservations=Reservations::where('user_id',$user->id)->WhereIn('reservations_status',['in progress'])->find($id);
        if($reservations){
            $reservations->update([
                'payment_method'=>$request->payment_method,
                'sub_total'=>$request->sub_total,
                'vat'=>$request->vat,
                'service_fee'=>$request->service_fee,
                'total'=>$request->total
            ]);
            $data=[
                'title_en'=>'New reservations #'.$reservations->id,
                'title_ar'=>'حجز جديد #'.$reservations->id,
                'body_en'=>'A new reservations has been added #'.$reservations->id,
                'body_ar'=>'تم اضافة حجز جديد #'.$reservations->id,
            ];
            $this->sendNotifications(Employee::class,[1],$data);
            return $this->generateResponse(true,'Success');
        }else{
            return $this->generateResponse(false,"User Cannot Take This Action",[],410);
        }
    }

    public function providerList(Request $request){
        $yachts = $this->user->yachts->pluck('id');
        $reservations = Reservations::with('yacht','user')->whereIn('yacht_id',$yachts);
        //Filter By Provider ID
        if (!empty($request->status)){ $reservations->where('reservations_status',$request->status); }
        //Filter By limit
        if (!empty($request->limit)){ $reservations->limit($request->limit); }
        //Filter By sort
        if ($request->sort_by=='desc'){ $reservations ->orderBy('id', 'DESC');}
        $reservations=$reservations->get();
        $reservations = $reservations->map(function (Reservations $reservation) {
            return new ListUserReservations($reservation,$this->language);
        })->values();
        return $this->generateResponse(true,'Success',$reservations);
    }

    public function providerRequests(ReservationsRequest $request){
        $id=$request->reservation_id;
        $yacht_id=$request->yacht_id;
        $status=$request->status;

        $checkYacht=Yachts::where('provider_id',$this->user->id)->find($yacht_id);
        $reservations=Reservations::WhereIn('reservations_status',['pending'])->find($id);
        if($reservations && $checkYacht){
            $reservations->update([
                'reservations_status'=>$status,
            ]);
            if($status=='in progress'){
                $statusNameAr='الموافقه على';
                $statusNameEn=$status;
            }else{
                $statusNameAr='رفض';
                $statusNameEn=$status;
            }
            $data=[
                'title_en'=>'Reservations '.$statusNameEn.' #'.$reservations->id,
                'title_ar'=>'تم '.$statusNameAr.' الحجز #'.$reservations->id,
                'body_en'=>'Reservation num #'.$reservations->id.' has been '.$statusNameEn,
                'body_ar'=>'تم '.$statusNameAr.' الحجز رقم #'.$reservations->id,
            ];
            $this->sendNotifications(User::class,[$reservations->user_id],$data);
            return $this->generateResponse(true,'Success');
        }else{
            return $this->generateResponse(false,"User Cannot Take This Action",[],410);
        }
    }

}
