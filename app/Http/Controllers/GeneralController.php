<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\ActivityLog;

class GeneralController extends Controller
{
    // method use to go to landing page
    public function landingPage()
    {
    	return $this->auth_check('landing-page');
    }


    //////////////////////////////////
    // session logout for all users //
    //////////////////////////////////
    public function logout()
    {
        // check if there is authenticted user
        if(Auth::check()) {
            // add activity log
            GeneralController::activity_log(Auth::user()->id, 6, 'Student Logout');

            Auth::logout();
        }
        elseif (Auth::guard('faculty')->check()) {
            // add activity log
            GeneralController::activity_log(Auth::guard('faculty')->user()->id, 5, 'Faculty Logout');

            Auth::guard('faculty')->logout();
        }
        elseif(Auth::guard('registrar')->check()) {
            // add activity log
            GeneralController::activity_log(Auth::guard('registrar')->user()->id, 4, 'Cashier Logout');

            Auth::guard('registrar')->logout();
        }
        elseif(Auth::guard('cashier')->check()) {
            // add activity log
            GeneralController::activity_log(Auth::guard('cashier')->user()->id, 3, 'Cashier Logout');

            Auth::guard('cashier')->logout();
        }
        elseif(Auth::guard('dean')->check()) {
            // add activity log
            GeneralController::activity_log(Auth::guard('dean')->user()->id, 2, 'Cashier Logout');

            Auth::guard('dean')->logout();
        }
        elseif(Auth::guard('admin')->check()) {
            // add activity log
            GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Logout');

            Auth::guard('admin')->logout();
        }
        
        return redirect()->route('landing.page');
        
    }


    ////////////////////////////////
    // activity log for all users //
    ////////////////////////////////
    public static function activity_log($id = null, $user_type = null, $action = null)
    {
    	$log = new ActivityLog();
        $log->user_id = $id;
        $log->user_type = $user_type;
        $log->action = $action;
        $log->save();
    }


    //////////////////////////////
    // auth check for all users //
    //////////////////////////////
    public static function auth_check($view)
    {
        // check the user and redirect to intented dashboard
        // check if there is authenticted user
        if(Auth::check()) {
            return redirect()->route('student.dashboard');
        }
        elseif (Auth::guard('faculty')->check()) {
            return redirect()->route('faculty.dashboard');
        }
        elseif(Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        elseif(Auth::guard('cashier')->check()) {
            return redirect()->route('cashier.dashboard');
        }
        elseif(Auth::guard('registrar')->check()) {
            return redirect()->route('registrar.dashboard');
        }
        elseif(Auth::guard('dean')->check()) {
            return redirect()->route('dean.dashboard');
        }

        return view($view);


    }


}
