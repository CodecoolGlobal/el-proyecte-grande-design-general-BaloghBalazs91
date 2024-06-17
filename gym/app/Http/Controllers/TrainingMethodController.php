<?php

namespace App\Http\Controllers;

use App\Models\TrainingMethod;

class TrainingMethodController extends Controller
{
    public function getAll()
    {
        $training_methods = TrainingMethod::all() ?? [];
        return view('training-methods.training-methods', ['training_methods' => $training_methods]);
    }

    public function getByName($training_method_name)
    {
        $training_method = TrainingMethod::query()
            ->where('name', $training_method_name)
            ->with('trainers')
            ->with('trainings')
            ->get()
            ->first();

        return view('training-methods.training-method', ['training_method' => $training_method]);
    }

    public function getTrainersById($id)
    {
        $training_methods = TrainingMethod::query()->find($id);
        $trainers = [];
        //$training_methods->
    }
}
