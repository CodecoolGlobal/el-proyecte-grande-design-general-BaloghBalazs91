<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\User;
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
        $training = Training::query()->with('trainees')->find($id);
        return response()->json($training);
    }

    public function getByUserId(int $user_id)
    {
        $trainings = Training::whereHas('trainees', function ($query) use ($user_id) {
            $query->where('users.id', $user_id);
        })->with('trainees')->get();

        return response()->json($trainings);
    }

    public function joinTrainingById( int $userId, int $trainingId){
        $user = User::query()->find($userId);
        $training = Training::query()->find($trainingId)->with('trainees')->first();

        if ($training === null || $user === null) {
            return response()->json(['message' => 'Training or user not found.'], 404);
        }
        if ($training->capacity<=count($training->trainees)){
            return response()->json(['message' => 'There is no available slot on this training!'], 422);
        }

        $isAlreadyParticipating = $training->trainees->contains('pivot.trainee_id', $userId);
        if ($isAlreadyParticipating) {
            return response()->json(['message' => 'User is already participating in this training.'], 422);
        }

        $training->trainees()->attach([$user]);
        return response()->json(['message' => 'User has been successfully added to the training.']);
    }
}
