<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MembersFormat implements FromView
{
    public function view(): View
    {
        return view('admin.reports.members_export_format');
    }
}
