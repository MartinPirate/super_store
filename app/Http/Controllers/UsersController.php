<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UsersController extends Controller
{
    /**
     * Load manager Component
     * @return Response
     */
    public function managers(): Response
    {
        return Inertia::render("Users/Managers");
    }

    /**
     * Backoffice Component
     * @return Response
     */
    public function backoffice(): Response
    {
        return Inertia::render("Users/BackOffice");
    }

    /**
     * Cashiers Components
     * @return Response
     */
    public function cashiers(): Response
    {
        return Inertia::render("Users/Cashiers");
    }
}
