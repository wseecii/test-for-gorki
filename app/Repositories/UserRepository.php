<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function new(string $login, string $password, string $firstName, string $surname, ?string $lastName = null): User
    {
        $model = new User();
        $model->login = $login;
        $model->password = Hash::make($password);
        $model->first_name = $firstName;
        $model->surname = $surname;
        $model->last_name = $lastName;
        $model->save();

        return $model;
    }
}
