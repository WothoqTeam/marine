<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use App\Notifications\SendPushNotification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Notification;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendNotifications(string $model,array $ids=[],array $data=[],string $send_to='all'){

        if ($send_to=='all' || $send_to=='fcm'){
            $arUsers = $model::where('language','en')->wherein('id',$ids)->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
            Notification::send(null,new SendPushNotification($data['title_ar'],$data['body_ar'],$arUsers));

            $enUsers = $model::where('language','ar')->wherein('id',$ids)->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
            Notification::send(null,new SendPushNotification($data['title_en'],$data['body_en'],$enUsers));
        }

        if ($send_to=='all' || $send_to=='db') {
            foreach ($ids as $id) {
                Notifications::create([
                    'user_id' => $id,
                    'title_en' => $data['title_en'],
                    'title_ar' => $data['title_ar'],
                    'body_en' => $data['body_en'],
                    'body_ar' => $data['body_ar'],
                    'type' => $model
                ]);
            }
        }

    }
}
