<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReceiptMembershipEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $name, $secondname, $billplz, $receipt, $method, $payment, $invoice, $membership, $price, $date, $total, $date_receive, $datesum, $invoice_amount, $amount_received, $balance, $balance_due;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,  $secondname, $billplz, $receipt, $method, $payment, $invoice, $membership, $price, $date, $total, $date_receive, $datesum, $invoice_amount, $amount_received, $balance, $balance_due)
    {
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
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Receipt Momentum Internet')            
            ->view('emails.resitmember')
            ->with(
                [
                    'name' => $this->name ,
                    'secondname' => $this->secondname ,
                    'billplz' => $this->billplz ,
                    'receipt' => $this->receipt ,
                    'method' => $this->method ,
                    'payment' => $this->payment ,
                    'invoice' => $this->invoice ,
                    'membership' => $this->membership ,
                    'price' => $this->price ,
                    'date' => $this->date ,
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
