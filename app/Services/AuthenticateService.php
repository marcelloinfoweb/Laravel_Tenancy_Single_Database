<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthenticateService
{
    public function __construct(private User $user)
    {
    }

    public function login($credentials): true
    {
        $user = $this->user
            ->where('store_id', $credentials['store_id'])
            ->where('tenant_id', $credentials['tenant_id'])
            ->where('email', $credentials['email'])
            ->first();

        if (! $user) {
            throw new UnauthorizedHttpException('Credênciais Inválidas');
        }

        if (! Hash::check($credentials['password'], $user->password)) {
            throw new UnauthorizedHttpException('Credênciais Inválidas');
        }

        auth()->login($user);

        return true;
    }
}
