<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Yachts extends Model implements HasMedia
{
    use HasFactory,SoftDeletes, InteractsWithMedia;

    protected $fillable=[
        'provider_id',
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'add_info_en',
        'add_info_ar',
        'booking_info_en',
        'booking_info_ar',
        'address_en',
        'address_ar',
        'price',
        'is_discount',
        'discount_value',
        'city_id',
        'country_id',
        'address',
        'status',
        'longitude',
        'latitude',
    ];

    protected $hidden=[
        'deleted_at','created_at','updated_at'
    ];

    public function provider() {
        return $this->belongsTo(User::class,'provider_id');
    }

    public function city()
    {
        return $this->belongsTo(Cities::class);
    }

    public function country()
    {
        return $this->belongsTo(Countries::class);
    }

    public function specifications()
    {
        return $this->belongsToMany(Specifications::class, 'yachts_specifications','yacht_id','specification_id');
    }

    public function reservations(){
        return $this->hasMany(Reservations::class, 'yacht_id');
    }
}
