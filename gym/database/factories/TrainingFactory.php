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
            'start' => fake()->dateTimeBetween('now', '+1 year'),
            'duration' => fake()->randomDigitNotNull(),
            'capacity' => fake()->randomDigitNotNull(),
            'room_id' => Room::factory(),
            'user_id' => User::factory(),
            'training_method_id' => TrainingMethod::factory()
        ];
    }

    public function configure()
    {
        $existingUserIds = DB::table('users')->inRandomOrder()->take(5)->pluck('id');

        return $this->afterCreating(function (Training $training) use ($existingUserIds) {
            $training->participants()->attach($existingUserIds);
        });
    }


}
