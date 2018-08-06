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
        	],
        	[
        		'code' => 'MATH 1',
        		'description' => 'Fundamentals of Math',
        		'units' => 3,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 1,
        		'semester_id' => 1
        	],
        	[
        		'code' => 'NAT SC 1',
        		'description' => 'Physical Science w/ Earth Science',
        		'units' => 3,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 1,
        		'semester_id' => 1
        	],
        	[
        		'code' => 'PSYCHO 1',
        		'description' => 'Gen Psycho w/ HIV, SARS Educ / FP',
        		'units' => 3,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 1,
        		'semester_id' => 1
        	],
        	[
        		'code' => 'HUM 1',
        		'description' => 'Arts, Man & Society',
        		'units' => 3,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 1,
        		'semester_id' => 1
        	],
        	[
        		'code' => 'SOC SC 1',
        		'description' => 'Philippine History: Roots & Devt',
        		'units' => 3,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 1,
        		'semester_id' => 1
        	],
        	[
        		'code' => 'CS 1',
        		'description' => 'Basic Computer Applications',
        		'units' => 3,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 1,
        		'semester_id' => 1
        	],
        	[
        		'code' => 'PE 1',
        		'description' => 'Physical Fitnes',
        		'units' => 2,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 1,
        		'semester_id' => 1
        	],
        	[
        		'code' => 'NSTP 1',
        		'description' => 'Civic Welfare Training Service w/ Anti-Smoking Seminar',
        		'units' => 3,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 1,
        		'semester_id' => 1
        	],
        	[
        		'code' => 'ENG 2',
        		'description' => 'Communication Arts 2',
        		'units' => 3,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 1,
        		'semester_id' => 2
        	],
        	[
        		'code' => 'FIL 2',
        		'description' => 'Pagbasa at Pagsulat tungo sa Pananaliksik',
        		'units' => 3,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 1,
        		'semester_id' => 2
        	],
        	[
        		'code' => 'MATH 2',
        		'description' => 'Contemporary Math',
        		'units' => 3,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 1,
        		'semester_id' => 2
        	],
        	[
        		'code' => 'NAT SC 2',
        		'description' => 'Biological Science',
        		'units' => 3,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 1,
        		'semester_id' => 2
        	],
        	[
        		'code' => 'SOC SC 2',
        		'description' => 'Phil Govt & New constitution',
        		'units' => 3,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 1,
        		'semester_id' => 2
        	],
        	[
        		'code' => 'HUM 2',
        		'description' => 'Fundamentals of Music',
        		'units' => 3,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 1,
        		'semester_id' => 2
        	],
        	[
        		'code' => 'ECON 1',
        		'description' => 'Principles of Economics w/ TLR',
        		'units' => 3,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 1,
        		'semester_id' => 2
        	],
        	[
        		'code' => 'EDUC 1',
        		'description' => 'The social Dimensions of Educ',
        		'units' => 3,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 1,
        		'semester_id' => 2
        	],
        	[
        		'code' => 'PE 2',
        		'description' => 'Rhythmic Activities',
        		'units' => 2,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 1,
        		'semester_id' => 2
        	],
        	[
        		'code' => 'NSTP 2',
        		'description' => 'Civic Welfare Training Service w/ Seminar in Peace Education',
        		'units' => 3,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 1,
        		'semester_id' => 2
        	],
        	[
        		'code' => 'ENG 3',
        		'description' => 'Speech & Oral Communication',
        		'units' => 3,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 2,
        		'semester_id' => 1
        	],
        	[
        		'code' => 'LIT 1',
        		'description' => 'Philippine Literature',
        		'units' => 3,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 2,
        		'semester_id' => 1
        	],
        	[
        		'code' => 'FIL 3',
        		'description' => 'Masining na Pagpapahayag',
        		'units' => 3,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 2,
        		'semester_id' => 1
        	],
        	[
        		'code' => 'EDUC 2',
        		'description' => 'Child and Adolescent Dev\'t',
        		'units' => 3,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 2,
        		'semester_id' => 1
        	],
        	[
        		'code' => 'EDUC 4',
        		'description' => 'Principles of Teach 1',
        		'units' => 3,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 2,
        		'semester_id' => 1
        	],
        	[
        		'code' => 'FS 1',
        		'description' => 'The Learner\'s Dev\'t and Evn\'t',
        		'units' => 1,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 2,
        		'semester_id' => 1
        	],
        	[
        		'code' => 'E. MAJ 1',
        		'description' => 'Language Curriculum',
        		'units' => 3,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 2,
        		'semester_id' => 1
        	],
        	[
        		'code' => 'EDUC 3',
        		'description' => 'Facilitating Learning',
        		'units' => 3,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 2,
        		'semester_id' => 1
        	],
        	[
        		'code' => 'E. MAJ 2',
        		'description' => 'Intro to Linguistics',
        		'units' => 3,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 2,
        		'semester_id' => 1
        	],
        	[
        		'code' => 'PE 3',
        		'description' => 'Ind/Dual Games Sports',
        		'units' => 2,
        		'course_id' => 1,
        		'curriculum_id' => 1,
        		'year_level_id' => 2,
        		'semester_id' => 1
        	]
        ]);
    }
}
