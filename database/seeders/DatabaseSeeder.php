<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Supermarket;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(LaratrustSeeder::class);
        $this->call(SuperMarketTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(SupplierTableSeeder::class);
    }
}
