<?php

namespace App\Services;

use App\Models\User;

class RegisterService
{
    public function __construct(private User $user)
    {
        //
    }

    public function register($data): true
    {
        auth()->login($this->user->create($data));

        return true;
    }
}
