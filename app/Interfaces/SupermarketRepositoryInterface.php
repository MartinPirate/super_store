<?php

namespace App\Interfaces;

use Illuminate\Http\JsonResponse;

interface SupermarketRepositoryInterface
{

    public function index(): JsonResponse;

    public function getSupermarketById(int $id): JsonResponse;

    public function storeSuperMarket(array $supermarketData): JsonResponse;

    public function updateSuperMarket(array $supermarketData, int $supermarketId) : JsonResponse;

    public function deleteSupermarket(int $supermarketId) : JsonResponse;

    public function getSupermarketsByLocation(int $locationId) : JsonResponse;

    public function getSuperMarketByManagerId(int $managerId) : JsonResponse;


}
