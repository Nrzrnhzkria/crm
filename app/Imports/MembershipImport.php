<?php

namespace App\Imports;

use App\Membership;
use Illuminate\Support\Facades\Hash;
use App\Membership_Level;
use App\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MembershipImport implements ToCollection, WithChunkReading, WithHeadingRow
{
    private $membership_id, $level_id;

    public function __construct($membership_id, $level_id){
        $this->membership_id = $membership_id;
        $this->level_id = $level_id;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $student = Student::where('ic', $row['ic'])->first();

            if(Student::where('ic', $row['ic'])->exists()){

                $student->first_name    = ucwords(strtolower($row['first_name']));
                $student->last_name     = ucwords(strtolower($row['last_name']));
                $student->ic            = $row['ic'];
                $student->email         = $row['email'];
                $student->phoneno       = '+' . $row['phoneno'];
                $student->membership_id = $this->membership_id;
                $student->level_id      = $this->level_id;
                $student->status        = 'Active';
                $student->save();

            }else{

                $stud_id = 'MI' . uniqid();

                Student::create([
                    'stud_id'           => $stud_id,
                    'first_name'        => ucwords(strtolower($row['first_name'])),
                    'last_name'         => ucwords(strtolower($row['last_name'])), 
                    'ic'                => $row['ic'],
                    'email'             => $row['email'],
                    'phoneno'           => '+' . $row['phoneno'],
                    'membership_id'     => $this->membership_id,
                    'level_id'          => $this->level_id,
                    'status'            => 'Active',
                    'student_password' => 'password',
                ]);

            }
        }
        
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
