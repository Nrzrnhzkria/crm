<?php

namespace App\Imports;

use App\Student;
use App\Payment;
use App\Ticket;
use App\Membership_Level;
use Illuminate\Support\Facades\Hash;
use App\Jobs\TestJobMail;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Crypt;

class StudentImport implements ToCollection, WithChunkReading, WithHeadingRow
{
    private $prd_id, $pkd_id, $_user_id;

    public function __construct($prd_id, $pkd_id, $user_id){
        $this->product = $prd_id;
        $this->package = $pkd_id;
		$this->_user_id = $user_id;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $student = Student::where('ic', $row['ic'])->first();
            
            if(Student::where('ic', $row['ic'])->exists()){

                // $payment_id = 'OD' . uniqid();

                Payment::create([
                    'payment_id'    => 'OD' . uniqid(),
                    'pay_price'     => $row['price'], 
                    'quantity'      => $row['quantity'],
                    'totalprice'    => $row['payment'],
                    'status'        => $row['status'],
                    'pay_method'    => $row['pay_method'], 
                    'email_status'  => 'Hold',
                    'stud_id'       => $student->stud_id,
                    'offer_id'      => $row['offer_id'], 
                    'user_id'       => $this->_user_id,
                    'product_id'    => $this->product,
                    'package_id'    => $this->package,
                ]);

            }else{

                
                $stud_id = 'MI' . uniqid();

                Student::create([
                    'stud_id'    => $stud_id,
                    'first_name' => ucwords(strtolower($row['first_name'])),
                    'last_name'  => ucwords(strtolower($row['last_name'])), 
                    'ic'         => $row['ic'],
                    'email'      => $row['email'],
                    'phoneno'    => '+' . $row['phoneno'],
                    'student_password' => Hash::make($row['ic']),
                ]);

                Payment::create([
                    'payment_id'    => 'OD' . uniqid(),
                    'pay_price'     => $row['price'], 
                    'quantity'      => $row['quantity'],
                    'totalprice'    => $row['payment'],
                    'status'        => $row['status'],
                    'pay_method'    => $row['pay_method'], 
                    'email_status'  => 'Hold',
                    'stud_id'       => $stud_id,
                    'offer_id'      => $row['offer_id'], 
                    'user_id'      	=> $this->_user_id,
                    'product_id'    => $this->product,
                    'package_id'    => $this->package,
                ]);

            }
        }
        
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
