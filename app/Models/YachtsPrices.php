<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class YachtsPrices extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
        'yacht_id',
        'date',
        'start_time',
        'end_time',
        'price'
    ];

    protected $hidden=[
        'deleted_at','created_at','updated_at'
    ];
}
