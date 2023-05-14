<?php

namespace App\Services;

use App\Repository\SupermarketRepository;
use Illuminate\Http\JsonResponse;

class SupermarketService
{
    protected SupermarketRepository $supermarketRepository;

    public function __construct(SupermarketRepository $repository)
    {
        $this->supermarketRepository = $repository;
    }

    /**
     * Get Supermarkets
     * @return JsonResponse
     */
    public function getSupermarkets(): JsonResponse
    {
        return $this->supermarketRepository->getList();
    }

    /**
     * create a supermarket
     * @param $supermarketData
     * @return JsonResponse
     */
    public function createSupermarket($supermarketData): JsonResponse
    {
        return $this->supermarketRepository->storeSuperMarket($supermarketData);
    }

    /**
     * Get a Supermarket BY Id
     * @param int $id
     * @return JsonResponse
     */
    public function getSupermarketById(int $id): JsonResponse
    {
        return $this->supermarketRepository->getSupermarketById($id);
    }

    /**
     * Update a Supermarket
     * @param int $id
     * @param $data
     * @return JsonResponse
     */
    public function updateSupermarket(int $id, $data): JsonResponse
    {
        return $this->supermarketRepository->updateSuperMarket($data, $id);
    }

    /**
     * Delete a Supermarket
     * @param int $id
     * @return JsonResponse
     */
    public function deleteSupermarket(int $id): JsonResponse
    {
        return $this->supermarketRepository->deleteSupermarket($id);
    }


}
