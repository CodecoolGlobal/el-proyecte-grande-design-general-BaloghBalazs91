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

    public function getByUserId(int $user_id)
    {
        $trainings = Training::whereHas('trainees', function ($query) use ($user_id) {
            $query->where('users.id', $user_id);
        })->with('trainees')->get();

        //$trainings = Training::query()->where('user_id', $user_id)->get();
        return response()->json($trainings);
    }
}
