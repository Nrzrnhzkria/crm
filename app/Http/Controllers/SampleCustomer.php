<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampleCustomer extends Controller
{
    //
	
	public function index(){
		return view("sample-chat");
	}
}
