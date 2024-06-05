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
        return [
            'type' => fake()->text(),
            'start' => fake()->dateTime(),
            'duration' => fake()->randomDigitNotNull(),
            'remaining_occasions' => fake()->randomDigitNotNull(),
            'user_id' => \Illuminate\Support\Facades\DB::table('users')->inRandomOrder()->first()->id,
        ];
    }
}
