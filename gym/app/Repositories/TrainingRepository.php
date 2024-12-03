<?php

namespace App\Repositories;

use App\Mail\TraineeJoined;
use App\Models\Room;
use App\Models\Training;
use App\Models\TrainingMethod;
use App\Models\User;
use App\Services\WeekCalculator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class TrainingRepository implements TrainingRepositoryInterface
{
    public function __construct(protected WeekCalculator $weekCalculator)
    {}

    public function getAll()
    {
        $trainings = Training::with(['trainingMethod', 'trainer', 'trainees' => function ($query) {
            $query->select('users.id');
        }])
            ->withCount('trainees')
            ->whereNotNull('trainer_id')
            ->where('start', '>=', Carbon::now()->setTimezone('GMT+2'))
            ->orderBy('start')
            ->get();

        return $trainings;
    }


    public function getTrainingsByWeek(?string $week) {
        Log::info($week);

        if ($week == null)
        {
            $trainings = Training::with(['trainingMethod', 'trainer', 'trainees' => function ($query) {
                $query->select('users.id');
            }])
                ->withCount('trainees')
                ->whereNotNull('trainer_id')
                ->where('start', '>=', Carbon::now()->setTimezone('GMT+2'))
                ->orderBy('start')
                ->get();

            //return response()->json($trainings);
        }

        else
        {
//            $currentDate = Carbon::now();
//            $startOfWeek = $currentDate->addWeeks((int)$week)->startOfWeek()->startOfDay()->toDateTimeString();
//            $endOfWeek = $currentDate->endOfWeek()->endOfDay()->toDateTimeString();

            $period = $this->weekCalculator->calculateWeek((int)$week);


            $trainings = Training::whereBetween('start', $period)
                ->with(['trainingMethod', 'trainer', 'trainees' => function ($query) {
                    $query->select('users.id');
                }])
                ->withCount('trainees')
                ->whereNotNull('trainer_id')
                ->where('start', '>=', Carbon::now()->setTimezone('GMT+2'))
                ->orderBy('start')
                ->get();
        }

        return [$trainings, $period];
    }
    public function createTraining()
    {
        $training_methods = TrainingMethod::all();
        $rooms = Room::all();
        $trainers = User::where('role', 'trainer')->with('trainingMethods:id')->get();

        return [$training_methods, $rooms, $trainers];
    }
    public function showTraining(Training $training)
    {
        $training = Training::with('trainingMethod')
            ->with('trainer')
            ->with('trainees')
            ->with('room')
            ->whereNotNull('trainer_id')
            ->find($training->id);
        Log::info($training);

        return $training;
    }
    public function storeTraining(Training $training){
        request()->validate([
            'start' => 'required',
            'duration' => 'required',
            'room_id' => 'required',
            'capacity' => 'required',
            'training_method_id' => 'required',
            'trainer_id' => 'required',
        ]);

        Training::create([
            'start' => request('start'),
            'duration' => request('duration'),
            'room_id' => request('room_id'),
            'capacity' => request('capacity'),
            'training_method_id' => request('training_method_id'),
            'trainer_id' => request('trainer_id'),
        ]);
    }
    public function editTraining(Training $training){
        Gate::authorize('edit', $training);

        $training = Training::with('trainingMethod')
            ->with('trainer')
            ->with('trainees')
            ->with('room')
            ->find($training->id);

        $training_methods = TrainingMethod::all();
        $rooms = Room::all();
        $trainers = User::where('role', 'trainer')->get();
        return [$training, $training_methods, $rooms, $trainers];
    }
    public function updateTraining(Training $training){
        Gate::authorize('edit', $training);

        request()->validate([
            'start' => 'required',
            'duration' => 'required',
            'room_id' => 'required',
            'capacity' => 'required',
            'training_method_id' => 'required',
            'trainer_id' => 'required',
        ]);

        $update = $training->update([
            'start' => request('start'),
            'duration' => request('duration'),
            'room_id' => request('room_id'),
            'capacity' => request('capacity'),
            'training_method_id' => request('training_method_id'),
            'trainer_id' => request('trainer_id'),
        ]);
        return $training;
    }
    public function deleteTraining(Training $training){
        $training->delete();
        Log::info('Deleted training with id: ' . $training->id);
    }
    public function joinTrainingById(User $user, Training $training){
        if ($training === null || $user === null) {
            return response()->json(['message' => 'Training or user not found.'], 404);
        }
        if ($training->capacity<=count($training->trainees)){
            return response()->json(['message' => 'There is no available slot on this training!'], 422);
        }

        $isAlreadyParticipating = $training->trainees->contains('pivot.trainee_id', $user->id);
        if ($isAlreadyParticipating) {
            return response()->json(['message' => 'User is already participating in this training.'], 422);
        }

        $training->trainees()->attach($user->id);

        Mail::to($training->trainer->email)->send(
            new TraineeJoined($user, $training)
        );
    }
    public function getTrainees(User $user, Training $training)
    {
        if ($training === null || $user === null) {
            return response()->json(['message' => 'Training or user not found.'], 404);
        }

        $trainees = $training->trainees->pluck('id')->toArray();
        return $trainees;
    }
}
