<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function subject()
    {
    	return $this->belongsTo('App\Subject', 'subject_id');
    }

    public function room()
    {
    	return $this->belongsTo('App\Room', 'room_id');
    }

    public function course()
    {
    	return $this->belongsTo('App\Course', 'course_id');
    }

    public function curriculum()
    {
    	return $this->belongsTo('App\Curriculum', 'curriculum_id');
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
