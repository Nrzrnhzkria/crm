<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cronjob extends Model
{
    protected $table = 'cronjobs';

    protected $fillable = [
        'job_id', 'product_id', 'package_id', 'payment_id', 'stud_id'
    ];
}
