<?php

namespace App\Core\Contracts;

use App\Core\Dtos\Users\LoginDTO;
use App\Core\Dtos\Users\RegisterDTO;
use App\Core\Entities\User;
use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function register(RegisterDTO $registerDTO): User;
    public function login(LoginDTO $loginDTO): string;
    public function logout(Request $request);
}
