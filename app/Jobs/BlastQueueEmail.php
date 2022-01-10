<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Student;
use App\Product;
use App\Package;
use App\Payment;
use Mail;

class BlastQueueEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;
    public $timeout = 7200; // 2 hours

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {  
        $product = Product::where('product_id', $product_id)->first();
        $package = Package::where('package_id', $package_id)->first();
        $payment = Package::where('payment_id', $payment_id)->first();
        
        $data = Student::all();
        $input['subject'] = $this->details['subject'];

        foreach ($data as $key => $value) {
            $input['email'] = $value->email;
            $input['name'] = $value->first_name;

            $input['product'] = $product->name;
            $input['package'] = $package->name;

            $input['payment_id'] = $payment->payment_id;
            $input['product_id'] = $product->product_id; 
            $input['package_id'] = $package->package_id;       
            $input['student_id'] = $value->stud_id;

            \Mail::send('emails.mail', [], function($message) use($input){
                $message->to($input['email'], $input['name'])
                    ->subject($input['subject']);
            });
        }
    }
}