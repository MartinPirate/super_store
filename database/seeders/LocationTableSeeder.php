<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            [
                'name' => 'Nairobi'
            ],
            [
                'name' => 'Thika'
            ],

            [
                'name' =>   'Nyeri'
            ],

            [
                'name' => 'Karatina'
            ],

            [
                'name' =>   'Kiambuu'
            ],

        ];

        foreach ($locations as $location) {
            Location::create([
                'name' => $location['name']
            ]);
        }


    }
}
