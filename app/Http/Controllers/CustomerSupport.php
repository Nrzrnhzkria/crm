<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\UserChatModel;
use Auth;

class CustomerSupport extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maintenance = false;
		$error = false;
		$user_id = Auth::user()->id;
		
		$uc = UserChatModel::where("user_id", $user_id);
		
		if($uc->count() > 0){
			$uc = $uc->first();
		}else{
			UserChatModel::create([
				"name"		=> Auth::user()->name,
				"phone"		=> "-",
				"email"		=> Auth::user()->email, 
				"stud_id"	=> 0,
				"user_id"	=> $user_id,
				"notes"		=> "",
				"channel"	=> Str::random(24),
				"topic_id"	=> 0
			]);
			
			$uc = UserChatModel::where("user_id", $user_id);
			
			if($uc->count() > 0){
				$uc = $uc->first();
			}else{
				$uc = null;
				$error = true;
			}
		}
		
		return view("admin.customer_support", compact("maintenance", "error", "uc"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
