<?php

use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
        	[
        		'code' => 'ENG 1',
        		'description' => 'Communication Arts 1',
        		'units' => 3,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 1,
        		'semester_id' => 1
        	],
        	[
        		'code' => 'FIL 1',
        		'description' => 'Komunikasyon sa Akademikong Pilipino',
        		'units' => 3,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 1,
        		'semester_id' => 1
        	]
        ]);
    }
}
