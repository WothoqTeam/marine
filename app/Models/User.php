<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Permissions\HasPermissionsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements JWTSubject, HasMedia
{
    use HasApiTokens, HasFactory, Notifiable,HasPermissionsTrait, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'full_name',
        'email', 'phone',
        'password', 'is_active',
        'fcm_token','language',
        'google_id','twitter_id'
    ];

    protected $hidden=[
        'password','deleted_at','remember_token','created_at','updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier() {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }

    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaCollection('profile')
            ->singleFile();

        // $this->addMediaConversion('thumb')
        // ->crop('crop-center', 100, 100);
    }
}
