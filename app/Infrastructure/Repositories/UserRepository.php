<?php

namespace App\Infrastructure\Repositories;

use App\Core\Contracts\UserRepositoryInterface;
use App\Core\Dtos\Users\LoginDTO;
use App\Core\Dtos\Users\RegisterDTO;
use App\Core\Entities\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    public function register(RegisterDTO $registerDTO): User
    {
        $user = User::create(
            [
                'name' => $registerDTO->name,
                'email' => $registerDTO->email,
                'password' => $registerDTO->password,
            ]
        );
        $user->assignRole('Employee');
        return $user;
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
    public function logout(Request $request)
    {
        //logout out the current user
        Auth::logout();

        $request->session()->flush();
        $request->session()->regenerate();
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
