<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\InvoiceMembershipEmail;
use Mail;

class InvoiceMembershipJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $send_mail, $inv, $member, $subtotal,  $name, $no,  $secondname, $invoice, $membership, $price, $total, $date_receive, $datesum, $invoice_amount, $amount_received, $balance, $balance_due;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($send_mail, $inv, $member, $subtotal,  $name, $no,  $secondname, $invoice, $membership, $price, $total, $date_receive, $datesum, $invoice_amount, $amount_received, $balance, $balance_due)
    {
        $this->send_mail = $send_mail;
        $this->inv = $inv;
        $this->member = $member;
        $this->subtotal = $subtotal;
        $this->name = $name;
        $this->no = $no;
        $this->secondname = $secondname;
        $this->invoice = $invoice;
        $this->membership = $membership;
        $this->price = $price;
        $this->total = $total;
        $this->date_receive = $date_receive;
        $this->datesum = $datesum;
        $this->invoice_amount = $invoice_amount;
        $this->amount_received = $amount_received;
        $this->balance = $balance;
        $this->balance_due = $balance_due;

       
    }
    
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   
        Mail::to($this->send_mail)->send(new InvoiceMembershipEmail(  
                                                                        $this->name,
                                                                        $this->inv ,
                                                                        $this->member ,
                                                                        $this->subtotal , 
                                                                        $this->no ,
                                                                        $this->secondname ,
                                                                        $this->invoice ,
                                                                        $this->membership ,
                                                                        $this->price ,
                                                                        $this->total ,
                                                                        $this->date_receive ,
                                                                        $this->datesum ,
                                                                        $this->invoice_amount ,
                                                                        $this->amount_received ,
                                                                        $this->balance ,
                                                                        $this->balance_due ));
        
    }
}