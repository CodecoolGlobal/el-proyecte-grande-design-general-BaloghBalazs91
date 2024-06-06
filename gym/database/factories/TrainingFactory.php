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
            'duration' => fake()->randomElement([60,90,120]),
            'capacity' => rand(6,15),
            'room_id' => rand(1,3),
            'trainer_id' => rand(1,3),
            'training_method_id' => rand(1,3)
        ];
    }
}
