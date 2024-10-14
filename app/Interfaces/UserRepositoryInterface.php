<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * @param string $login
     * @param string $password
     * @param string $firstName
     * @param string $surname
     * @param string|null $lastName
     * @return User
     */
    public function new(string $login, string $password, string $firstName, string $surname, ?string $lastName = null): User;
}
