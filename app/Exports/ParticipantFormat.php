<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ParticipantFormat implements FromView
{
    public function view(): View
    {
        return view('admin.reports.participant_export_format');
    }
}
