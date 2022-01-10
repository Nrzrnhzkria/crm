<?php

namespace App\Http\Controllers;
use App\SMSBulkModel;
use App\SMSTemplateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SMSBulkImport;
use App\Exports\SMSTemplate;

use Auth;

class SmsBulk extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$y = SMSTemplateModel::orderBy("id", "desc")->get();
		
		$search = $request->query('search');
		
		if($search) {
			if($request->query("search_template") !== "0"){
				$x = SMSBulkModel::where('phone', 'LIKE', '%'.$search.'%')
				->orWhere('message', 'LIKE', '%'.$search.'%')
				->where('template_id', '=', $request->query("search_template"))
				->paginate(10);
			}else{
				$x = SMSBulkModel::where('phone', 'LIKE', '%'.$search.'%')
				->orWhere('message', 'LIKE', '%'.$search.'%')
				->paginate(10);
			}
            
			return view("admin.sms.smsbulk.index", compact("x", "y"));
        }else {

            $x = SMSBulkModel::orderBy("id", "desc")->paginate(10);
			
			return view("admin.sms.smsbulk.index", compact("x", "y"));
		}
    }

    public function export()
    {
        return Excel::download(new SMSTemplate, 'Phone_No.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
		Http::get('http://cloudsms.trio-mobile.com/index.php/api/bulk_mt?api_key='. env("TRIO_KEY") .'&action=send&to='. $request->phone .'&msg='. $request->message .'&sender_id=CLOUDSMS&content_type=1&mode=shortcode');
		
		SMSBulkModel::create([
			"phone"		=> $request->phone,
			"message"	=> $request->message,
			"user_id"	=> Auth::user()->id,
			"template_id" => 0
		]);
		
		return redirect("smsblast")->with('success', 'Message has been sent to '. $request->phone .'.');
    }
	
	public function create_bulk(Request $request)
    {
        $t = SMSTemplateModel::where("id", $request->template);
		
		if($t->count() > 0){
			$t = $t->first();
			
			preg_match_all("/(?<={).*?(?=})/", $t->content, $m);
			
			if(count($m) > 0){
				if(count($m[0]) > 0){
					$m = $m[0];
				}else{
					$m = [];
				}
			}else{
				$m = [];
			}
			
			$x = Excel::import(new SMSBulkImport($t->id, $m), request()->file('file'));
			
			return redirect("smsblast")->with('success', 'Messages has been qued for sending with template '. $t->title .'.');
		}else{
			return redirect("smsblast")->with('error', 'Selected template is not available.');
		}
		
		// return redirect("smsblast")->with('error', 'SMS Bulk services is not enable yet.');
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
