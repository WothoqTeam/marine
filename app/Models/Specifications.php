<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Specifications extends Model  implements HasMedia
{
    use HasFactory,SoftDeletes,InteractsWithMedia;

    protected $fillable=[
        'name_en',
        'name_ar',
        'status',
    ];

    protected $appends=[
        'icon'
    ];

    protected $hidden=[
        'deleted_at','created_at','updated_at','pivot','media','status'
    ];

    protected function getIconAttribute()
    {
        return $this->getFirstMediaUrl('icon');
    }
}
