<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    // method use to show login form for admin
    public function adminLogin()
    {
    	return view('admin-login');
    }
}
