<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LoginAttempts>
 */
class LoginAttemptsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->value('id'),
            'email'        => fake()->unique()->safeEmail(),
            'ip_address'   => fake()->ipv4(),
            'attempt_type' => fake()->randomElement(['biometric', 'passkey', 'username_password']), 
            'successful'   => fake()->boolean(),
            'risk_score'   => fake()->randomFloat(2, 0, 9.99),  // for DECIMAL(3,2)
            'created_at' => now(),
        ];
    }
}
