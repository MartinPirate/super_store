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

        SimpleExcelReader::create($suppliersCSV, "csv")
            ->useHeaders([
                'Name' => 'name',
                'Phone' => 'phone',
                'Location' => 'location'
            ])
            ->getRows()
            ->each(function (array $rowProperties) use ($supermarketId) {
                $this->saveSuppliers($rowProperties, $supermarketId);
            });
        return $this->success("CSV uploaded successfully");
    }

    private function saveSuppliers($row, $id): void
    {

        Supplier::updateOrCreate(
            ['name' => $row['name']],
            ['phone' => $row['phone']],
            ['supermarket_id' => $id],
            ['location_id' => createLocationFromCSV($row['location'])],
        );

    }
}
