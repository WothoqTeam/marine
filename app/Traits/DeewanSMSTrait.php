<?php

namespace App\Traits;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\App;

trait DeewanSMSTrait
{
    public function sendSMS( int $code,string $phone,string $language='ar')
    {
        App::setLocale($language);
        $apiSecret = env('DEEWAN_API_SECRET');

        $client = new Client();

        try {
            $response = $client->post('https://apis.deewan.sa/sms/v1/messages', [
                'headers' => [
                    'Authorization' => "Bearer $apiSecret",
                ],
                'json' => [
                    "senderName" => env('DEEWAN_SENDER_NAME'),
                    "messageType" => "text",
                    "messageText" => trans('lang.sendOtpMessage') . $code,
                    "recipients" => $phone
                ],
            ]);

            $statusCode = $response->getStatusCode();

            if ($statusCode === 200) {
                return true;
            } else {
                return false;
            }

        } catch (\Exception $e) {
            return  false;
        }
    }
}
