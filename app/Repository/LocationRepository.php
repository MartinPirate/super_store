<?php

namespace App\Repository;

use App\Interfaces\LocationRepositoryInterface;
use App\Models\Location;
use App\Transformers\LocationTransformer;
use Illuminate\Http\JsonResponse;

class LocationRepository implements LocationRepositoryInterface
{

    /**
     * Get Locations
     * @return JsonResponse
     */
    public function getLocations(): JsonResponse
    {
        $locations = Location::all();
        return fractal()
            ->collection($locations, new LocationTransformer())
            ->respond(200, [], JSON_PRETTY_PRINT);
    }
}
