<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservationTimes extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'reservations_id',
        'times_id',
    ];
}
