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
        'payment_status',
        'reservations_status',
        'canceled_by',
        'canceled_reason',
        'num_meters',
        'sub_total',
        'vat',
        'service_fee',
        'total',
    ];

    protected $hidden=[
        'deleted_at'
    ];

    public function provider() {
        return $this->belongsTo(User::class,'provider_id');
    }

    public function marasi() {
        return $this->belongsTo(Marasi::class,'marasi_id');
    }

    public function services()
    {
        return $this->belongsToMany(Services::class, 'reservation_services','reservations_id','services_id');
    }
}
