<?php

use Illuminate\Database\Seeder;
use App\User;

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
            'email' => 'admin@buriseguros.com.co',
            'is_admin' => 1
        ]);

        $user = User::where('username', 'admin')->first();
        $user->assignRole('Administrador');
    }
}
