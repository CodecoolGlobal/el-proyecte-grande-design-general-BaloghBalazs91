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
        $trainer_id = rand(1,3);
        switch ($trainer_id) {
            case 1:
                $training_method_id = $this->faker->randomElement([1, 3]); // Choose from available methods for trainer_id 1
                break;
            case 2:
                $training_method_id = $this->faker->randomElement([1, 2]); // Choose from available methods for trainer_id 2
                break;
            case 3:
                $training_method_id = $this->faker->randomElement([2, 3]); // Choose from available methods for trainer_id 3
                break;
            default:
                $training_method_id = 1; // Default fallback if no specific case matches
                break;
        }

        return [
            'start' => fake()->dateTimeBetween('now', '+6 months'),
            'duration' => fake()->randomElement([60,90,120]),
            'capacity' => rand(6,15),
            'room_id' => rand(1,3),
            'trainer_id' => $trainer_id,
            'training_method_id' => $training_method_id
        ];
    }
}
