<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Strand;

class StrandController extends AdminController
{
    public function strands()
    {
    	$strands = Strand::where('active', 1)->get();

    	return view('admin.strands', ['strands' => $strands]);
    }
}
