<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' => 'Victor Zamora',
            'email' => 'secretario@gmail.com',
            'password' => bcrypt('secretario123'),
            'tel' => '3354243786',
            'auth' => 1,
            'role' => 1
        ]);

        User::create([
        	'name' => 'Jorge Zepeda',
            'email' => 'planeacion@gmail.com',
            'password' => bcrypt('planeacion123'),
            'tel' => '3165896745',
            'auth' => 1,
            'role' => 2
        ]);

        User::create([
        	'name' => 'Janeth Leyva',
            'email' => 'finanzas@gmail.com',
            'password' => bcrypt('finanzas123'),
            'tel' => '3312345523',
            'auth' => 1,
            'role' => 3
        ]);

        User::create([
        	'name' => 'Oscar Mendoza',
            'email' => 'compras@gmail.com',
            'password' => bcrypt('compras123'),
            'tel' => '3312345523',
            'auth' => 1,
            'role' => 4
        ]);

        User::create([
        	'name' => 'Gilberto Reyes',
            'email' => 'profesor@gmail.com',
            'password' => bcrypt('profesor123'),
            'tel' => '3310103412',
            'auth' => 1,
            'role' => 5
        ]);
    }
}
