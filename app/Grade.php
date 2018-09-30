<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    public function ay()
    {
    	return $this->belongsTo('App\AcademicYear', 'academic_year_id');
    }

    public function semester()
    {
    	return $this->belongsTo('App\Semester', 'semester_id');
    }

    public function subject()
    {
    	return $this->belongsTo('App\Subject', 'subject_id');
    }
}
