<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Managers;
use App\Models\Notifications;
use App\Notifications\SendPushNotification;
use Illuminate\Support\Facades\App;
use Notification;

class BaseApiController extends Controller
{
    protected $language;
    public function __construct()
    {
        $this->language = strtolower(request()->header('Language', 'ar'));
        App::setLocale($this->language);
    }

    protected function generateResponse(bool $isSuccess = true, string $message = '',$data = [], $statusCode = 200, array $headers = [])
    {
        $response = [
            'success' => $isSuccess,
            'message' => trans('lang.'.$message),
            'data' => $data
        ];
        return response()->json($response, $statusCode, $headers);
    }

    public function sendEmployeesNotifications(array $ids=[],array $data=[]){
        $arUsers = Employee::where('language','en')->wherein('id',$ids)->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
//        Notification::send(null,new SendPushNotification($data['title_ar'],$data['body_ar'],$arUsers));

        $enUsers = Employee::where('language','ar')->wherein('id',$ids)->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
//        Notification::send(null,new SendPushNotification($data['title_en'],$data['body_en'],$enUsers));

        foreach ($ids as $id){
            Notifications::create([
                'user_id' => $id,
                'title_en' => $data['title_en'],
                'title_ar' => $data['title_ar'],
                'body_en' => $data['body_en'],
                'body_ar' => $data['body_ar'],
                'type'=>Employee::class
            ]);
        }

    }
}
