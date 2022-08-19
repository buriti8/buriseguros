<?php

use App\Models\City;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(PermissionHasRolesSeeder::class);
        $this->call(ListsSeeder::class);
        /* $this->call(ContactSeeder::class); */
    }
}
