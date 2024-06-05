<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class trainingMethodTrainer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('training_method_trainer')->delete();
        DB::table('training_method_trainer')->insert([
            [
                'training_method_id'=>1,
                'trainer_id'=>1
            ],[
                'training_method_id'=>2,
                'trainer_id'=>1
            ],[
                'training_method_id'=>2,
                'trainer_id'=>2
            ],[
                'training_method_id'=>3,
                'trainer_id'=>2
            ],
        ]);
    }
}
