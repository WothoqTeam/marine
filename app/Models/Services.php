<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $fillable=[
        'employee_id',
        'name_en',
        'name_ar',
        'price',
        'status'
    ];

    protected $hidden=[
        'deleted_at','created_at','updated_at','employee_id','pivot','status'
    ];

    public function employee() {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
