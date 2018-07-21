<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    // method to show registration for students
    public function registration()
    {
    	return view('registration');
    }
}
