<?php

namespace App\Services;

use App\Repository\LocationRepository;
use Illuminate\Http\JsonResponse;

class LocationService
{

    protected LocationRepository $repository;

    public function __construct(LocationRepository $locationRepository)
    {

        $this->repository = $locationRepository;
    }

    /**
     * Get Locations List
     * @return JsonResponse
     */
    public function getList(): JsonResponse
    {
        return $this->repository->getLocations();
    }

}
