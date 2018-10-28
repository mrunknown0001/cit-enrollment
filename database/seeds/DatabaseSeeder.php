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

        // DB::table('admins')->insert([
        // 	'username' => 'admin',
        // 	'password' => bcrypt('admin'),
        // 	'firstname' => 'John',
        //     'lastname' => 'Doe'
        // ]);

        // DB::table('enrollment_settings')->insert([
        //     'active' => 0
        // ]);

        // DB::table('mode_of_payments')->insert([
        //     [
        //         'name' => 'Paypal'
        //     ],
        //     [
        //         'name' => 'Card Payment'
        //     ],
        //     [
        //         'name' => 'Over the Counter via Cashier'
        //     ],
        //     [
        //         'name' => 'Paymaya Payment'
        //     ]
        // ]);

        // DB::table('unit_prices')->insert([
        //     'amount' => 200
        // ]);

        // DB::table('sections')->insert([
        //     [
        //         'name' => 'A'
        //     ],
        //     [
        //         'name' => 'B'
        //     ]
        // ]);

        // DB::table('student_limits')->insert([
        //     'limit' => 10
        // ]);


        // $this->call(UsersSeeder::class);
        // $this->call(YearLevelSeeder::class);
        // $this->call(SemesterSeeder::class);
        // $this->call(CourseSeeder::class);
        // $this->call(MajorSeeder::class);
        // $this->call(CurriculumSeeder::class);
        // $this->call(SubjectSeeder::class);
        $this->call(StudentTypeTableSeeder::class);

    }
}
