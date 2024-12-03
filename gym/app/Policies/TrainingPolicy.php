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

    public function join(User $user, Training $training) {
        if ($user->role !== 'user')
        {
            return false;
        }

        if ($training->trainees_count >= $training->capacity)
        {
            return false;
        }

        $traineeIds = $training->trainees()->select('users.id')->pluck('users.id')->toArray();
        if (in_array($user->id, $traineeIds))
        {
            return false;
        }

        return true;
    }

    public function cancel(User $user, Training $training){
        $traineeIds = $training->trainees()->select('users.id')->pluck('users.id')->toArray();
        if (in_array($user->id, $traineeIds))
        {
            return true;
        }
        return false;
    }
}
