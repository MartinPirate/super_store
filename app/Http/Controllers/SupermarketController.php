<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSupermarketRequest;
use App\Http\Requests\UpdateSupermarketRequest;
use App\Services\SupermarketService;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Inertia\Response;

class SupermarketController extends Controller
{
    protected SupermarketService $service;

    public function __construct(SupermarketService $supermarketService)
    {
        $this->service = $supermarketService;
    }

    /**
     *Get Supermarkets Page
     * @return Response
     */
    public function index(): Response
    {

        return Inertia::render('Supermarkets/Index');
    }



}
