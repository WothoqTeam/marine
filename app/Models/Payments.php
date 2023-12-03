<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $fillable=[
        'reservation_id',
        'reservation_type',
        'response',
        'status',
    ];

    protected $casts = [
        'response' => 'array',
    ];
}
