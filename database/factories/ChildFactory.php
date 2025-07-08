<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Child>
 */
class ChildFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Get a random user with the 'parent' role
        // $parent = User::where('role', 'parent')->inRandomOrder()->first();

        return [
            // 'user_id' => $parent ? $parent->id : User::factory()->create(['role' => 'parent'])->id,
            'name' => fake()->name(),
            'dob' => fake()->date(),
            'gender' => fake()->randomElement(['male', 'female', 'other']),
        ];
    }
}
