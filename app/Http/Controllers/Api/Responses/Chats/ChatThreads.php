<?php

namespace App\Http\Controllers\Api\Responses\Chats;

use App\Http\Controllers\Api\Base\Interfaces\DataInterface;
use App\Models\Chats;

class ChatThreads extends DataInterface
{
    public int    $id;
    public string $message;
    public int    $sender_id;
    public int    $receiver_id;
    public string $created_at;

    /**
     * @param Chats $chat
     */

    public function __construct(Chats $chat)

    {
        $this->id           = $chat->id;
        $this->message      = $chat->message;
        $this->sender_id    = $chat->sender_id;
        $this->receiver_id  = $chat->receiver_id;
        $this->created_at   = $chat->created_at;
    }
}
