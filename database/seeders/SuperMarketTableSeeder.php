<?php

namespace Database\Seeders;

use App\Models\Supermarket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperMarketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superMarket = new Supermarket();
        $superMarket->name = "Super Store";
        $superMarket->location_id =1;
        $superMarket->save();

        $superMarket = new Supermarket();
        $superMarket->name= "new store";
        $superMarket->location_id = 2;
        $superMarket->save();

    }
}
