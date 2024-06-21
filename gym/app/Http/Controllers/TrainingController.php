<?php

namespace App\Http\Controllers;

use App\Mail\TraineeCanceled;
use App\Mail\TraineeJoined;
use App\Models\Room;
use App\Models\Training;
use App\Models\TrainingMethod;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TrainingController extends Controller
{
    public function index(Request $request)
    {
        $week = $request->query('week');
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
            $currentDate = Carbon::now();
            $startOfWeek = $currentDate->addWeeks((int)$week)->startOfWeek()->startOfDay()->toDateTimeString();
            $endOfWeek = $currentDate->endOfWeek()->endOfDay()->toDateTimeString();

            $trainings = Training::whereBetween('start', [$startOfWeek, $endOfWeek])
                ->with(['trainingMethod', 'trainer', 'trainees' => function ($query) {
                    $query->select('users.id');
                }])
                ->withCount('trainees')
                ->whereNotNull('trainer_id')
                ->where('start', '>=', Carbon::now()->setTimezone('GMT+2'))
                ->orderBy('start')
                ->get();
        }

        //return response()->json($trainings);

        return view('trainings.index', ['trainings' => $trainings]);
    }

    public function create()
    {
        $training_methods = TrainingMethod::all();
        $rooms = Room::all();
        $trainers = User::where('role', 'trainer')->with('trainingMethods:id')->get()
        ;

        //return response()->json($trainers);
        return view('trainings.create', [
            'training_methods' => $training_methods,
            'rooms' => $rooms,
            'trainers' => $trainers]);
    }

    public function show(Training $training)
    {
        $training = Training::with('trainingMethod')
            ->with('trainer')
            ->with('trainees')
            ->with('room')
            ->whereNotNull('trainer_id')
            ->find($training->id);
        Log::info($training);

        //return response()->json($training);
        return view('trainings.show', ['training' => $training]);
    }

    public function store(Training $training)
    {
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
        return redirect('/trainings');
    }

    public function edit(Training $training)
    {
        Gate::authorize('edit', $training);

        $training = Training::with('trainingMethod')
            ->with('trainer')
            ->with('trainees')
            ->with('room')
            ->find($training->id);

        $training_methods = TrainingMethod::all();
        $rooms = Room::all();
        $trainers = User::where('role', 'trainer')->get();

        return view('trainings.edit', [
            'training' => $training,
            'training_methods' => $training_methods,
            'rooms' => $rooms,
            'trainers' => $trainers]);
    }

    public function update(Training $training)
    {
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

        return redirect('/trainings');
    }

    public function destroy(Training $training)
    {
        $training->delete();
        Log::info('Deleted training with id: ' . $training->id);

        return redirect('/trainings');
    }

//    public function getByUserId(int $user_id)
//    {
//        $trainings = Training::whereHas('trainees', function ($query) use ($user_id) {
//            $query->where('users.id', $user_id);
//        })->with('trainees')->get();
//
//        return response()->json($trainings);
//    }

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

        echo '<script>alert("Successfully joined the training.");
            window.location.href="/trainings";</script>';
    }

    public function cancelTrainingById(User $user, Training $training)
    {
        if ($training === null || $user === null) {
            return response()->json(['message' => 'Training or user not found.'], 404);
        }

        $trainees = $training->trainees->pluck('id')->toArray();

        if (in_array($user->id, $trainees)) {

            $training->trainees()->detach($user->id);

            Mail::to($training->trainer->email)->send(
                new TraineeCanceled($user, $training)
            );

            echo '<script>alert("Successfully canceled the training.");
            window.location.href="/trainings";</script>';
        }

        echo '<script>alert("Cannot cancelled the training.");
            window.location.href="/trainings";</script>';
    }
}
