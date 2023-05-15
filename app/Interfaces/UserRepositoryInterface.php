<?php

namespace App\Interfaces;

use Illuminate\Http\JsonResponse;

interface UserRepositoryInterface
{
    public function getAllUsers(): JsonResponse;

    public function getManagers(): JsonResponse;

    public function getEmployees(): JsonResponse;
}
