<?php

namespace App\Http\Controllers;

use App\Models\TrainingMethod;

class TrainingMethodController extends Controller
{
    public function getAll()
    {
        $training_methods = TrainingMethod::all() ?? [];

        return response()->json($training_methods);
    }

    public function getById($id)
    {
        $training_method = TrainingMethod::query()->find($id);
        return response()->json($training_method);
    }

    public function getTrainersById($id)
    {
        $training_methods = TrainingMethod::query()->find($id);
        $trainers = [];
        //$training_methods->
    }
}
