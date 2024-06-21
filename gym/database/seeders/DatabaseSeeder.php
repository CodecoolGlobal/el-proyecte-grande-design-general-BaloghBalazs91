<?php

namespace Database\Seeders;

use App\Models\Subscription;
use App\Models\Training;
use App\Models\TrainingMethod;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::table('training_methods')->insert([
            [
                'name' => 'box',
                'description' => 'In this class the trainees follow the instructor of a professional boxer trainer, which includes sparring and strengthening.',
                'image' => 'training-method-box-card.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'yoga',
                'description' => 'In yoga, practitioners has the chance to stretch, strengthen and relax.',
                'image' => 'training-method-yoga-card.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'spinning',
                'description' => 'In spinning, bikers can spin at different intensity levels, and listen to loud music.',
                'image' => 'training-method-spinning-card.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
        DB::table('rooms')->insert([
            [
                'name' => 'red',
            ],
            [
                'name' => 'blue',
            ],
            [
                'name' => 'green',
            ]
        ]);
        DB::table('users')->insert(
            [
                [
                    'name' => 'Balázs',
                    'email' => 'b@b',
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                    'remember_token' => Str::random(10),
                    'role' => 'trainer',
                    'vote_list' => '[1,2,3]',

                ],
                [
                    'name' => 'Kitti',
                    'email' => 'k@k',
                    'password' =>  Hash::make('password'),
                    'email_verified_at' => now(),
                    'remember_token' => Str::random(10),
                    'role' => 'trainer',
                    'vote_list' => '[2,3,4]'
                ],
                [
                    'name' => 'Bence',
                    'email' => 'b@be',
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                    'remember_token' => Str::random(10),
                    'role' => 'trainer',
                    'vote_list' => '[3,4,5]'
                ],
            ]
        );
        User::factory(100)
            ->has(Subscription::factory())
            ->create();

        DB::table('training_method_trainer')->insert([
            [
                'training_method_id'=> 1,
                'user_id' => 1,
            ],[
                'training_method_id'=> 1,
                'user_id' => 2,
            ],[
                'training_method_id'=> 2,
                'user_id' => 2,
            ],[
                'training_method_id'=> 2,
                'user_id' => 3,
            ],[
                'training_method_id'=> 3,
                'user_id' => 1,
            ],[
                'training_method_id'=> 3,
                'user_id' => 3,
            ],
        ]);

        $trainees = User::query()->where('role', 'user')->get();

        Training::factory(1000)->create()->each(function($training) {
            $trainees = DB::table('users')
                ->where('role', 'user')
                ->inRandomOrder()
                ->take(rand(3,8))
                ->pluck('id')
                ->toArray();
            $training->trainees()->attach($trainees);
        });
    }
}
