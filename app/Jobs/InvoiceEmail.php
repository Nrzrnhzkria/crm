<?php

namespace App\Jobs;

use Mail;
use App\Mail\InvoiceSendEmail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class InvoiceEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $name, $ic, $email, $phoneno, $total, $quantity, $package_id, $package, $price, $date_receive, $payment_id, $product_id, $student_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name, $ic, $email, $phoneno, $total, $quantity, $package_id, $package, $price, $date_receive, $payment_id, $product_id, $student_id)
    {
        $this->name = $name;
        $this->ic = $ic;
        $this->email = $email;
        $this->phoneno = $phoneno;
        $this->total = $total;
        $this->quantity = $quantity;
        $this->package_id = $package_id;
        $this->package = $package;
        $this->price = $price;
        $this->date_receive = $date_receive;
        $this->payment_id = $payment_id;
        $this->product_id = $product_id;
        $this->student_id = $student_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   
        Mail::to($this->email)->send(new InvoiceSendEmail(
                                        $this->name, 
                                        $this->ic, 
                                        $this->email, 
                                        $this->phoneno, 
                                        $this->total, 
                                        $this->quantity, 
                                        $this->package_id, 
                                        $this->package, 
                                        $this->price, 
                                        $this->date_receive, 
                                        $this->payment_id, 
                                        $this->product_id, 
                                        $this->student_id));
    }
}
