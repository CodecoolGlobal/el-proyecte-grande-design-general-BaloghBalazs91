<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{

    public function getAllUsers()
    {
        return User::all();

    }

      public function createUser(array $userDetails)
    {
        $userDetails['password'] = Hash::make($userDetails['password']);
        return User::create($userDetails);
    }

    public function updateUser(\App\Models\User $user, array $newDetails)
    {
        if (isset($newDetails['password'])) {
            $newDetails['password'] = Hash::make($newDetails['password']);
        }
        $user->update($newDetails);
        return $user;
    }

    public function deleteUser(\App\Models\User $user)
    {
        $user->delete();
    }
}
