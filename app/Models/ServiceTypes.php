<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceTypes extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'name_en',
        'name_ar',
        'status'
    ];

    protected $hidden=[
        'deleted_at','created_at','updated_at'
    ];
}
