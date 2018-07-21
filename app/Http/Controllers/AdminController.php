<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\GeneralController;

use App\User;
use App\Dean;
use App\Cashier;
use App\Registrar;
use App\Faculty;
use App\ActivityLog;

class AdminController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:admin');
    }

    
    // method to view dashboard of admin
    public function dashboard()
    {
    	return view('admin.dashboard');
    }


    // method use to view deans
    public function deans()
    {
    	$deans = Dean::where('active', 1)
    				->orderBy('lastname', 'asc')
    				->get();

    	return view('admin.deans', ['deans' => $deans]);
    }


    // method use to add dean
    public function addDean()
    {
    	return view('admin.dean-add');
    }


    // method use to save new dean
    public function postAddDean(Request $request)
    {
    	$request->validate([
    		'firstname' => 'required',
    		'lastname' => 'required',
    		'username' => 'required'
    	]);

    	$firstname = $request['firstname'];
    	$lastname = $request['lastname'];
    	$middlename = $request['middlename'];
    	$suffix = $request['suffix_name'];
    	$username = $request['username'];

    	// add new dean
    	$dean = new Dean();
    	$dean->username = $username;
    	$dean->password = bcrypt('password');
    	$dean->firstname = $firstname;
    	$dean->lastname = $lastname;
    	$dean->middle_name = $middlename;
    	$dean->suffix_name = $suffix;
    	$dean->save();

    	// add activty log
    	GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Added Dean');

    	// return to deans and add admin with message
    	return redirect()->route('admin.deans')->with('success', 'Dean Added!');

    }


    // method use to update dean
    public function updateDean($id = null)
    {
    	$dean = Dean::findorfail($id);

    	return view('admin.dean-update', ['dean' => $dean]);
    }


    // method use to save update on dean
    public function postUpdateDean(Request $request)
    {
    	$request->validate([
    		'firstname' => 'required',
    		'lastname' => 'required',
    		'username' => 'required'
    	]);

    	$firstname = $request['firstname'];
    	$lastname = $request['lastname'];
    	$middlename = $request['middlename'];
    	$suffix = $request['suffix_name'];
    	$username = $request['username'];
    	$dean_id = $request['dean_id'];

    	$dean = Dean::findorfail($dean_id);

    	// check if the username is already exist
    	$check_username = Dean::where('username', $username)->first();

    	if(count($check_username) > 0 && $username != $dean->username) {
    		return redirect()->back()->with('error', 'Username Already Used!');
    	}

    	$dean->username = $username;
    	$dean->password = bcrypt('password');
    	$dean->firstname = $firstname;
    	$dean->lastname = $lastname;
    	$dean->middle_name = $middlename;
    	$dean->suffix_name = $suffix;
    	$dean->save();

    	// add activty log
    	GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Updated Dean Information');

    	// return to deans and add admin with message
    	return redirect()->route('admin.deans')->with('success', 'Dean Information Updated!');
    }
}
