<?php

namespace App\Http\Controllers\Api\Responses;

use App\Http\Controllers\Api\Base\Interfaces\DataInterface;
use App\Models\User;

class ListProviders extends DataInterface
{
    public int $id;
    public string $name;
    public string $image;

    /**
     * @param User $user
     */

    public function __construct(User $user)

    {
        $this->id = $user->id;
        $this->name = $user->name;
        $this->image=$user->getFirstMediaUrl('profile');
        $this->role_name=$user->role_type->role->name;
    }
}
