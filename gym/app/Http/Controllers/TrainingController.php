<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function getAll()
    {
        $trainings = Training::all() ?? [];

        return response()->json($trainings);
    }

    public function getById($id)
    {
        $training = Training::query()->find($id);
        return response()->json($training);
    }
}
