<?php

namespace App\Http\Controllers;

use App\Models\TrainingMethod;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class TrainingMethodController extends Controller
{
    public function index()
    {
        $training_methods = TrainingMethod::all() ?? [];
        return view('training-methods.index', ['training_methods' => $training_methods]);
    }

    public function create()
    {
        $trainers = User::where('role', 'trainer')->get();
        return view('training-methods.create', ['trainers' => $trainers]);
    }

    public function show(TrainingMethod $trainingMethod)
    {
        $training_method = TrainingMethod::with([
            'trainers' => function($query) {
                $query->with(['trainingMethods' => function ($subQuery) {
                    $subQuery->select('name');
                }]);
            },
            'trainings' => function ($query) {
                $query->where('start', '>=', Carbon::now())
                    ->whereNotNull('trainer_id')
                    ->with('trainer')
                    ->withCount('trainees')
                    ->withCount('trainees')
                    ->orderBy('start');
            }
        ])->find($trainingMethod->id);

        //return response()->json($training_method);
        return view('training-methods.show', ['training_method' => $training_method]);
    }

    public function store(TrainingMethod $trainingMethod)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'trainers' => 'required|array',
            'trainers.*' => 'exists:App\Models\User,id',
        ]);

        $trainingMethod = TrainingMethod::create([
            'name' => request('name'),
            'description' => request('description'),
            'image' => 'training-method-aerobik-card.jpg'
        ]);

        $trainingMethod->trainers()->attach(request('trainers'));

        return redirect('/training-methods');
    }

    public function edit(TrainingMethod $trainingMethod)
    {
        $trainers = User::where('role', 'trainer')->get();

        //$trainingMethod = TrainingMethod::with('trainers')->get();

        //return response()->json($trainingMethod);
        return view('training-methods.edit', [
            'training_method' => $trainingMethod,
            'trainers' => $trainers]);
    }

    public function update(TrainingMethod $trainingMethod)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'trainers' => 'required|array',
            'trainers.*' => 'exists:App\Models\User,id',
        ]);

        $trainingMethod->update([
            'name' => request('name'),
            'description' => request('description'),
            'image' => 'training-method-aerobik-card.jpg'
        ]);

        $trainingMethod->trainers()->sync(request('trainers'));
        return redirect('/training-methods');
    }

    public function destroy(TrainingMethod $trainingMethod)
    {
        $trainingMethod->delete();
        return redirect('/training-methods');
    }
    public function getTrainersById($id)
    {
        $training_methods = TrainingMethod::query()->find($id);
        $trainers = [];
        //$training_methods->
    }


}
