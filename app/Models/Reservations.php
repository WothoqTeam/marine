<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservations extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
        'user_id',
        'yacht_id',
        'start_day',
        'end_day',
        'note',
        'payment_method',
        'payment_status',
        'reservations_status',
        'sub_total',
        'vat',
        'service_fee',
        'total',
    ];

    protected $hidden=[
        'deleted_at'
    ];

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function yacht() {
        return $this->belongsTo(Yachts::class,'yacht_id');
    }

    public function times()
    {
        return $this->belongsToMany(YachtsPrices::class, 'reservation_times','reservations_id','times_id');
    }
}
