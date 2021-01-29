<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\GeneralController;
use Auth;

use App\User;
use App\Avatar;

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
    		'lrn' => 'required'
		]);

    	$sn = $request['student_number'];

    	$student = User::where('student_number', $sn)->first();

    	if(empty($student)) {
    		return redirect()->route('registration')->with('error', 'LRN not found!');
    	}

    	if($student->registered == 1) {
    		return redirect()->route('registration')->with('error', 'Student Already Registered!');
    	}

    	return view('registration-show-details', ['student' => $student]);
    }


    // method use to register student in the system
    public function postRegisterStudent(Request $request)
    {
    	$request->validate([
    		'password' => 'required|confirmed|min:6|max:32'
    	]);

    	$student_id = $request['student_id'];
    	$password = $request['password'];

    	$student = User::findorfail($student_id);
    	$student->password = bcrypt($password);
    	$student->registered = 1;
    	$student->active = 1;
    	$student->save();

        GeneralController::activity_log($student->id, 6, 'Student Registered an Account');

        $avatar = new Avatar();
        $avatar->student_id = $student->id;
        $avatar->save();

    	// authenticate
    	return redirect()->route('login')->with('success', 'Registration Successful!');    	

    }
}
