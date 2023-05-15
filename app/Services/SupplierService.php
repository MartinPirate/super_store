<?php

namespace App\Services;

use App\Repository\SupplierRepository;

class SupplierService
{

    protected SupplierRepository $repo;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->repo = $supplierRepository;

    }

    public function uploadSuppliers(int $id, $file)
    {
        return $this->repo->uploadSuppliers($id, $file);
    }

}
