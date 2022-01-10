<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MembershipEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $name, $secondname, $invoice, $membership, $price, $total, $date_receive, $datesum, $invoice_amount, $amount_received, $balance, $balance_due;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $secondname, $invoice, $membership, $price, $total, $date_receive, $datesum, $invoice_amount, $amount_received, $balance, $balance_due)
    {
        $this->name = $name;
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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Penyata Akaun Momentum Internet')            
            ->view('emails.statement')
            ->with(
                [
                    'name' => $this->name ,
                    'secondname' => $this->secondname ,
                    'invoice' => $this->invoice ,
                    'membership' => $this->membership ,
                    'price' => $this->price ,
                    'total' => $this->total ,
                    'date_receive' => $this->date_receive ,
                    'datesum' => $this->datesum ,
                    'invoice_amount' => $this->invoice_amount ,
                    'amount_received' => $this->amount_received ,
                    'balance' => $this->balance ,
                    'balance_due' => $this->balance_due ,
                ]);
    }

    // public function build()
    // {
    //     return $this->subject('Penyata Akaun Momentum Internet')            
    //         ->view('emails.statement')
    //         ->with(
    //             [
    //                 'product_name' => $this->product_name,
    //                 'package_name' => $this->package_name,
    //                 'date_from' => $this->date_from,
    //                 'date_to' => $this->date_to,
    //                 'time_from' => $this->time_from,
    //                 'time_to' => $this->time_to,
    //                 'packageId' => $this->packageId,
    //                 'payment_id' => $this->payment_id,
    //                 'productId' => $this->productId,
    //                 'student_id' => $this->student_id,
    //             ]);
    // }
}
