<?php

namespace App\Repository;

use App\Interfaces\SupplierRepositoryInterface;
use App\Models\Supermarket;
use App\Models\Supplier;
use App\Trait\ApiResponse;
use Illuminate\Http\JsonResponse;
use Spatie\SimpleExcel\SimpleExcelReader;

class SupplierRepository implements SupplierRepositoryInterface
{
    use ApiResponse;

    public function uploadSuppliers(int $supermarketId, $suppliersCSV): JsonResponse
    {
        $supermarket = Supermarket::whereId($supermarketId)->first();


        $rows = SimpleExcelReader::create($suppliersCSV, "csv")
            ->useHeaders([
                'Name' => 'name',
                'Phone' => 'phone',
                'Location' => 'location'
            ])
            ->getRows()
            ->each(function (array $rowProperties) {
                $this->saveSuppliers($rowProperties);
            });
        return $this->success("CSV uploaded successfully");
    }

    private function saveSuppliers($row)
    {
        $supplier = new Supplier();
        $supplier->name = $row['name'];
        $supplier->phone = $row['phone'];
        $supplier->supermarket_id = 1;
        $supplier->location_id = createLocationFromCSV($row['location']);
        $supplier->save();

    }
}
