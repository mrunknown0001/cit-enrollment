<?php

use Illuminate\Database\Seeder;

class YearLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('year_levels')->insert([
        	[
        		'name' => 'Grade 7'
        	],
        	[
        		'name' => 'Grade 8'
        	],
        	[
        		'name' => 'Grade 9'
        	],
        	[
        		'name' => 'Grade 10'
        	],
            [
                'name' => 'Grade 11',
            ],
            [
                'name' => 'Grade 12',
            ],
        ]);
    }
}
