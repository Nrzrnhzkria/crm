<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampleChat extends Controller
{
    //
	
	public function index(Request $request){
		
		return view("sample-chat");
	}
}
