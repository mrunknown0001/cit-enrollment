<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralController extends Controller
{
    // method use to go to landing page
    public function landingPage()
    {
    	return view('landing-page');
    }
}
