<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
class Faqs extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $fillable = [
        'title_en',
        'title_ar',
        'body_en',
        'body_ar',
        'status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
