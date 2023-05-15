<?php

namespace App\Repository;

use App\Interfaces\SupermarketRepositoryInterface;
use App\Models\Supermarket;
use App\Models\User;
use App\Trait\ApiResponse;
use App\Transformers\SupermarketTransformer;
use Doctrine\DBAL\Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use phpDocumentor\Reflection\Location;

class SupermarketRepository implements SupermarketRepositoryInterface
{
    use ApiResponse;

    /**
     * Get a List of Supermarkets
     * @return JsonResponse
     */
    public function getList(): JsonResponse
    {

        $superMarkets = Supermarket::all();

        return fractal()
            ->collection($superMarkets, new SupermarketTransformer())
            ->respond(200, [], JSON_PRETTY_PRINT);


    }

    /**
     * Get Supermarket By Id
     * @param int $id
     * @return JsonResponse
     */
    public function getSupermarketById(int $id): JsonResponse
    {
        try {
            $supermarket = Supermarket::whereId($id)->first();

        } catch (ModelNotFoundException $exception) {
            return $this->error("Supermarket Not Found", 404);
        }

        return fractal()
            ->parseIncludes(['employees', 'suppliers'])
            ->item($supermarket, new SupermarketTransformer)
            ->respond(200, [], JSON_PRETTY_PRINT);


    }

    /**
     * Creaete a Supermarket
     * @param array $supermarketData
     * @return JsonResponse
     */
    public function storeSuperMarket(array $supermarketData): JsonResponse
    {
       // $managerId = $supermarketData['manager_id'];

        try {
            $supermarket = Supermarket::create($supermarketData);

        } catch (Exception $exception) {
            return $this->error($exception->getMessage(), $exception->getCode());
        }
      /*  if ($managerId) {
            $this->setManager($supermarket->id, $managerId);

        }*/

        return fractal()
            ->item($supermarket, new SupermarketTransformer)
            ->respond(200, [], JSON_PRETTY_PRINT);

    }

    /**
     * Update a Supermarket
     * @param array $supermarketData
     * @param int $supermarketId
     * @return JsonResponse
     */
    public function updateSuperMarket(array $supermarketData, int $supermarketId): JsonResponse
    {
        try {
            $superMarket = Supermarket::whereId($supermarketId)->first();
            $superMarket?->update($supermarketData);

        } catch (ModelNotFoundException $exception) {
            return $this->error("Supermarket Not Found", 404);
        }


        return $this->success("Supermarket Updated Successfully");
    }

    /**
     * Delete a Supermarket Object
     * @param int $supermarketId
     * @return JsonResponse
     */
    public function deleteSupermarket(int $supermarketId): JsonResponse
    {
        try {
            $superMarket = Supermarket::whereId($supermarketId)->first();

            if ($superMarket->deleted_at !== null) {
                return $this->error("Supermarket Already Deleted", 404);
            }
            $superMarket?->delete();

        } catch (ModelNotFoundException $exception) {
            return $this->error("Supermarket Not Found");
        }

        return $this->success("Supermarket Deleted Successfully");

    }

    /**
     * Get all supermarkets in a certain location
     * @param int $locationId
     * @return JsonResponse
     */
    public function getSupermarketsByLocation(int $locationId): JsonResponse
    {
        try {
            $location = \App\Models\Location::whereId($locationId)->first();

        } catch (ModelNotFoundException $exception) {

            return $this->error("Location Not Found");

        }

        $supermarkets = $location->supermarkets;

        return fractal()
            ->collection($supermarkets, new SupermarketTransformer())
            ->respond(200, [], JSON_PRETTY_PRINT);


    }

    /**
     * Get Supermarkets run by a manager
     * @param int $managerId
     * @return JsonResponse
     */
    public function getSupermarketByManagerId(int $managerId): JsonResponse
    {
        try {
            $manager = User::whereId($managerId)->first();

        } catch (ModelNotFoundException $exception) {
            return $this->error("Manager Not Found");

        }

        $supermarkets = $manager->supermarkets;

        return fractal()
            ->collection($supermarkets, new SupermarketTransformer())
            ->respond(200, [], JSON_PRETTY_PRINT);

    }

    /**
     * Set a Manager
     * @param int $supermarketId
     * @param int $userId
     * @return JsonResponse
     */
    public function setManager(int $supermarketId, int $userId): JsonResponse
    {
        makeManager($userId);

        try {
            $user = User::whereId($userId)->first();
            $user->update([
                'supermarket_id' => $supermarketId
            ]);

        } catch (ModelNotFoundException $exception) {
            return $this->error("User does not exist in the database");
        }

        return $this->success("manager set Successfully");
    }


}
