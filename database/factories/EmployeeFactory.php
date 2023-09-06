<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\Department;
use App\Models\Religion;
use App\Models\Country;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_ar' => fake()->name(),
            'phone' => fake()->unique()->numerify('##########'),
            'email' => fake()->unique()->email(),
            'password' => Hash::make('123456789'),
            'is_active' => '1',
            'role_id' => 1,
            'type' => 'dash',
        ];
    }
}
