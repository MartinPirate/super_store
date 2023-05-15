<?php

namespace App\Interfaces;

use Illuminate\Http\JsonResponse;

interface LocationRepositoryInterface
{
    public function getLocations() : JsonResponse;
}
