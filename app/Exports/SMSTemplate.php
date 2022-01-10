<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SMSTemplate implements FromView
{
    public function view(): View
    {
        return view('admin.sms.smsbulk.download_template');
    }

}
