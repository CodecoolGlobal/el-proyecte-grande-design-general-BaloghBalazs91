<?php

namespace App\Http\Controllers;

use App\Models\User;

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
}
