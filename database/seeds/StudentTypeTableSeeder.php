<?php

use Illuminate\Database\Seeder;

class StudentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('student_types')->insert([
        	[
        		'name' => 'regular'
        	],
        	[
        		'name' => 'irregular'
        	]
        ]);
    }
}
