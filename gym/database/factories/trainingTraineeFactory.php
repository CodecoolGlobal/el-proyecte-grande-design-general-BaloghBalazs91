<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class trainingTraineeFactory extends Factory
{

    protected $model = null;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'training_id'=> \Illuminate\Support\Facades\DB::table('trainings')->inRandomOrder()->first()->id,
            'user_id'=> \Illuminate\Support\Facades\DB::table('users')->inRandomOrder()->first()->id
        ];
    }
}
