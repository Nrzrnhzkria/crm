<?php

namespace App\Mail;

use App\Email;
use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

class InvoiceRemindTerminateEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $lvl, $student;

    // public $data;

    public function __construct($lvl, $student)
    {
        $this->lvl = $lvl;
        $this->student = $student;
    }

    public function build()
    {
        $payment = $this->lvl;

        $currentDate = Carbon::now()->toFormattedDateString();

        //content->payment
        //remind terminate untuk bayar atau remove dari sistem
        return $this->view('invoice.invoiceTerminate')
                    ->with([ 
                        'content' => $payment, 
                        'student' => $this->student, 
                        'current_date' => $currentDate
                    ]);
    }
}
