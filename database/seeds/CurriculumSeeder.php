<?php

use Illuminate\Database\Seeder;

class CurriculumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('curricula')->insert([
        	'name' => '2011',
        	'course_id' => 1,
            'major_id' => 1
        ]);
    }
}
