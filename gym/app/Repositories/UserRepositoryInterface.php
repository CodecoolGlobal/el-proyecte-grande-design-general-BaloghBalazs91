<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
public function getAllUsers();
 public function createUser(array $userDetails);
 public function updateUser(User $user, array $newDetails);
 public function deleteUser(User $user);

}
