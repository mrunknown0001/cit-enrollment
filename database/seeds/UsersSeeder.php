<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('deans')->insert([
            'username' => 'principal',
            'password' => bcrypt('password'),
            'firstname' => 'John',
            'lastname' => 'Principal'
        ]);

        DB::table('registrars')->insert([
        	'username' => 'registrar',
        	'password' => bcrypt('password'),
        	'firstname' => 'John',
        	'lastname' => 'Registrar'
        ]);

        DB::table('cashiers')->insert([
        	'username' => 'cashier',
        	'password' => bcrypt('password'),
        	'firstname' => 'John',
        	'lastname' => 'Cashier'
        ]);

        DB::table('faculties')->insert([
        	'username' => 'faculty',
        	'password' => bcrypt('password'),
        	'firstname' => 'John',
        	'lastname' => 'Faculty'
        ]);
    }
}
