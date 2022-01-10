<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    protected $table = 'mails';

    protected $fillable = [
        'title', 'content', 'date'
    ];
}
