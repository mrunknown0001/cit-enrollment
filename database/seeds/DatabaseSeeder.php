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

        DB::table('enrollment_settings')->insert([
            'active' => 0
        ]);

        DB::table('mode_of_payments')->insert([
            [
                'name' => 'Paypal'
            ],
            [
                'name' => 'Card Payment'
            ],
            [
                'name' => 'Over the Counter via Cashier'
            ]
        ]);

        DB::table('unit_prices')->insert([
            'amount' => 200
        ]);

        $this->call(SemesterSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(YearLevelSeeder::class);

    }
}
