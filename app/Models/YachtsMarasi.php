<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YachtsMarasi extends Model
{
    use HasFactory;

    protected $table='yachts_marasi';
    protected $fillable=[
        'marasi_id',
        'yacht_id',
        'status'
    ];
}
