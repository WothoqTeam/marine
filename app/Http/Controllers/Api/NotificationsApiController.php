<?php

namespace App\Http\Controllers\Api;

use App\Models\Notifications;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationsApiController extends BaseApiController
{
    public function index(){
        $user=auth('api')->user();
        $notifications=Notifications::select('id','title_'.$this->language.' as title','body_'.$this->language.' as body')->where('type',User::class)->where('user_id',$user->id)->orWhere('user_id',null)->where('created_at','>=',$user->created_at)->get()->toArray();
        return $this->generateResponse(true,'Success',$notifications);
    }
}
