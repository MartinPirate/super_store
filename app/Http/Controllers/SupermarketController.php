<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSupermarketRequest;
use App\Http\Requests\UpdateSupermarketRequest;
use App\Services\SupermarketService;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Inertia\Response;

class SupermarketController extends Controller
{
    protected SupermarketService $service;

    public function __construct(SupermarketService $supermarketService)
    {
        $this->service = $supermarketService;
    }

    /**
     *Get Supermarkets
     * @return Response
     */
    public function index(): Response
    {
        $supermarkets = $this->service->getSupermarkets();

        return Inertia::render('Users/Index', [
            'supermarkets' => $supermarkets
        ]);
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

        return $this->service->createSupermarket($data);
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
     * Update Supermarket
     * @param UpdateSupermarketRequest $request
     * @return JsonResponse
     */
    public function update(UpdateSupermarketRequest $request): JsonResponse
    {
        $supermarketId = $request->get('id');

        $data = [
            'name' => $request->get('name'),
            'location_id' => $request->get('location_id'),
        ];
        return $this->service->updateSupermarket($supermarketId, $data);

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