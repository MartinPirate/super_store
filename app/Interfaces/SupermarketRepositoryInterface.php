<?php

namespace App\Interfaces;

use App\Models\Supermarket;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;


interface SupermarketRepositoryInterface
{

    public function getList(): Collection;

    public function getSupermarketById(int $id): Supermarket;

    public function storeSuperMarket(array $supermarketData): Supermarket;

    public function updateSuperMarket(array $supermarketData, int $supermarketId) : JsonResponse;

    public function deleteSupermarket(int $supermarketId) : JsonResponse;

    public function getSupermarketsByLocation(int $locationId) : JsonResponse;

    public function getSupermarketByManagerId(int $managerId) : JsonResponse;

    public function setManager(int $supermarketId, int $userId) : JsonResponse;



}
