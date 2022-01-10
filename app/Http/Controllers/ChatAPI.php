<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ApiJson;

use Auth;

class ChatAPI extends Controller
{
    public function index(Request $rq){
		
		switch($rq->action){
			case "list_topic":
			
			break;
			
			case "get_topic":
			
			break;
			
			default:
			
				return response()->json([
					"status"	=> "error",
					"message"	=> "API end point not valid."
				], 200);
			break;
		}
	}
}
