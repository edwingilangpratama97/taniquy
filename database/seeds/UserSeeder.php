<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' => 'Admin',
        	'email' => 'admin@makerindo.com',
        	'role' => 'admin',
        	'password' => Hash::make('12341234'),
        ]);

        User::create([
        	'name' => 'Kelompok Tani',
        	'email' => 'kelompok@makerindo.com',
        	'id_kelompok' => 1,
        	'role' => 'kelompok',
        	'password' => Hash::make('12341234'),
        ]);

        User::create([
        	'name' => 'Retailer',
        	'email' => 'retailer@makerindo.com',
        	'id_retailer' => 1,
        	'role' => 'retailer',
        	'password' => Hash::make('12341234'),
        ]);

        User::create([
        	'name' => 'Enduser',
        	'email' => 'enduser@makerindo.com',
        	'id_enduser' => 1,
        	'role' => 'enduser',
        	'password' => Hash::make('12341234'),
        ]);
    }
}
