<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use App\Models\Notifications;
use App\Notifications\SendPushNotification;
use Notification;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;

//use Notification;

class BaseApiController extends Controller
{
    protected $language;
    public function __construct()
    {
        $this->language = strtolower(request()->header('Language', 'ar'));
        App::setLocale($this->language);
        $this->user=auth('api')->user();
    }

    protected function generateResponse(bool $isSuccess = true, string $message = '',$data = [], $statusCode = 200, array $headers = [])
    {
        $response = [
            'success' => $isSuccess,
            'message' => $this->transValue($message),
            'data' => $data
        ];
        return response()->json($response, $statusCode, $headers);
    }

    public function sendNotifications(string $model,array $ids=[],array $data=[]){
        $arUsers = $model::where('language','en')->wherein('id',$ids)->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
        Notification::send(null,new SendPushNotification($data['title_ar'],$data['body_ar'],$arUsers));

        $enUsers = $model::where('language','ar')->wherein('id',$ids)->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
        Notification::send(null,new SendPushNotification($data['title_en'],$data['body_en'],$enUsers));

        foreach ($ids as $id){
            Notifications::create([
                'user_id' => $id,
                'title_en' => $data['title_en'],
                'title_ar' => $data['title_ar'],
                'body_en' => $data['body_en'],
                'body_ar' => $data['body_ar'],
                'type'=>$model
            ]);
        }

    }

    public function transValue($key, $placeholder = [])
    {
        $locale=strtolower(request()->header('Language', 'en'));
        $group = 'lang';
        if (is_null($locale))
            $locale = config('app.locale');
        $key = trim($key);
        $word = $group . '.' . $key;
        if (Lang::has($word))
            return trans($word, $placeholder, $locale);

        $messages = [
            $word => $key,
        ];


        app('translator')->addLines($messages, $locale);
        $translation_file = base_path() . '/resources/lang/' . $locale . '/' . $group . '.php';
        $fh = fopen($translation_file, 'r+');
        $new_key = "  \n  '" . $key . "' => '" . $key . "',\n];\n";
        $saved_cursor = -1;
        $end_with_comma = false;
        $has_single_qoute = false;
        for ($cursor = -1; $cursor < 100; $cursor--) {
            fseek($fh, $cursor, SEEK_END);
            if (fgetc($fh) == ',' && !$has_single_qoute) {
                $end_with_comma = true;
                fseek($fh, $cursor + 1, SEEK_END);
                fwrite($fh, $new_key);
                break;
            } else if (fgetc($fh) == '\'' && !$end_with_comma) {
                $has_single_qoute = true;
                fseek($fh, $cursor + 2, SEEK_END);
                fwrite($fh, ',' . $new_key);
                break;
            }
        }
        fclose($fh);
        return trans($word, $placeholder, $locale);
    }
}
