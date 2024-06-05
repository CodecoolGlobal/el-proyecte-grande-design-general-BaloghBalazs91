<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\Training;
use App\Models\TrainingMethod;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Training>
 */
class TrainingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'start' => fake()->dateTimeBetween('now', '+6 months'),
            'duration' => fake()->randomDigitNotNull(),
            'capacity' => fake()->randomDigitNotNull(),
            'room_id' => \Illuminate\Support\Facades\DB::table('rooms')->inRandomOrder()->first()->id,
            'user_id' => \Illuminate\Support\Facades\DB::table('users')->inRandomOrder()->first()->id,
            'training_method_id' => \Illuminate\Support\Facades\DB::table('training_methods')->inRandomOrder()->first()->id
        ];
    }
}
