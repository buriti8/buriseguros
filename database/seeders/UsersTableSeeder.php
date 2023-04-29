<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrador',
            'username' => 'admin',
            'password' => bcrypt('Admin$%'),
            'email' => 'info@buriseguros.com.co',
            'is_admin' => 1,
        ]);

        $user = User::where('username', 'admin')->first();
        $user->assignRole('Administrador');
    }
}
