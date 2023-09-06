<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'title_en',
        'title_ar',
        'body_en',
        'body_ar',
        'type'
    ];
}
