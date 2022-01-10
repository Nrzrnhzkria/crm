<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class PaidTicket_Export implements FromView
{
    use Exportable;

    private $ticket = [], $students = [], $package = [];

    public function __construct($ticket_list, $student_list, $package_list){
        $this->ticket = $ticket_list;
        $this->student = $student_list;
        $this->package = $package_list;
    }

    public function view(): View
    {
        return view('admin.reports.export_ticket', [
            'ticket' => $this->ticket,
            'student' => $this->student,
            'package' => $this->package,
        ]);
    }

}
