<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use HasFactory;
    protected $hidden=[
        'deleted_at','created_at','updated_at'
    ];
    protected $fillable=[
        'name_en',
        'name_ar',
        'currency_en',
        'currency_ar',
        'iso_code',
        'status'
    ];
}
