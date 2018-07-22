<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:cashier');
    }


    // method use to view dashboard of cashier
    public function dashboard()
    {
    	return view('cashier.dashboard');
    }

}
