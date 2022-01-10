<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\InvoiceRemindEmail;
use App\Mail\InvoiceRemindTerminateEmail;
use App\Email;
use App\Student;
use App\Membership_Level;
use Mail;
use Carbon\Carbon;
use App\Invoice;

class InvoiceJobMail implements ShouldQueue
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

        $now = Carbon::now();
        $no = 1;

        // $current_date = $now->month.'/'.$now->year;

        foreach($students as $student){

            //check student kena block
            $invoiceCreate = Invoice::where('student_id', $student->id)->where('status', 'not paid')->get();
            $invoiceId = null;

            //cari status kurang 3 bulan @ 3 tahun tak bayar 'not paid'
            if(count($invoiceCreate) < 3){
                $lvl = Membership_Level::where('level_id', $student->level_id)->first();

                $now = Carbon::now();

                $for_date = $now->day.'/'.$now->month.'/'.$now->year;
                $due_date = (($now->day)+7).'/'.$now->month.'/'.$now->year;

                $newInvoice = new Invoice();
                // $newInvoice->invoice_id = 'INV'.uniqid();
                $newInvoice->invoice_id = 'INV' . '-' . $now->year . '-' . $now->month . '-' . $no;
                $newInvoice->price = $lvl->price;
                $newInvoice->for_date = $for_date;
                $newInvoice->due_date = $due_date;
                $newInvoice->status = 'not paid';

                $invoiceId = $student->invoices()->save($newInvoice);
            }

            /**
             * Proses Hantar Email
             * 
             * 
             */

            // $invoiceFirst = Invoice::where('student_id', $student->id)->where('status', 'not paid')->first();
            $invoiceLatest = Invoice::where('student_id', $student->id)->where('status', 'not paid')->get()->last();

            $lvl = Membership_Level::where('level_id', $student->level_id)->first();

            // $last_date = $invoiceFirst->for_date;

            // $months = array();
            // $years = array();

            // $current = explode("/",$current_date);
            // $last = explode("/",$last_date);

            // $difference_year = $current[1] - $last[1];
            // $difference_month = $current[0] - $last[0];

            // if(isset($student->email)){
                
                $email = $student->email;

                // if($difference_year == 0){

                    //hantar email lagi 3 bulan berturut
                    // 3 = bermaksud bulan 1,bulan 2, bulan 3
                    // if($difference_month < 3 && $student->status == 'Active'){
                    if($student->status == 'Active' && count($invoiceCreate) < 3){
                        
                        Mail::to($email)->send(new InvoiceRemindEmail($lvl, $student, $invoiceLatest));
                        // print('Hantar Emel Biasa');

                    }else if($student->status == 'Stop' || $student->status == 'Break'){

                        // print('Tak Hantar');

                    //hantar email terminate kalau 3 bulan tak bayar atau dah terminate
                    }else if(count($invoiceCreate) == 3 && $student->status == 'Active'){
                    // }else if($student->status == 'Terminate'){

                        // print('Hantar Terminate');

                        $student->status = 'Terminate';

                        $student->save();
                        
                        Mail::to($email)->send(new InvoiceRemindTerminateEmail($lvl, $student));

                    }else{

                        print('Biasa');

                    }
                // }
            // }
            
        }
    }
}
