<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Responses\Reservations\ListProviderReservations;
use App\Http\Controllers\Api\Responses\Reservations\MarasiReservationsDetails;
use App\Http\Requests\Api\Reservations\Provider\PayMarasiReservationsRequest;
use App\Http\Requests\Api\Reservations\Provider\StoreMarasiReservationsRequest;
use App\Http\Requests\Api\Reservations\Provider\UpdateMarasiReservationsRequest;
use App\Models\Employee;
use App\Models\MarasiReservations;
use App\Models\Payments;
use App\Models\ReservationServices;
use Illuminate\Http\Request;
use URWay\Client;

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
        if (is_array($request->services) && count($request->services)>0){
            foreach ($request->services as $service){
                if ($service){
                    ReservationServices::create([
                        'reservations_id'=>$reservations->id,
                        'services_id'=>$service,
                    ]);
                }
            }
        }
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
            if (is_array($request->services) && count($request->services)>0){
                ReservationServices::where('reservations_id',$id)->delete();
                foreach ($request->services as $service){
                    if ($service){
                        ReservationServices::create([
                            'reservations_id'=>$id,
                            'services_id'=>$service,
                        ]);
                    }
                }
            }
            return $this->generateResponse(true,'Success');
        }else{
            return $this->generateResponse(false,"User Cannot Take This Action",[],410);
        }
    }

    public function cancel($id,Request $request){
        $user=auth('api')->user();
        $reservations=MarasiReservations::where('provider_id',$user->id)->WhereIn('reservations_status',['pending','in progress'])->find($id);
        if($reservations){
            $reservations->update([
                'reservations_status'=>'canceled',
                'canceled_by'=> $user->id,
                'canceled_reason'=> $request->canceled_reason
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
                'payment_status'=>false,
                'sub_total'=>$request->sub_total,
                'vat'=>$request->vat,
                'service_fee'=>$request->service_fee,
                'total'=>$request->total
            ]);
            if ($request->payment_method=='credit'){
                $client = new Client();
                $client->setTrackId($reservations->id)
                    ->setCustomerEmail($reservations->provider->email)
                    ->setCustomerIp($request->ip())
                    ->setCurrency('SAR')
                    ->setCountry('SA')
                    ->setAmount($request->total)
                    ->setRedirectUrl(Url('api/provider/marasi/reservation/status'));
                $result = $client->pay();
                if ($result->payid && $result->targetUrl) {
                    $redirect_url = $result->getPaymentUrl();
                    $data = [
                        'purchase_id' => $reservations->id,
                        'payment_link' => $redirect_url
                    ];
                    return $this->generateResponse(true, 'Purchase Placed Successfully', $data);
                }else{
                    return $this->generateResponse(false, 'Payment Failed');
                }
            }else{
                $data = [
                    'purchase_id' => $reservations->id,
                    'payment_link' => null
                ];
                return $this->generateResponse(true, 'Purchase Placed Successfully', $data);
            }
        }else{
            return $this->generateResponse(false,"User Cannot Take This Action",[],410);
        }
    }

    public function UrwayPaymentStatus(Request $request){
        $check=Payments::where('reservation_id',$request->TrackId)->where('reservation_type' , MarasiReservations::class,)->first();
        if ($check){
            return $this->generateResponse(false,'Payment Already Done');
        }
        $client = new Client();
        $client->setTrackId($request->TrackId);
        $client->setAmount($request->amount);
        $client->setCurrency('SAR');
        $body = $client->find($request->TranId);

        if($body->isSuccess()){
            Payments::create([
                'reservation_id' => $request->TrackId,
                'reservation_type' => MarasiReservations::class,
                'response' => (array) $body,
                'status'=> true,
            ]);

            $reservations=MarasiReservations::find($request->TrackId);
            $reservations->update([
                'payment_status'=>true,
            ]);
            $data=[
                'title_en'=>'New Marasi Reservations #'.$reservations->id,
                'title_ar'=>'حجز مرسى جديد #'.$reservations->id,
                'body_en'=>'A New Marasi Reservations has been added #'.$reservations->id,
                'body_ar'=>'تم اضافة حجز مرسى جديد #'.$reservations->id,
            ];
            $this->sendNotifications(Employee::class,[1,$reservations->marasi->employee_id],$data);
            return $this->generateResponse(true,'Payment Successfully');
        }else{
            Payments::create([
                'reservation_id' => $request->TrackId,
                'reservation_type' => MarasiReservations::class,
                'response' => (array) $body,
                'status'=> false
            ]);
            return $this->generateResponse(false,'Payment Failure');
        }
    }

    public function details($id){
        $user=auth('api')->user();
        $reservation = MarasiReservations::with('provider','marasi')->where('provider_id',$user->id)->find($id);
        if ($reservation){
            $details=new MarasiReservationsDetails($reservation,$this->language,$this->user);
            return $this->generateResponse(true,'Success',$details);
        }else{
            return $this->generateResponse(false,"User Cannot Take This Action",[],410);
        }
    }
}
