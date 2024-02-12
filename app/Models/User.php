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
        'google_id','twitter_id',
        'last_name','dob','gender',
        'nationality'
    ];

    protected $hidden=[
        'password','deleted_at','remember_token','created_at','updated_at','media','roles'
    ];

    protected $appends=[
        'image'
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
    protected function getImageAttribute()
    {
        return $this->getFirstMediaUrl('profile');
    }

    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaCollection('profile')
            ->singleFile();

        // $this->addMediaConversion('thumb')
        // ->crop('crop-center', 100, 100);
    }

    public function role_type() {
        return $this->hasOne(UsersRoles::class,'user_id');
    }

    public  function yachts(){
        return $this->hasMany(Yachts::class,'provider_id');
    }

    public function reservations()
    {
        return $this->hasManyThrough(Reservations::class, Yachts::class,'provider_id','yacht_id')->orderBy('reservations.id','DESC');
    }

    public function messagesSent()
    {
        return $this->hasMany(Chats::class, 'sender_id');
    }

    public function messagesReceived()
    {
        return $this->hasMany(Chats::class, 'receiver_id');
    }
}
