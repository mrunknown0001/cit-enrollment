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



    public function postAddStrand(Request $request)
    {
    	$request->validate([
    		'strand' => 'required',
    		'code' => 'required',
    		'description' => 'nullable',
    	]);


    	$strand = $request['strand'];
    	$code = $request['code'];
    	$description = $request['description'];

        // save strand
        $new = new Strand();
        $new->strand = $strand;
        $new->code = $code;
        $new->description;

        // condition for success and fail
        if($new->save()) {

            GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Added New Strand');

            return redirect()->route('admin.strands')->with('success', 'New Strand Saved!');
        }

    }
}
