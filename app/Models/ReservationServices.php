<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservationServices extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
        'reservations_id',
        'services_id',
    ];

    public function reservations() {
        return $this->belongsTo(MarasiReservations::class,'reservations_id');
    }

    public function services() {
        return $this->belongsTo(Services::class,'services_id');
    }
}
