<?php

namespace App\Console\Commands;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Role;
use App\Permission;
use App\Student;
use App\Payment;
use App\Product;
use App\Package;
use App\Ticket;
use Carbon\Carbon;
use Telegram;

use Illuminate\Console\Command;

class UpdatePendaftaran extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:update';

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
    public function handle(Request $request)
    {
        $date_today = Carbon::now('Asia/Kuala_Lumpur')->format('d-m-Y');
        $current_time = Carbon::now('Asia/Kuala_Lumpur')->format('h:i a');
        $time = Carbon::now('Asia/Kuala_Lumpur')->format('H:i');
        
        if ($time < "08:10") {

            $from = date('Y-m-d 16:00:00');
            $to = date('Y-m-d 23:59:59');
            $duration = "12 am - 8 am"; 
            $greetings = "Good Morning!";

        } elseif ($time >= "08:10" && $time < "09:10") {

            $from = date('Y-m-d 00:00:00');
            $to = date('Y-m-d 00:59:59');
            $duration = "8 am - 9 am"; 
            $greetings = "Good Morning!";

        } elseif ($time >= "09:10" && $time < "10:10") {

            $from = date('Y-m-d 01:00:00');
            $to = date('Y-m-d 01:59:59');
            $duration = "9 am - 10 am"; 
            $greetings = "Good Morning!";

        } elseif ($time >= "10:10" && $time < "11:10") {

            $from = date('Y-m-d 02:00:00');
            $to = date('Y-m-d 02:59:59');
            $duration = "10 am - 11 am"; 
            $greetings = "Good Morning!";

        } elseif ($time >= "11:10" && $time < "12:10") {

            $from = date('Y-m-d 03:00:00');
            $to = date('Y-m-d 03:59:59');
            $duration = "11 am - 12 pm"; 
            $greetings = "Good Morning!";

        } elseif ($time >= "12:10" && $time < "13:10") {

            $from = date('Y-m-d 04:00:00');
            $to = date('Y-m-d 04:59:59');
            $duration = "12 pm - 1 pm"; 
            $greetings = "Good Afternoon!";

        } elseif ($time >= "13:10" && $time < "14:10") {

            $from = date('Y-m-d 05:00:00');
            $to = date('Y-m-d 05:59:59');
            $duration = "1 pm - 2 pm"; 
            $greetings = "Good Afternoon!";

        } elseif ($time >= "14:10" && $time < "15:10") {

            $from = date('Y-m-d 06:00:00');
            $to = date('Y-m-d 06:59:59');
            $duration = "2 pm - 3 pm"; 
            $greetings = "Good Afternoon!";

        } elseif ($time >= "15:10" && $time < "16:10") {

            $from = date('Y-m-d 07:00:00');
            $to = date('Y-m-d 07:59:59');
            $duration = "3 pm - 4 pm"; 
            $greetings = "Good Evening!";

        } elseif ($time >= "16:10" && $time < "17:10") {

            $from = date('Y-m-d 08:00:00');
            $to = date('Y-m-d 08:59:59');
            $duration = "4 pm - 5 pm"; 
            $greetings = "Good Evening!";

        } elseif ($time >= "17:10" && $time < "18:10") {

            $from = date('Y-m-d 09:00:00');
            $to = date('Y-m-d 09:59:59');
            $duration = "5 pm - 6 pm"; 
            $greetings = "Good Evening!";

        } elseif ($time >= "18:10" && $time < "19:10") {

            $from = date('Y-m-d 10:00:00');
            $to = date('Y-m-d 10:59:59');
            $duration = "6 pm - 7 pm"; 
            $greetings = "Good Evening!";

        } elseif ($time >= "19:10" && $time < "20:10") {

            $from = date('Y-m-d 11:00:00');
            $to = date('Y-m-d 11:59:59');
            $duration = "7 pm - 8 pm"; 
            $greetings = "Good Evening!";
            
        } elseif ($time >= "20:10" && $time < "21:10") {

            $from = date('Y-m-d 12:00:00');
            $to = date('Y-m-d 12:59:59');
            $duration = "8 pm - 9 pm"; 
            $greetings = "Good Evening!";
            
        } elseif ($time >= "21:10" && $time < "22:10") {

            $from = date('Y-m-d 13:00:00');
            $to = date('Y-m-d 13:59:59');
            $duration = "9 pm - 10 pm"; 
            $greetings = "Good Evening!";

        } elseif ($time >= "22:10" && $time < "23:10") {

            $from = date('Y-m-d 14:00:00');
            $to = date('Y-m-d 14:59:59');
            $duration = "10 pm - 11 pm"; 
            $greetings = "Good Evening!";

        } elseif ($time >= "23:10" && $time <= "00:00") {

            $from = date('Y-m-d 15:00:00');
            $to = date('Y-m-d 15:59:59');
            $duration = "11 pm - 12 am";
            $greetings = "Good Evening!";

        } else {

            $from = date('Y-m-d 15:00:00');
            $to = date('Y-m-d 15:59:59');
            $duration = "11 pm - 12 am";
            $greetings = "Good Evening!";

        }

        // get product id
        $product = Product::where('status', 'active')->first();
        $product_id = $product->product_id;

        // get package
        $package = Package::where('product_id', $product_id)->get();
        $count_package = Package::where('product_id', $product_id)->count();

        for ($i = 0; $i < $count_package; $i++)
        {

            // get report by 2 hours
            $registration[$i] = Payment::where('status','paid')->where('product_id', $product_id)->where('package_id', $package[$i]->package_id)->whereBetween('created_at', [ $from , $to ])->count();
            $paidticket[$i] = Ticket::where('ticket_type', 'paid')->where('product_id', $product_id)->where('package_id', $package[$i]->package_id)->whereBetween('created_at', [ $from , $to ])->count();
            $freeticket[$i] = Ticket::where('ticket_type', 'free')->where('product_id', $product_id)->where('package_id', $package[$i]->package_id)->whereBetween('created_at', [ $from , $to ])->count();
            
            // get total registration
            $totalpackage[$i] = Payment::where('status','paid')->where('product_id', $product_id)->where('package_id', $package[$i]->package_id)->count();

            // get total collection
            $collection[$i] = Payment::where('status','paid')->where('product_id', $product_id)->where('package_id', $package[$i]->package_id)->sum('totalprice');

            
        }
        
        // get the total 
        $total_yesterday = Payment::where('product_id', $product_id)->where('status', 'paid')->whereBetween('created_at', [ date('Y-m-d 00:00:00', strtotime("-1 day")) , date('Y-m-d 23:59:59', strtotime("-1 day")) ])->count();
        $total_now = Payment::where('product_id', $product_id)->where('status', 'paid')->whereBetween('created_at', [ date('Y-m-d 00:00:00') , date('Y-m-d H:i:s') ])->count();
        
        $totalregister = Payment::where('status','paid')->where('product_id', $product_id)->count();
        $totalpaid = Ticket::where('ticket_type', 'paid')->where('product_id', $product_id)->count();
        $totalfree = Ticket::where('ticket_type', 'free')->where('product_id', $product_id)->count();
        $totalticket = Ticket::where('product_id', $product_id)->count();        
        $pendingticket = $totalregister - $totalpaid;
        $totalcollection = Payment::where('status','paid')->where('product_id', $product_id)->sum('totalprice');

        //getting report for each day
        $mon = Payment::where('product_id', $product_id)->where('status', 'paid')->whereBetween('created_at', [ date('Y-m-d 00:00:00', strtotime('monday this week')) , date('Y-m-d 23:59:59', strtotime('monday this week')) ])->count();
        $fri = Payment::where('product_id', $product_id)->where('status', 'paid')->whereBetween('created_at', [ date('Y-m-d 00:00:00', strtotime('friday this week')) , date('Y-m-d 23:59:59', strtotime('friday this week')) ])->count();
        $sat = Payment::where('product_id', $product_id)->where('status', 'paid')->whereBetween('created_at', [ date('Y-m-d 00:00:00', strtotime('saturday this week')) , date('Y-m-d 23:59:59', strtotime('saturday this week')) ])->count();
        $sun = Payment::where('product_id', $product_id)->where('status', 'paid')->whereBetween('created_at', [ date('Y-m-d 00:00:00', strtotime('sunday this week')) , date('Y-m-d 23:59:59', strtotime('sunday this week')) ])->count();
        $thu = Payment::where('product_id', $product_id)->where('status', 'paid')->whereBetween('created_at', [ date('Y-m-d 00:00:00', strtotime('thursday this week')) , date('Y-m-d 23:59:59', strtotime('thursday this week')) ])->count();
        $wed = Payment::where('product_id', $product_id)->where('status', 'paid')->whereBetween('created_at', [ date('Y-m-d 00:00:00', strtotime('wednesday this week')) , date('Y-m-d 23:59:59', strtotime('wednesday this week')) ])->count();
        $tue = Payment::where('product_id', $product_id)->where('status', 'paid')->whereBetween('created_at', [ date('Y-m-d 00:00:00', strtotime('tuesday this week')) , date('Y-m-d 23:59:59', strtotime('tuesday this week')) ])->count();

        $textes = $product->name."\n"."Date : ".$date_today."\n"."Duration : ".$duration."\n\n"."Total Registration : ".$totalregister."\n"."Total Today : +".$total_now."\n";
        Telegram::sendMessage([
            "chat_id" => env('TELEGRAM_CHAT_ID', ''),
            "parse_mode" => "HTML",
            "text" => $textes
        ]);

        for ($i = 0; $i < $count_package; $i++){
            $text = "<b>".strtoupper($package[$i]->name)."</b>"."\n\n"."Total Ticket : ".$totalpackage[$i]."\n"."Current Registration (Hours)"." : +".number_format($registration[$i])."\n";
            Telegram::sendMessage([
                "chat_id" => env('TELEGRAM_CHAT_ID', ''),
                "parse_mode" => "HTML",
                "text" => $text
            ]);
        }
       return 0;
    }
}
