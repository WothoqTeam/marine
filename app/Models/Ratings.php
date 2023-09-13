<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    use HasFactory;

    protected $fillable=[
        'model_type',
        'model_id',
        'added_by_type',
        'added_by_id',
        'stars',
        'comments',
    ];
}
