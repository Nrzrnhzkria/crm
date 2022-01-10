<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentStaff extends Model
{
    protected $table = 'studentstaff';

    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'ic', 'email', 'no_phone', 'student_invite_id'
    ];
}
