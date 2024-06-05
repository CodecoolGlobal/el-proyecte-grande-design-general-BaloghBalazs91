<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('trainers')->delete();
        DB::table('trainers')->insert(
            [
                [
                    'name' => 'Balázs',
                    'email' => 'b@b',
                    'password' => 'password',
                    'vote_list' => '[1,2,3]'
                ],
                [
                    'name' => 'Kitti',
                    'email' => 'k@k',
                    'password' => 'password',
                    'vote_list' => '[2,3,4]'
                ],
            ]
        );
    }
}
