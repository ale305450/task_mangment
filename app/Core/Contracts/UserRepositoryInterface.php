<?php

namespace App\Core\Contracts;

use App\Core\Dtos\Users\LoginDTO;
use App\Core\Dtos\Users\RegisterDTO;
use App\Core\Entities\User;

interface UserRepositoryInterface
{
    public function login(LoginDTO $loginDTO): string;
    public function register(RegisterDTO $registerDTO): User;
}
