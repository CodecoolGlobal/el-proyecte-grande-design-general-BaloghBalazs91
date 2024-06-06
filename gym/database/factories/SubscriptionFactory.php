<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startOfTheYear = now()->startOfYear();
        $now = now();

        return [
            'type' => fake()->randomElement(['box', 'yoga', 'spinning', 'all']),
            'start' => fake()->dateTimeBetween($startOfTheYear, $now),
            'duration' => 30,
            'remaining_occasions' => 10,
            'user_id' => \Illuminate\Support\Facades\DB::table('users')->inRandomOrder()->first()->id,
        ];
    }
}
