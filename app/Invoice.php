<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
