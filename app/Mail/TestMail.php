<?php

namespace App\Mail;

use App\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function build()
    {
        return $this->view('test')
                    ->with([ 'content' => $this->message ]);
    }
}
