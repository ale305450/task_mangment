<?php

namespace App\Infrastructure\Repositories;

use App\Core\Contracts\UserRepositoryInterface;
use App\Core\Dtos\Users\LoginDTO;
use App\Core\Dtos\Users\RegisterDTO;
use App\Core\Entities\User;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    public function register(RegisterDTO $registerDTO): User
    {
        return User::create(
            [
                'name' => $registerDTO->name,
                'email' => $registerDTO->email,
                'password' => $registerDTO->password,
            ]
        );
    }
    public function login(LoginDTO $loginDTO): string
    {
        if (Auth::attempt([
            'email' => $loginDTO->email,
            'password' => $loginDTO->password,
        ])) {
            $user = $this->findUser($loginDTO->email);
            return $this->createToken($user);
        } else {
            return 'There is error in email or password';
        }
    }
    private function findUser($email): User
    {
        return User::where('email', $email)->first();
    }
    private function createToken(User $user): string
    {
        return $user->createToken('auth_token')->plainTextToken;
    }
}
