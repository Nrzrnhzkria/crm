<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatementMembershipEmail extends Mailable
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
}
