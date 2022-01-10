<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Http\Controllers\PDF;

class StatementMembership implements FromView
{
    public function view(): View
    {
        return view('admin.reports.statement_membership_format');
    }
}
