<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\InvoiceRemindEmail;
use App\Email;
use App\Invoice;
use App\Student;
use Mail;
use Carbon\Carbon;
use App\Membership_Level;

class CreateInvoice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $students;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($students)
    {
       $this->students = $students;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $students = $this->students;
        $no = 1;

        foreach($students as $student)
        {
            //check student kena block
            $invoice = Invoice::where('student_id', $student->id)->where('status', 'not paid')->get();

            //lebih 3 bulan @ 3 tahun 
            if(count($invoice) < 3){
                $lvl = Membership_Level::where('level_id', $student->level_id)->first();

                $now = Carbon::now();

                $for_date = $now->day.'/'.$now->month.'/'.$now->year;
                $due_date = (($now->day)+7).'/'.$now->month.'/'.$now->year;

                $invoice = new Invoice();
                $invoice->invoice_id = 'INV'. '-' . $now->year . '-' . $now->month . '-'. $no;
                $invoice->price = $lvl->price;
                $invoice->for_date = $for_date;
                $invoice->due_date = $due_date;
                $invoice->status = 'not paid';

                $student->invoices()->save($invoice);
            }

            $no++;

        }

    }
}
