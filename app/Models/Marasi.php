<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Marasi extends Model implements HasMedia
{
    use HasFactory,SoftDeletes, InteractsWithMedia;

    protected $table='marasi';
    protected $fillable=[
        'employee_id',
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'address_en',
        'address_ar',
        'price',
        'hour_price',
        'is_discount',
        'discount_value',
        'city_id',
        'country_id',
        'status',
        'longitude',
        'latitude',
        'is_approved'
    ];

    protected $hidden=[
        'deleted_at','created_at','updated_at'
    ];

    protected $appends=['name'];

    public function getNameAttribute()
    {
        if (App::getLocale() == "ar") {
            return $this->name_ar;
        } else {
            return $this->name_en;
        }
    }
    public function employee() {
        return $this->belongsTo(Employee::class,'employee_id');
    }

    public function city()
    {
        return $this->belongsTo(Cities::class);
    }

    public function country()
    {
        return $this->belongsTo(Countries::class);
    }

    public function reservations(){
        return $this->hasMany(MarasiReservations::class, 'marasi_id');
    }
    public function services()
    {
        return $this->belongsToMany(Services::class, 'marasi_services','marasi_id','services_id');
    }
}
