<?php

namespace App\Imports;

use App\Student;
use App\Ticket;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ParticipantImport implements ToCollection, WithChunkReading, WithHeadingRow
{
    private $prd_id, $pkd_id, $user_id;

    public function __construct($prd_id, $pkd_id, $user_id){
        $this->product = $prd_id;
        $this->package = $pkd_id;
        $this->user_id = $user_id;
    }

    public function collection(Collection $rows)
    {
        // dump($rows[2]);

        foreach ($rows as $row) 
        {
            $student = Student::where('ic', $row['ic'])->first();

            if(Student::where('ic', $row['ic'])->exists()){

                $ticket_id = 'TIK' . uniqid();

                Ticket::create([
                    'ticket_id'     => $ticket_id,
                    'ticket_type'   => $row['ticket_type'],
                    'ic'            => $row['ic'],
                    'email_status'  => 'Hold',
                    'stud_id'       => $student->stud_id,
                    'product_id'    => $this->product,
                    'package_id'    => $this->package,
                    'user_id'       => $this->user_id,
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
                ]);

                $ticket_id = 'TIK' . uniqid();

                Ticket::create([
                    'ticket_id'     => $ticket_id,
                    'ticket_type'   => $row['ticket_type'],
                    'ic'            => $row['ic'],
                    'email_status'  => 'Hold',
                    'stud_id'       => $stud_id,
                    'product_id'    => $this->product,
                    'package_id'    => $this->package,
                    'user_id'       => $this->user_id,
                ]);
            }
        }
        
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
