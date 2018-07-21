<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\GeneralController;

class LoginController extends Controller
{
    // method use to show login form for admin
    public function adminLogin()
    {
    	return GeneralController::auth_check('admin-login');
    }


    // method use to login admin
    public function postAdminLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request['username'];
        $password = $request['password'];
        $remember = $request['remember_me'];

        // attempt to login admin
        if(Auth::guard('admin')->attempt(['username' => $username, 'password' => $password], $remember)) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with('error', 'Authentication Error!');
    }


    // method use to show login form for student
    public function studentLogin()
    {
    	return GeneralController::auth_check('student-login');
    }


    // method use to login student
    public function postStudentLogin(Request $request)
    {
        $request->validate([
            'student_number' => 'required',
            'password' => 'required'
        ]);

        $sn = $request['student_number'];
        $password = $request['password'];
        $remember = $request['remember_me'];

        // attempt to login admin
        if(Auth::attempt(['student_number' => $sn, 'password' => $password], $remember)) {
            return redirect()->route('student.dashboard');
        }

        return redirect()->back()->with('error', 'Authentication Error!');
    }


    // method use to show login form for dean
    public function deanLogin()
    {
    	return view('dean-login');
    }


    // method use to login dean
    public function postDeanLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request['username'];
        $password = $request['password'];
        $remember = $request['remember_me'];

        // attempt to login dean
        if(Auth::guard('dean')->attempt(['username' => $username, 'password' => $password], $remember)) {
            return redirect()->route('dean.dashboard');
        }

        return redirect()->back()->with('error', 'Authentication Error!');
    }


    // method use to show login form for cashier
    public function cashierLogin()
    {
    	return view('cashier-login');
    }


    // method use to show login form for registrar
    public function registrarLogin()
    {
    	return view('registrar-login');
    }


    // method use to show login form for faculty
    public function facultyLogin()
    {
    	return view('faculty-login');
    }
}
