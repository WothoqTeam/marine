<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeesPermissions extends Model
{
    use HasFactory;

    protected $fillable=[
        'employees_id',
        'permission_id'
    ];
}
