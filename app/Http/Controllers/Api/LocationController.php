<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\LocationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    protected LocationService $service;

    public function __construct(LocationService $locationService)
    {
        $this->service = $locationService;
    }

    /**
     * Get Locations
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->service->getList();
    }

}

