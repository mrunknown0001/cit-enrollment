<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultySubjectLoad extends Model
{
    public function faculty()
    {
    	return $this->belongsTo('App\Faculty', 'faculty_id');
    }

    public function subject()
    {
    	return $this->belongsTo('App\Subject', 'subject_id');
    }
}
