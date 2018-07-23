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
        		'name' => 'First Year'
        	],
        	[
        		'name' => 'Second Year'
        	],
        	[
        		'name' => 'Third Year'
        	],
        	[
        		'name' => 'Fourth Year'
        	]
        ]);
    }
}
