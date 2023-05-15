<?php

namespace App\Repository;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Transformers\LocationTransformer;
use App\Transformers\UserTransformer;
use Illuminate\Http\JsonResponse;

class UserRepository implements UserRepositoryInterface
{

    /**
     * Get all users
     * @return JsonResponse
     */
    public function getAllUsers(): JsonResponse
    {
        $users = User::all();

        return fractal()
            ->collection($users, new UserTransformer())
            ->respond(200, [], JSON_PRETTY_PRINT);

    }

    /**
     * Get Managers
     * @return JsonResponse
     */
    public function getManagers(): JsonResponse
    {
        $users = User::whereHasRole('manager')->get();

        return fractal()
            ->collection($users, new UserTransformer())
            ->respond(200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Get Employees
     * @return JsonResponse
     */
    public function getEmployees(): JsonResponse
    {
        $employeeRole = "cashiers" || "backoffice";

        $users = User::whereHasRole($employeeRole)->get();

        return fractal()
            ->collection($users, new UserTransformer())
            ->respond(200, [], JSON_PRETTY_PRINT);
    }
}
