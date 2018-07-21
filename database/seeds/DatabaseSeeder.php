<?php

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
        // $this->call(UsersTableSeeder::class);

        DB::table('admins')->insert([
        	'username' => 'admin',
        	'password' => bcrypt('admin'),
        	'firstname' => 'John',
            'lastname' => 'Doe'
        ]);
    }
}
