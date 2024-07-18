<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\User;
use App\Repositories\TrainerRepository\TrainerRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrainerController extends UserController
{
    public function __construct(private TrainerRepositoryInterface $trainerRepository)
    {
    }

    public function index()
    {
        $trainers = $this->trainerRepository->index();
        return view('trainers.index', ['trainers' => $trainers]);
    }

    public function create()
    {

    }

    public function show($id)
    {
        $trainer = $this->trainerRepository->show($id);

        if ($trainer->role !== 'trainer') {
            abort(403);
        }

        return view('trainers.show', ['trainer' => $trainer]);
    }

//    public function edit($id)
//    {
//        $trainer = User::where('id', $id)
//            ->with(['trainingMethods' => function ($query) {
//                $query->select('training_method_id', 'name'); // Select only 'id' and 'name' from training methods
//            }])
//            ->first();
//
//        return view('trainers.edit', ['trainer' => $trainer]);
//    }



//    public function create(Request $request)
//    {
//        var_dump("This runs");
//        $userId = $request->input('id');
//        var_dump($userId);
//        $user = User::where('role', 'trainer')->find($userId);
//        $training = DB::table('trainings')->insert([
//            'start',
//            'duration',
//            'trainer_id',
//            'room_id',
//            'capacity',
//            'training_method_id'
//        ]);
//    }
}
