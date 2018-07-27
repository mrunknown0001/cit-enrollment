<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }


    // method to show student dashboard
    public function dashboard()
    {
    	return view('student.dashboard');
    }


    // method use  to show profile
    public function profile()
    {
    	return view('student.profile');
    }
}
