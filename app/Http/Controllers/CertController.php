<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Student;
use App\Payment;
use App\Ticket;
use PDF;

class CertController extends Controller
{
    public function ic_check($product_id)
    {
        $product = Product::where('product_id', $product_id)->first();

        return view('certificate.get_ic', compact('product'));
    }

    public function checking_ic($product_id, Request $request)
    {
        $student = Student::where('ic', $request->ic)->first();
        $ultimate = Student::where('ic', $request->ic)->first();
        $platinum = Student::where('ic', $request->ic)->first();
        // $check_student = Payment::where('stud_id', $student->stud_id)->where('product_id', $product_id)->get();

        if(Student::where('ic', $request->ic)->exists()){

            $payment = Payment::where('stud_id', $student->stud_id)->where('product_id', $product_id)->first();
            $check_payment = Payment::where('stud_id', $student->stud_id)->where('product_id', $product_id)->get();
            $ticket = Ticket::where('ic', $student->ic)->where('product_id', $product_id)->first();
            
            // // Check if ic exist
            // if($ultimate->membership_id == 'MB001'){
                
            //     return redirect('check-cert/' . $product_id . '/' . $platinum->stud_id);

            // }else if($platinum->membership_id == 'MB002'){

            //     return redirect('check-cert/' . $product_id . '/' . $ultimate->stud_id);

            // }else if($check_payment->isEmpty()){

            //     return view('certificate.not_found');

            // }else{

            //     if ($student->stud_id == $payment->stud_id || $ticket->ticket_id){
            //         return redirect('check-cert/' . $product_id . '/' . $student->stud_id);
            //     }

            // }
            return redirect('check-cert/' . $product_id . '/' . $student->stud_id); //erase
            
        }else{

            return view('certificate.not_found');

        }
    }

    public function checking_cert($product_id, $stud_id)
    {
        $product = Product::where('product_id', $product_id)->first();
        $student = Student::where('stud_id', $stud_id)->first();

        return view('certificate.check_detail', compact('product', 'student'));
    }

    public function extract_cert($product_id, $stud_id){
        $product = Product::where('product_id', $product_id)->first();
        $student = Student::where('stud_id', $stud_id)->first();
            
        //data in e-cert
        $data['first_name']=$student->first_name;
        $data['last_name']=$student->last_name;
        $data['ic']=$student->ic;
        $data['program_name']=$product->name;
        $data['cert_image']=$product->cert_image;
        $data['date_from']=date('d/m/Y', strtotime($product->date_from));        
        $data['date_to']=date('d/m/Y', strtotime($product->date_to));
        $data['product_id']=$product_id;        
        $data['student_id']=$stud_id;

        $pdf = PDF::loadView('certificate.cert', $data);
        return $pdf->download( $product->name . '.pdf');
    }

}
