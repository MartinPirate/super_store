<?php

namespace App\Services;

use App\Repository\SupplierRepository;
use Illuminate\Http\JsonResponse;

class SupplierService
{

    protected SupplierRepository $repo;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->repo = $supplierRepository;

    }

    public function uploadSuppliers(int $id, $file): JsonResponse
    {
        return $this->repo->uploadSuppliers($id, $file);
    }

}
