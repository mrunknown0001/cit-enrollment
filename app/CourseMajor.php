<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseMajor extends Model
{
    public function course()
    {
    	return $this->belongsTo('App\Course', 'course_id');
    }
}
