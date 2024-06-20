<?php

namespace App\Policies;

use App\Models\Training;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TrainingPolicy
{
    public function edit(User $user, Training $training){
        return $training->trainer->is($user);
    }
}
