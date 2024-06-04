<?php

namespace Database\Seeders;

use Faker\Core\DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TrainingMethodSeederClass extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('training')->insert([
            [
                'name' => 'box',
                'description' => 'In this class the trainees follow the instructor of a professional boxer trainer, which includes sparring and strengthening.',
                'trainers' => [],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'yoga',
                'description' => 'In yoga, practitioners has the chance to stretch, strengthen and relax.',
                'trainers' => [],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'spinning',
                'description' => 'In spinning, bikers can spin at different intensity levels, and listen to loud music.',
                'trainers' => [],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
