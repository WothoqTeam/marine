<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::updateOrCreate(
            ['id' => 1],
            [
                'name_en' => 'Admin',
                'name_ar' => 'ادمن',
                'email' => 'admin@unified.com',
                'phone' => '+201234567891',
                'password' => Hash::make('123456'),
                'role_id' => 1,
                'is_active' => 1,
            ]
        );
    }
}
