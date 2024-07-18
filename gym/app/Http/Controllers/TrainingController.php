<?php

namespace App\Http\Controllers;

use App\Mail\TraineeCanceled;
use App\Mail\TraineeJoined;
use App\Models\Room;
use App\Models\Training;
use App\Models\TrainingMethod;
use App\Models\User;
use App\Repositories\TrainingRepository;
use App\Repositories\TrainingRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TrainingController extends Controller
{

    public function __construct(protected TrainingRepositoryInterface $trainingRepository)
    {}

    public function indexByWeek(Request $request)
    {
        [$trainings, $period] = $this->trainingRepository->getTrainingsByWeek($request->query('week'));
        return view('trainings.index', ['trainings' => $trainings, 'week' => (int)$request->query('week'), 'period' => $period ]);
    }



    public function create()
    {
        [$training_methods, $rooms, $trainers] = $this->trainingRepository->createTraining();

        //return response()->json($trainers);
        return view('trainings.create', [
            'training_methods' => $training_methods,
            'rooms' => $rooms,
            'trainers' => $trainers]);
    }

    public function show(Training $training)
    {
        $training = $this->trainingRepository->showTraining($training);


        //return response()->json($training);
        return view('trainings.show', ['training' => $training]);
    }

    public function store(Training $training)
    {
        $this->trainingRepository->storeTraining($training);
        return redirect('/trainings?week=0');
    }

    public function edit(Training $training)
    {
        [$training, $training_methods, $rooms, $trainers] = $this->trainingRepository->editTraining($training);
        Gate::authorize('edit', $training);

        return view('trainings.edit', [
            'training' => $training,
            'training_methods' => $training_methods,
            'rooms' => $rooms,
            'trainers' => $trainers]);
    }

    public function update(Training $training)
    {
        $training = $this->trainingRepository->updateTraining($training);
        Gate::authorize('edit', $training);

        return redirect('/trainings?week=0');
    }

    public function destroy(Training $training)
    {
        $this->trainingRepository->deleteTraining($training);

        return redirect('/trainings?week=0');
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
        $this->trainingRepository->joinTrainingById($user, $training);

        echo '<script>alert("Successfully joined the training.");
            window.location.href="/trainings";</script>';
    }

    public function cancelTrainingById(User $user, Training $training)
    {
        $trainees = $this->trainingRepository->getTraniees($user, $training);

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
