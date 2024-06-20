<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrainerController extends UserController
{

    public function index()
    {
        $trainers = User::where('role', 'trainer')
            ->with(['trainingMethods' => function ($query) {
                $query->select('name');
            }])
            ->get();
        //return response()->json($trainers);
        return view('trainers.index', ['trainers' => $trainers]);
    }

    public function create()
    {

    }

    public function show($id)
    {
        $trainer = User::where('id', $id)
            ->with(['trainingMethods' => function ($query)
            {
               $query->select('name');
            }])
            ->with(['trainings' => function ($query) {
                $query->where('start', '>=', Carbon::now())
                    ->with('trainingMethod')
                    ->withCount('trainees')
                    ->orderBy('start');
            }])
            ->get()->first();


        if ($trainer->role !== 'trainer') {
            abort(403);
        }

        //return response()->json(['trainer' => $trainer]);
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
