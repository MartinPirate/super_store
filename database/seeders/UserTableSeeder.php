<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Inertia\Testing\Concerns\Has;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //admin

        $adminRole = Role::whereName('admin')->first();

        $admin = new User();
        $admin->name = "Admin SuperStore";
        $admin->email = "admin@superstore.test";
        $admin->gender = "Female";
        $admin->phone = "254711224455";
        $admin->location_id = 1;
        $admin->password = Hash::make('P@ssw0rd');
        $admin->save();

        $admin->addRole($adminRole);

        //supermarket one manager

        $managerRole = Role::whereName('manager')->first();

        $manager = new User();
        $manager->name = "Manager SuperStore";
        $manager->gender = "Male";
        $manager->email = "manager@superstore.test";
        $manager->location_id = 2;
        $manager->phone = "254711288955";
        $manager->password = Hash::make('P@ssw0rd');

        $manager->supermarket_id = 1;

        $manager->save();

        $manager->addRole($managerRole);


        $manager2 = new User();
        $manager2->name = "Manager newstore";
        $manager2->gender = "Female";
        $manager2->location_id = 3;
        $manager2->email = "manager@newstore.test";
        $manager2->phone = "254711228877";
        $manager2->password = Hash::make('P@ssw0rd');

        $manager2->supermarket_id = 2;

        $manager2->save();

        $manager2->addRole($managerRole);

        //employee cashier supermarket one

        $cashierRole = Role::whereName('cashier')->first();

        $cashier = new User();
        $cashier->name = "Cashier A";
        $cashier->email = "cashier_a@newstore.test";
        $cashier->gender = "Female";
        $cashier->phone = "254701000090";
        $cashier->location_id =2;
        $cashier->password = Hash::make("P@ssw0rd");

        $cashier->supermarket_id = 2;

        $cashier->save();

        $cashier->addRole($cashierRole);


        $cashierMike = new User();
        $cashierMike->name = "Cashier A";
        $cashierMike->email = "mike@superstore.test";
        $cashierMike->gender = "Male";
        $cashierMike->phone = "254701009009";
        $cashierMike->location_id = 3;
        $cashierMike->password = Hash::make("P@ssw0rd");

        $cashierMike->supermarket_id = 1;

        $cashierMike->save();

        $cashierMike->addRole($cashierRole);


        //backoffice roles
        $backofficeRole = Role::whereName('backoffice')->first();


        $backOfficeSuperStore = new User();
        $backOfficeSuperStore->name = "Back Super";
        $backOfficeSuperStore->email = "backsupper@superstore.test";
        $backOfficeSuperStore->gender = "Male";
        $backOfficeSuperStore->location_id = 4;
        $backOfficeSuperStore->phone = "254701909070";
        $backOfficeSuperStore->password = Hash::make("P@ssw0rd");

        $backOfficeSuperStore->supermarket_id = 1;

        $backOfficeSuperStore->save();

        $backOfficeSuperStore->addRole($backofficeRole);


        $backStoreNewStore = new User();
        $backStoreNewStore->name = "Back Manager";
        $backStoreNewStore->email = "bmanager@new.test";
        $backStoreNewStore->gender = "Female";
        $backStoreNewStore->phone = "254701999008";
        $backStoreNewStore->location_id =2;

        $backStoreNewStore->password = Hash::make("P@ssw0rd");

        $backStoreNewStore->supermarket_id = 2;

        $backStoreNewStore->save();

        $backStoreNewStore->addRole($backofficeRole);


    }
}
