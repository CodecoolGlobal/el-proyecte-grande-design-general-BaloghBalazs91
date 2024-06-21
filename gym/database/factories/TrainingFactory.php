<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\Training;
use App\Models\TrainingMethod;
use App\Models\User;
use Carbon\Carbon;
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

        // Generate a random date within the next 6 months
        $randomDate = fake()->dateTimeBetween('now', '+6 months');

        // Generate a random hour between 6 and 20 (6 AM to 8 PM)
        $randomHour = rand(6, 20);

        // Generate a random minute from the set {0, 15, 30, 45}
        $randomMinute = [0, 15, 30, 45][array_rand([0, 15, 30, 45])];

        // Combine the date with the random time
        $randomDateTime = Carbon::instance($randomDate)
            ->setHour($randomHour)
            ->setMinute($randomMinute)
            ->setSecond(0);

        return [
            'start' => $randomDateTime,
            'duration' => fake()->randomElement([60,90,120]),
            'capacity' => rand(6,15),
            'room_id' => rand(1,3),
            'trainer_id' => $trainer_id,
            'training_method_id' => $training_method_id
        ];
    }
}
