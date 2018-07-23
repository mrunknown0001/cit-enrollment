<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function majors()
    {
    	return $this->hasmany('App\CourseMajor', 'course_id');
    }
}
