<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Responses\Chats\ChatThreads;
use App\Http\Controllers\Api\Responses\ListProviders;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Chats\StoreChatsRequest;
use App\Models\Chats;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
class ChatsApiController extends BaseApiController
{
    public function index()
    {
        // Retrieve a list of users the authenticated user has chatted with
        $user = $this->user;

        $chattedUsers = User::where(function ($query) use ($user) {
            $query->whereHas('messagesSent', function ($query) use ($user) {
                $query->where('receiver_type', User::class)
                ->where('receiver_id', $user->id);
            })->orWhereHas('messagesReceived', function ($query) use ($user) {
                $query->where('sender_type', User::class)
                ->where('sender_id', $user->id);
            });
        })->get();
        $chattedUsers = $chattedUsers->map(function (User $user) {
            return new ListProviders($user);
        })->values();
        return $this->generateResponse(true,'Success',$chattedUsers);
    }

    public function store(StoreChatsRequest $request)
    {
        $user = $this->user;
        // Create a new message
        Chats::create([
            'sender_id' => $user->id,
            'receiver_type' => User::class,
            'sender_type' => User::class,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);
        $data=[
            'title_en'=>'New message',
            'title_ar'=>'رسالة جديدة',
            'body_en'=>$user->name.' sent a message to you',
            'body_ar'=>'قام '.$user->name.' بارسال رساله لك',
        ];
        $this->sendNotifications(User::class,[$request->receiver_id],$data,'fcm');
        return $this->generateResponse(true,'Message sent successfully');
    }

    public function threads($selectedUserId)
    {
        // Get the authenticated user
        $user1Id = $this->user->id;
        $user2Id=$selectedUserId;
        // Retrieve the conversation between the two users
        $conversation = Chats::where(function ($query) use ($user1Id, $user2Id) {
            $query->where('sender_id', $user1Id)->where('receiver_id', $user2Id);
        })
            ->orWhere(function ($query) use ($user1Id, $user2Id) {
                $query->where('sender_id', $user2Id)->where('receiver_id', $user1Id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $conversation = $conversation->map(function (Chats $chat) {
            return new ChatThreads($chat);
        })->values();
        return $this->generateResponse(true,'Message Returned Successfully',$conversation);
    }

}
