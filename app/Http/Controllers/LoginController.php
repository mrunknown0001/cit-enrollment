<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Http\Controllers\GeneralController;
use App\Admin;
use App\Dean;
use App\Registrar;
use App\Cashier;
use App\Faculty;
use App\User;

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

            // check if the session id is not null
            if(Auth::guard('admin')->user()->session_id != null) {
                Auth::guard('admin')->logout();
                return redirect()->back()->with('error', 'Admin is currently logged in!!!');
            }

            Auth::guard('admin')->user()->session_id = Session::getId();
            Auth::guard('admin')->user()->save();

            GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Login');

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

            // check if the session id is not null
            if(Auth::user()->session_id != null) {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Account has active session!!!');
            }

            Auth::user()->session_id = Session::getId();
            Auth::user()->save();

            GeneralController::activity_log(Auth::user()->id, 6, 'Student Login');

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

            // check if the session id is not null
            if(Auth::guard('dean')->user()->session_id != null) {
                Auth::guard('dean')->logout();
                return redirect()->back()->with('error', 'Dean is currently logged in!!!');
            }

            Auth::guard('dean')->user()->session_id = Session::getId();
            Auth::guard('dean')->user()->save();

            GeneralController::activity_log(Auth::guard('dean')->user()->id, 2, 'Dean Login');

            return redirect()->route('dean.dashboard');
        }

        return redirect()->back()->with('error', 'Authentication Error!');
    }


    // method use to show login form for cashier
    public function cashierLogin()
    {
    	return view('cashier-login');
    }


    // method use to login cashier
    public function postCashierLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request['username'];
        $password = $request['password'];
        $remember = $request['remember_me'];

        // attempt to login dean
        if(Auth::guard('cashier')->attempt(['username' => $username, 'password' => $password], $remember)) {

            // check if the session id is not null
            if(Auth::guard('cashier')->user()->session_id != null) {
                Auth::guard('cashier')->logout();
                return redirect()->back()->with('error', 'Cashier is currently logged in!!!');
            }

            Auth::guard('cashier')->user()->session_id = Session::getId();
            Auth::guard('cashier')->user()->save();

            GeneralController::activity_log(Auth::guard('cashier')->user()->id, 4, 'Cashier Login');

            return redirect()->route('cashier.dashboard');
        }

        return redirect()->back()->with('error', 'Authentication Error!');
    }


    // method use to show login form for registrar
    public function registrarLogin()
    {
    	return view('registrar-login');
    }


    // method use to login registrar
    public function postRegistrarLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request['username'];
        $password = $request['password'] ;
        $remember = $request['remember_me'];

        // attempt to login registrar
        if(Auth::guard('registrar')->attempt(['username' => $username, 'password' => $password], $remember)) {

            // check if the session id is not null
            if(Auth::guard('registrar')->user()->session_id != null) {
                Auth::guard('registrar')->logout();
                return redirect()->back()->with('error', 'Registrar is currently logged in!!!');
            }

            Auth::guard('registrar')->user()->session_id = Session::getId();
            Auth::guard('registrar')->user()->save();

            GeneralController::activity_log(Auth::guard('registrar')->user()->id, 3, 'Registrar Login');

            return redirect()->route('registrar.dashboard');
        }

        return redirect()->back()->with('error', 'Authentication Error!');
    }


    // method use to show login form for faculty
    public function facultyLogin()
    {
    	return view('faculty-login');
    }


    // method use to login faculty
    public function postFacultyLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request['username'];
        $password = $request['password'] ;
        $remember = $request['remember_me'];

        // attempt to login registrar
        if(Auth::guard('faculty')->attempt(['username' => $username, 'password' => $password], $remember)) {

            // check if the session id is not null
            if(Auth::guard('faculty')->user()->session_id != null) {
                Auth::guard('faculty')->logout();
                return redirect()->back()->with('error', 'Faculty is currently logged in!!!');
            }

            Auth::guard('faculty')->user()->session_id = Session::getId();
            Auth::guard('faculty')->user()->save();

            GeneralController::activity_log(Auth::guard('faculty')->user()->id, 5, 'Faculty Login');

            return redirect()->route('faculty.dashboard');
        }

        return redirect()->back()->with('error', 'Authentication Error!');   
    }
}
