<?php

namespace App\Repository;

use App\Interfaces\SupermarketRepositoryInterface;
use App\Models\Supermarket;
use App\Trait\ApiResponse;
use App\Transformers\SupermarketTransformer;
use Doctrine\DBAL\Exception;
use Illuminate\Http\JsonResponse;
use phpDocumentor\Reflection\Location;

class SupermarketRepository implements SupermarketRepositoryInterface
{
    use ApiResponse;

    public function index(): JsonResponse
    {

        $superMarkets = Supermarket::all();

        return fractal()
            ->collection($superMarkets, new SupermarketTransformer())
            ->respond(200, [], JSON_PRETTY_PRINT);


    }

    public function getSupermarketById(int $id): JsonResponse
    {
        $supermarket = Supermarket::whereId($id)->first();

        return fractal()
            ->item($supermarket, new SupermarketTransformer)
            ->respond(200, [], JSON_PRETTY_PRINT);


    }

    public function storeSuperMarket(array $supermarketData): JsonResponse
    {
        try {
            $supermarket = Supermarket::create($supermarketData);

        } catch (Exception $exception) {
            return $this->error($exception->getMessage(), $exception->getCode());
        }
        return fractal()
            ->item($supermarket, new SupermarketTransformer)
            ->respond(200, [], JSON_PRETTY_PRINT);

    }

    public function updateSuperMarket(array $supermarketData, int $supermarketId): JsonResponse
    {
        $superMarket = Supermarket::whereId($supermarketId)->first();
        $superMarket?->update($supermarketData);
        return $this->success("Supermarket Updated Successfully");
    }

    public function deleteSupermarket(int $supermarketId): JsonResponse
    {
        $superMarket = Supermarket::whereId($supermarketId)->first();
        if ($superMarket->deleted_at !== null) {
            return $this->error("Supermarket Already Deleted", 404);
        }
        $superMarket?->delete();

    }

    public function getSupermarketsByLocation(int $locationId): JsonResponse
    {
    }

    public function getSuperMarketByManagerId(int $managerId): JsonResponse
    {
        // TODO: Implement getSuperMarketByManagerId() method.
    }
}
