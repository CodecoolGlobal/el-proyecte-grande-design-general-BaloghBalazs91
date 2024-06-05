<?php

namespace Database\Seeders;

use Faker\Core\DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('training')->insert([
            [
                'id_training_method' => '[1,2]',
                'start' => new DateTime(),
                'duration' => 120,
                'message' => 'Hello bence, welcome to our service!',
                'is_read' => 0,
                'sent' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_training_method' => '[2,3]',
                'start' => new DateTime(),
                'duration' => 120,
                'message' => 'Hello bence, welcome to our service!',
                'is_read' => 0,
                'sent' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
