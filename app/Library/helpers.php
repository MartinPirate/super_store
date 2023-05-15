<?php


use App\Models\Location;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Carbon;

if (!function_exists('format_date')) {
    /**
     * Format date
     * @param string $date
     * @return string
     */
    function format_date(string $date): string
    {
        $date = Carbon::parse($date);
        if (!$date) {
            return 'No date Found';
        }
        return $date->format('j-F-Y');
    }
}

if (!function_exists('getCount')) {
    /**
     * Get Json Data Count
     * @param $data
     * @return int
     */
    function getCount($data): int
    {
        $data = json_decode($data, true);
        return count($data);
    }
}

if (!function_exists('makeManager')) {
    /**
     * Set the new Role to Manager
     * @param $userId
     * @return bool
     */
    function makeManager($userId): bool
    {
        $user = User::whereId($userId)->first();
        if ($user->hasRole('manager')) {
            return true;
        } else {
            $user->addRole('manager');

        }
        return true;

    }

}

if (!function_exists('validateSupplierCSVRow')) {
    function validateSupplierCSVRow($row): bool
    {
        $supplierName = $row['name'];
        $supplierPhone = $row['phone'];

        // check if the supplier with the given name and phone exists in the database
        $supplier = Supplier::where('name', $supplierName)
            ->where('phone', $supplierPhone)
            ->first();

        if ($supplier) {
            return true; // validation passed
        } else {
            return false; // validation failed
        }
    }
}

if (!function_exists('createLocationFromCSV'))
{
    function createLocationFromCSV(string $location)
    {
        $location = Location::firstOrCreate([
            'name' => $location
        ]);
        return $location->id;

    }
}

