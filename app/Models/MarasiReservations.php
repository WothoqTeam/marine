<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MarasiReservations extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
        'provider_id',
        'marasi_id',
        'start_day',
        'end_day',
        'note',
        'payment_method',
        'reservations_status',
        'sub_total',
        'vat',
        'service_fee',
        'total',
    ];

    protected $hidden=[
        'deleted_at','created_at','updated_at'
    ];

    public function provider() {
        return $this->belongsTo(User::class,'provider_id');
    }

    public function marasi() {
        return $this->belongsTo(Marasi::class,'marasi_id');
    }
}
