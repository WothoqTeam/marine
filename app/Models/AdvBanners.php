<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class AdvBanners extends Model implements HasMedia
{
    use HasFactory;

    use HasFactory,InteractsWithMedia;

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
