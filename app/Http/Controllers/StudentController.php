<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\PaymentController;

use App\User;

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


    // method use to update profile
    public function updateProfile($id = null)
    {
        $student = User::findorfail($id);

        if($student->id != Auth::user()->id) {
            return redirect()->route('student.dashboard')->with('error', 'Hey, Error Detected!');
        }

        return view('student.profile-update');
    }


    // method use to save profile update
    public function postUpdateProfile(Request $request)
    {
        return $request;
    }
}
