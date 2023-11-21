<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class GasStations extends Model implements HasMedia
{
    use HasFactory,SoftDeletes, InteractsWithMedia;

    protected $table='gas_stations';
    protected $fillable=[
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'address_en',
        'address_ar',
        'city_id',
        'country_id',
        'status',
        'longitude',
        'latitude',
    ];

    protected $hidden=[
        'deleted_at','created_at','updated_at'
    ];

    public function city()
    {
        return $this->belongsTo(Cities::class);
    }

    public function country()
    {
        return $this->belongsTo(Countries::class);
    }

}
