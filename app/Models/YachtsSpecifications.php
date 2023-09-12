<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YachtsSpecifications extends Model
{
    use HasFactory;

    protected $fillable=[
        'specification_id',
        'yacht_id',
    ];
}
