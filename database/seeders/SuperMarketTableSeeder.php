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
        //todo add a location  dropdown
        $superMarket->location = "Nairobi";
        $superMarket->save();


        $superMarket->name= "new store";
        $superMarket->location = "Thika";
        $superMarket->save();

    }
}
