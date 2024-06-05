<?php

namespace Database\Seeders;

use Faker\Core\DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TrainingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('training_methods')->delete();
        DB::table('training_methods')->insert([
            [
                'name' => 'box',
                'description' => 'In this class the trainees follow the instructor of a professional boxer trainer, which includes sparring and strengthening.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'yoga',
                'description' => 'In yoga, practitioners has the chance to stretch, strengthen and relax.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'spinning',
                'description' => 'In spinning, bikers can spin at different intensity levels, and listen to loud music.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
