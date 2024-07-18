<?php

namespace App\Repositories\TrainingMethodRepository;

use App\Models\TrainingMethod;
use Carbon\Carbon;

class TrainingMethodRepository implements TrainingMethodRepositoryInterface
{

    public function index()
    {
        return TrainingMethod::all() ?? [];
    }

    public function show(TrainingMethod $trainingMethod)
    {
        return TrainingMethod::with([
            'trainers' => function($query) {
                $query->with(['trainingMethods' => function ($subQuery) {
                    $subQuery->select('name');
                }]);
            },
            'trainings' => function ($query) {
                $query->where('start', '>=', Carbon::now())
                    ->whereNotNull('trainer_id')
                    ->withCount('trainees')
                    ->with(['trainer', 'trainees' => function ($query) {
                        $query->select('users.id');
                    }])
                    ->withCount('trainees')
                    ->orderBy('start');
            }
        ])->find($trainingMethod->id);
    }

    public function store(TrainingMethod $trainingMethod, array $trainers)
    {
        $trainingMethod = TrainingMethod::create([
            'name' => $trainingMethod->name,
            'description' => $trainingMethod->description,
            'image' => $trainingMethod->image
        ]);

        $trainingMethod->trainers()->attach(request('trainers'));
    }

    public function update(TrainingMethod $trainingMethod, array $trainers)
    {
        $trainingMethod->update([
            'name' => request('name'),
            'description' => request('description'),
        ]);

        $trainingMethod->trainers()->sync($trainers);
    }
}
