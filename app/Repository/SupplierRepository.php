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

        $file = storage_path('app/' . $suppliersCSV);

        SimpleExcelReader::create($file, "csv")
            ->useHeaders([
                'Name' => 'name',
                'Phone' => 'phone',
                'Location' => 'location'
            ])
            ->getRows()
            ->each(function (array $rowProperties) use ($supermarketId) {
                $this->saveSuppliers($rowProperties, $supermarketId);
            });
        return $this->success("CSV data has been uploaded and queued for processing.");
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
