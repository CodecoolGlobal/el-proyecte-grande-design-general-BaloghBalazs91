<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrainerController extends UserController
{

    public function getAll()
    {
        $trainers = User::where('role', 'trainer')->get();
        return response()->json($trainers);
    }

    public function getById(int $id)
    {
        $trainer = User::where('role', 'trainer')->where('id', $id)->first();
        return response()->json($trainer);
    }

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
