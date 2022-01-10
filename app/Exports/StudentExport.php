<?php

namespace App\Exports;

use App\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
// use Maatwebsite\Excel\Concerns\FromCollection;

// class StudentExport implements FromCollection
class StudentExport implements FromView
{
    public function view(): View
    {
        return view('admin.reports.import_format');
    }

}
