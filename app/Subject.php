<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function strand()
    {
    	return $this->belongsTo('App\Strand', 'strand_id');
    }


    public function curriculum()
    {
    	return $this->hasOne('App\YearLevel', 'id', 'year_level_id');
    }

    // public function major()
    // {
    // 	return $this->belongsTo('App\CourseMajor', 'major_id');
    // }
}
