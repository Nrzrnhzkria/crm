<?php

namespace App\Console\Commands;

use App\Payment;
use App\Student;
use App\Invoice;
use App\Jobs\TestJobMail;
use App\Jobs\CreateInvoice;
use App\Jobs\InvoiceJobMail;
use Illuminate\Console\Command;

class InvoiceCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //M1981113016705iqbal1
        
        //the real one
        $students = Student::where('email', 'danial0597@gmail.com')->get();
        // $students = Student::all()->whereNotNull('level_id')->unique('email');

        //testing purpose
        // $students = Student::whereIn('stud_id',['M1981113016705iqbal1', 'M1981113016705iqbal2'])->whereNotNull('level_id')->get()->unique('email');

        // dispatch(new CreateInvoice($students));

        dispatch(new InvoiceJobMail($students));
    }
}
