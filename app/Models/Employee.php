<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\App;

class Employee extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia, SoftDeletes;

    protected $guard = "admin";

    protected $fillable = [
        'name_ar', 'name_en', 'phone',
        'email', 'password',
        'is_active', 'role_id',
        'type', 'token',
    ]; 

    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaCollection('profile')
        ->singleFile();

        // $this->addMediaConversion('thumb')
        // ->crop('crop-center', 100, 100);
    }

    public function getAppendNameAttribute()
    {
        if ($locale = App::getLocale() == "ar") {
            return $this->name_ar;
        } else {
            return $this->name_en;
        }
    }
}
