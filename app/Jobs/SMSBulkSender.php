<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\SMSTemplateModel;
use App\SMSBulkModel;

use Auth;

class SMSBulkSender implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $_rows = [], $_templateId = 0, $_regexData = [], $_message = "";
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($rows, $templateId, $regexData)
    {
        $this->_rows = $rows;
        $this->_templateId = $templateId;
        $this->_regexData = $regexData;
		
		$t = SMSTemplateModel::where("id", $templateId);
		$this->_message = $t->first()->content;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach($this->_rows as $row){
            $message = $this->_message;
			
			foreach($this->_regexData as $rd){
				if(isset($row[strtolower($rd)])){
					$message = str_replace("{". $rd ."}", $row[strtolower($rd)], $message);
				}
			}
			
			if(isset($row["phone_no"])){
				$phone_no = $row["phone_no"];
			
				Http::get('http://cloudsms.trio-mobile.com/index.php/api/bulk_mt?api_key='. env("TRIO_KEY") .'&action=send&to='. $phone_no .'&msg='. $message .'&sender_id=CLOUDSMS&content_type=1&mode=shortcode');
				
				SMSBulkModel::create([
					"phone"		=> $phone_no,
					"message"	=> $message,
					"user_id"	=> (isset(Auth::user()->id) ? Auth::user()->id : 0),
					"template_id" => $this->_templateId
				]);
			}else{
				return false;
			}
        }
    }
}




























