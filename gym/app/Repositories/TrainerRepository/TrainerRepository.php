<?php

namespace App\Repositories\TrainerRepository;

use App\Models\User;
use Carbon\Carbon;

class TrainerRepository implements TrainerRepositoryInterface
{

    public function index()
    {
        return User::where('role', 'trainer')
            ->with(['trainingMethods' => function ($query) {
                $query->select('name');
            }])
            ->get();
    }

    public function show($id)
    {
        return User::where('id', $id)
            ->with(['trainingMethods' => function ($query)
            {
                $query->select('name');
            }])
            ->with(['trainings' => function ($query) {
                $query->where('start', '>=', Carbon::now())
                    ->with('trainingMethod')
                    ->withCount('trainees')
                    ->orderBy('start');
            }])
            ->get()->first();
    }
}
