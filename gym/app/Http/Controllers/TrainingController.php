<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function getAll(Request $request)
    {
        $week = $request->query('week', 0);

        $currentDate = Carbon::now();
        $startOfWeek = $currentDate->addWeeks((int)$week)->startOfWeek()->startOfDay()->toDateTimeString();
        $endOfWeek = $currentDate->addWeeks((int)$week)->endOfWeek()->endOfDay()->toDateTimeString();

        $trainings = Training::whereBetween('start', [$startOfWeek, $endOfWeek])->get();

        return response()->json($trainings);
    }

    public function getById(int $id)
    {
        $training = Training::query()->find($id);
        return response()->json($training);
    }
}
