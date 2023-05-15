<?php

namespace App\Interfaces;

use Illuminate\Http\JsonResponse;

interface SupplierRepositoryInterface
{
    public function uploadSuppliers(int $supermarketId,  $suppliersCSV) : JsonResponse;

}
