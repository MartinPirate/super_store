<?php

namespace App\Services;

use App\Repository\UserRepository;
use Illuminate\Http\JsonResponse;

class UserService
{
    protected UserRepository $repository;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;

    }

    public function getList(): JsonResponse
    {
        return $this->repository->getAllUsers();

    }
}
