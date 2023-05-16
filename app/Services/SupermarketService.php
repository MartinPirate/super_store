<?php

namespace App\Services;

use App\Repository\SupermarketRepository;
use App\Transformers\SupermarketTransformer;
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
        $superMarkets = $this->supermarketRepository->getList();

        return fractal()
            ->collection($superMarkets, new SupermarketTransformer())
            ->respond(200, [], JSON_PRETTY_PRINT);
    }

    /**
     * create a supermarket
     * @param $supermarketData
     * @return JsonResponse
     */
    public function createSupermarket($supermarketData): JsonResponse
    {

        $supermarket =  $this->supermarketRepository->storeSuperMarket($supermarketData);

        return fractal()
            ->item($supermarket, new SupermarketTransformer)
            ->respond(200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Get a Supermarket BY Id
     * @param int $id
     * @return JsonResponse
     */
    public function getSupermarketById(int $id): JsonResponse
    {
        $supermarket = $this->supermarketRepository->getSupermarketById($id);

        return fractal()
            ->parseIncludes(['employees', 'suppliers'])
            ->item($supermarket, new SupermarketTransformer)
            ->respond(200, [], JSON_PRETTY_PRINT);
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
