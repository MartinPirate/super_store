<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SupermarketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SupermarketController extends Controller
{

    protected SupermarketService $service;

    public function __construct(SupermarketService $supermarketService)
    {
        $this->service = $supermarketService;
    }

    /**
     *Get Supermarkets
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->service->getSupermarkets();

    }


    /**
     * Get Supermarket BY Id
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return $this->service->getSupermarketById($id);

    }

}
