<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;

    protected $product_name, $package_name, $date_from, $date_to, $time_from, $time_to, $packageId, $productId, $student_id, $ticket_id, $survey_form;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($product_name, $package_name, $date_from, $date_to, $time_from, $time_to, $packageId, $productId, $student_id, $ticket_id, $survey_form)
    {
        $this->product_name = $product_name; 
        $this->package_name = $package_name;      
        $this->date_from = $date_from;        
        $this->date_to = $date_to;        
        $this->time_from = $time_from;        
        $this->time_to = $time_to;
        $this->packageId = $packageId;
        $this->productId = $productId;
        $this->student_id = $student_id;
        $this->ticket_id = $ticket_id;
        $this->survey_form = $survey_form;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {        
        return $this->view('emails.update_mail')
        ->subject('Pengesahan Pendaftaran Peserta')
        ->with(
            [
                'product_name' => $this->product_name,
                'package_name' => $this->package_name,
                'date_from' => $this->date_from,
                'date_to' => $this->date_to,
                'time_from' => $this->time_from,
                'time_to' => $this->time_to,
                'packageId' => $this->packageId,
                'productId' => $this->productId,
                'student_id' => $this->student_id,
                'ticket_id' => $this->ticket_id,
                'survey_form' => $this->survey_form,
            ]);
    }
}
