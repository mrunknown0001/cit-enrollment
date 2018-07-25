<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    public function course()
    {
    	return $this->belongsTo('App\Course', 'course_id');
    }

    public function major()
    {
    	return $this->belongsTo('App\CourseMajor', 'major_id');
    }
}
