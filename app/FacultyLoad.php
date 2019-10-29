<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyLoad extends Model
{
    public function faculty()
    {
    	return $this->belongsTo('App\Faculty', 'faculty_id');
    }

    public function subject()
    {
    	return $this->belongsTo('App\Subject', 'subject_id');
    }

    public function course()
    {
    	return $this->belongsTo('App\Course', 'course_id');
    }

    public function curriculum()
    {
    	return $this->belongsTo('App\YearLevel', 'curriculum_id');
    }

    public function year_level()
    {
    	return $this->belongsTo('App\YearLevel', 'year_level_id');
    }

    public function section()
    {
    	return $this->belongsTo('App\Section', 'section_id');
    }
}
