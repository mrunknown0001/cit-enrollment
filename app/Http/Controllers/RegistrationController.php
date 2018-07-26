<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\GeneralController;
use Auth;

use App\User;

class RegistrationController extends Controller
{
    // method to show registration for students
    public function registration()
    {
    	return view('registration');
    }


    // method use to show details of student for verification
    public function studentShowDetails(Request $request)
    {
    	$request->validate([
    		'student_number' => 'required'
		]);

    	$sn = $request['student_number'];

    	$student = User::where('student_number', $sn)->first();

    	if(count($student) < 1) {
    		return redirect()->route('registration')->with('error', 'Student Number not found!');
    	}

    	if($student->registered == 1) {
    		return redirect()->route('registration')->with('error', 'Student Number Already Registered!');
    	}

    	return view('registration-show-details', ['student' => $student]);
    }


    // method use to register student in the system
    public function postRegisterStudent(Request $request)
    {
    	$request->validate([
    		'password' => 'required'
    	]);

    	$student_id = $request['student_id'];
    	$password = $request['password'];

    	$student = User::findorfail($student_id);
    	$student->password = bcrypt($password);
    	$student->registered = 1;
    	$student->active = 1;
    	$student->save();

    	// authenticate
    	return redirect()->route('login')->with('success', 'Registration Successful!');    	

    }
}
