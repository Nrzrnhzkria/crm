<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\ReceiptMembershipEmail;
use Mail;

class ReceiptMembershipJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $send_mail, $name, $secondname, $billplz, $receipt, $method, $payment, $invoice, $membership, $price, $date, $total, $date_receive, $datesum, $invoice_amount, $amount_received, $balance, $balance_due;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($send_mail, $name, $secondname, $billplz, $receipt, $method, $payment, $invoice, $membership, $price, $date, $total, $date_receive, $datesum, $invoice_amount, $amount_received, $balance, $balance_due)
    {
        
        $this->send_mail = $send_mail;
        $this->name = $name;
        $this->secondname = $secondname;
        $this->billplz = $billplz;
        $this->receipt = $receipt;
        $this->method = $method;
        $this->payment = $payment;
        $this->invoice = $invoice;
        $this->membership = $membership;
        $this->price = $price;
        $this->date = $date;
        $this->total = $total;
        $this->date_receive = $date_receive;
        $this->datesum = $datesum;
        $this->invoice_amount = $invoice_amount;
        $this->amount_received = $amount_received;
        $this->balance = $balance;
        $this->balance_due = $balance_due;

        // $this->product_name = $product_name;   
        // $this->package_name = $package_name;      
        // $this->date_from = $date_from;        
        // $this->date_to = $date_to;        
        // $this->time_from = $time_from;        
        // $this->time_to = $time_to;
        // $this->packageId = $packageId;
        // $this->payment_id = $payment_id;
        // $this->productId = $productId;
        // $this->student_id = $student_id;
    }
    
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   
        Mail::to($this->send_mail)->send(new ReceiptMembershipEmail(  $this->name,
                                                                        $this->secondname ,
                                                                        $this->billplz ,
                                                                        $this->receipt ,
                                                                        $this->method ,
                                                                        $this->payment ,
                                                                        $this->invoice ,
                                                                        $this->membership ,
                                                                        $this->price ,
                                                                        $this->date ,
                                                                        $this->total ,
                                                                        $this->date_receive ,
                                                                        $this->datesum ,
                                                                        $this->invoice_amount ,
                                                                        $this->amount_received ,
                                                                        $this->balance ,
                                                                        $this->balance_due ));
        
     
    }
}