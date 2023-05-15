<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSupermarketRequest;
use App\Http\Requests\UpdateSupermarketRequest;
use App\Services\SupermarketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SupermarketController extends Controller
{

    protected SupermarketService $service;

    public function __construct(SupermarketService $supermarketService)
    {
        $this->service = $supermarketService;
    }

    /**
     *Get Supermarkets
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->service->getSupermarkets();

    }


    /**
     * Get Supermarket BY Id
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return $this->service->getSupermarketById($id);

    }


    /**
     * Create a Supermarket
     * @param CreateSupermarketRequest $request
     * @return JsonResponse
     */
    public function store(CreateSupermarketRequest $request): JsonResponse
    {

        $data = [
            'name' => $request->get('name'),
            'location_id' => $request->get('location_id')
        ];

        /*
         *   $managerId = $request->get('manager_id');
         if ($managerId)
           {
              $data['manager_id'] = $managerId;
           }*/


        return $this->service->createSupermarket($data);
    }


    /**
     * Update Supermarket
     * @param UpdateSupermarketRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateSupermarketRequest $request, int $id): JsonResponse
    {

        $data = [
            'name' => $request->get('name'),
            'location_id' => $request->get('location_id'),
        ];
        return $this->service->updateSupermarket($id, $data);

    }

    /**
     * Delete a Supermarket
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return $this->service->deleteSupermarket($id);
    }

}
