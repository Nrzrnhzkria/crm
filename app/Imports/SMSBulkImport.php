<?php

namespace App\Imports;

use App\Student;
use App\Payment;
use App\Ticket;
use App\Jobs\SMSBulkSender;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SMSBulkImport implements ToCollection, WithChunkReading, WithHeadingRow
{	
	private $_templateId = "", $_regexData = [];
	
    public function __construct($templateId, $regexData){
		$this->_templateId = $templateId;
		$this->_regexData = $regexData;
    }

    public function collection(Collection $rows)
    {	
        dispatch(new SMSBulkSender($rows, $this->_templateId, $this->_regexData));
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
