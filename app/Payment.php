<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
	public function student()
	{
		return $this->belongsTo('App\User', 'student_id');
	}

    public function mop()
    {
    	return $this->belongsTo('App\ModeOfPayment', 'mode_of_payment_id');
    }
}
