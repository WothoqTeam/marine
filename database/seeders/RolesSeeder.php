<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'User',
                'slug' => 'user'
            ]
        );
        Role::updateOrCreate(
            ['id' => 2],
            [
                'name' => 'Provider',
                'slug' => 'provider'
            ]
        );
    }
}
