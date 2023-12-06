<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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

    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaCollection('cover');

        $this->addMediaConversion('thumb')
            ->keepOriginalImageFormat()
            ->crop('crop-center', 1024, 500);
    }
}
