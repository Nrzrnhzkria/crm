<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Billplz\Client;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Ticket;

class TestController extends Controller
{

   public function export()
   {       
      // Load users
      // $users = User::all();

      return (new FastExcel(Ticket::all()))->download('paid.xlsx', function ($user) {
         return [
             'Email' => $user->ticket_id,
             'First Name' => $user->ic,
             'Last Name' => $user->status,
         ];
      });
   }

   public function basic_email() {
      $data = array('name'=>"Virat Gandhi");
   
      Mail::send('test', $data, function($message) {
         $message->to('zarina4.11@gmail.com', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
         $message->from('noreply@momentuminternet.my','Virat Gandhi');
      });
      echo "Basic Email Sent. Check your inbox.";
   }

   /**
    * Payment page
    * 
    * 
    */
   public function index()
   {
      return view('test');
   }

   /**
    * Payment process
    * 
    * 
    */
   public function process()
   {
      //$billplz = Client::make("3f78dfad-7997-45e0-8428-9280ba537215", "S-jtSalzkEawdSZ0Mb0sqmgA");
      $billplz = Client::make(env('BILLPLZ_API_KEY', '3f78dfad-7997-45e0-8428-9280ba537215'), env('BILLPLZ_X_SIGNATURE', 'S-jtSalzkEawdSZ0Mb0sqmgA'));

      $bill = $billplz->bill();

      $response = $bill->create(
         'ffesmlep',
         'pelikb@gmail.com',
         '+601112729197',
         'Danial Adzhar',
         \Duit\MYR::given(200),
         'http://example.com/webhook/',
         'Maecenas eu placerat ante.',
         ['redirect_url' => 'http://example.com/redirect/']
      );

      $test = $response->toArray();
      //dd($test['url']);

      return redirect($test['url']);
      
   }

}
