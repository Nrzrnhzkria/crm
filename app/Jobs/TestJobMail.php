<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\TestMail;
use App\Email;
use App\Student;
use Mail;
use Illuminate\Support\Facades\Schema;
use App\Package;
use App\Product;

class TestJobMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $request, $message, $regex_content;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request, $regex_content)
    {
        $this->request = $request;
        $this->regex_content = $regex_content;

        // \Log::info($request['emailId']);
        $email = Email::where('id', $request['emailId'])->first();

        // \Log::info($email['content']);
        $this->message = $email['content'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $request = $this->request;

        $emails = $request['emailList'];

        $columns = array();

        $product_details = Product::where('product_id', $request['prod_id'])->first();
        $package_details = Package::where('package_id', $request['pack_id'])->first();

        foreach($emails as $email){
            $message = $this->message;
           
            $student = Student::where('email', $email)->first();

            foreach($this->regex_content as $rcs){

                $regex = explode(".", $rcs);
                $tableName = $regex[0];
                $keyword = $regex[1];

                $columns = Schema::getColumnListing($tableName);

                foreach($columns as $key => $column){
                    $columns[$key] = $tableName.'.'.$column;
                }

                if (in_array(strtolower($rcs), $columns)){
                    if($tableName == "student"){

                        $message = str_replace("{". $rcs ."}", $student->$keyword, $message);

                    }elseif($tableName == "package"){

                        $message = str_replace("{". $rcs ."}", $package_details->$keyword, $message);

                    }elseif($tableName == "product"){

                        $message = str_replace("{". $rcs ."}", $product_details->$keyword, $message);
                        
                    }
                }
            }

            if($student->email !== (null || "")){
				$email = $student->email;
                
                Mail::to($email)->send(new Testmail($message));
                
			}else{
				return false;
			}
        }
        
    }
}
