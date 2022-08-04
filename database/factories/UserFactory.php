<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => '$2y$10$mOzjJtnGDgjUibvS3L4Mhuj/2eo3jQOyMdoFKD3C.fSH.Gfby7rkK', // password
            'remember_token' => Str::random(10),
            'admin' => true,
            'super' => true,
        ];
    }
}
