<?php

namespace App\Mail;

use App\Email;
use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

class InvoiceRemindEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $lvl, $student, $invoice;

    // public $data;

    public function __construct($lvl, $student, $invoice)
    {
        $this->lvl = $lvl;
        $this->student = $student;
        $this->invoice = $invoice;
    }

    public function build()
    {
        $payment = $this->lvl;

        $currentDate = Carbon::now()->toFormattedDateString();

        //content->payment
        //remind untuk bayar
        return $this->view('invoice.invoice')->with([ 
                        'content' => $payment, 
                        'student' => $this->student, 
                        'current_date' => $currentDate,
                        'invoice' => $this->invoice
                    ]);
    }
}
