<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeanController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:dean');
    }

}
