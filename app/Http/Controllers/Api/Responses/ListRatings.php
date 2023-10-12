<?php

namespace App\Http\Controllers\Api\Responses;

use App\Http\Controllers\Api\Base\Interfaces\DataInterface;
use App\Models\Ratings;
use App\Models\User;

class ListRatings extends DataInterface
{
    public int $id;
    public float $stars;
    public string|null $comment;
    public string|null $date;
    public array $user;

    /**
     * @param Ratings $rate
     */

    public function __construct(Ratings $rate)

    {
        $this->id = $rate->id;
        $this->stars = $rate->stars;
        $this->comment = $rate->comments;
        $this->date = $rate->created_at;
        $this->user = [
            'id'=>$rate->addBy->id,
            'name'=>$rate->addBy->name,
            'image'=>$rate->addBy->getFirstMediaUrl('profile')
        ];
    }
}
