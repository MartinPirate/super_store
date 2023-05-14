<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supplier = new Supplier();

        $supplier->name = "Mark Logistics";
        $supplier->phone = "254701020304";
        $supplier->location_id = 4;
        $supplier->supermarket_id = 1;
        $supplier->save();


        $supplier->name = "Martin May";
        $supplier->phone = "254701020890";
        $supplier->location_id = 3;
        $supplier->supermarket_id = 2;
        $supplier->save();


    }
}
