<?php

use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('course_majors')->insert([
        	[
        		'name' => 'Major In English',
        		'course_id' => 1
        	]
        ]);
    }
}
