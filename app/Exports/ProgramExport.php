<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class ProgramExport implements FromView
{
    use Exportable;

    private $payment  = [], $students = [], $package = [];

    public function __construct($payment_list, $student_list, $package_list){
        $this->payment = $payment_list;
        $this->student = $student_list;
        $this->package = $package_list;
    }

    public function view(): View
    {
        return view('admin.reports.exportExcel', [
            'payment' => $this->payment,
            'student' => $this->student,
            'package' => $this->package,
        ]);
    }

    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     if(Payment::where('product_id', $product_id)){
    //         // return Payment::all();
    //     }else{
    //     }

        
    // }

}

