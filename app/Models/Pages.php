<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
        'content_en',
        'content_ar',
        'status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
