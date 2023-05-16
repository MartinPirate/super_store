<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSupermarketRequest;
use App\Http\Requests\UpdateSupermarketRequest;
use App\Http\Requests\UploadSupplierCSVRequest;
use App\Jobs\ProcessCsvUpload;
use App\Services\SupermarketService;
use App\Services\SupplierService;
use App\Trait\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\SimpleExcel\SimpleExcelReader;

class SupermarketController extends Controller
{

    use  ApiResponse;

    protected SupermarketService $service;
    protected SupplierService $supplierService;

    public function __construct(SupermarketService $supermarketService, SupplierService $supplierService)
    {
        $this->service = $supermarketService;
        $this->supplierService = $supplierService;
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


    public function uploadSuppliers(UploadSupplierCSVRequest $request): JsonResponse
    {

        $supermarketId = $request->get('id');
        $supplierCSV = $request->file('file');

        $fileName = $supplierCSV->store('csvfiles', 'local');

        $job = new ProcessCsvUpload($supermarketId, $fileName);
        dispatch($job);

        return $this->success("CSV data has been queued for processing.");


    }

}
