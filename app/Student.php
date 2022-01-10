<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Database\Eloquent\Model;

class Student extends Authenticatable
{
    protected $table = 'student';

    protected $fillable = [
        'stud_id', 'first_name', 'last_name', 'ic', 'email', 'phoneno', 'membership_id', 'level_id', 'status', 'isSubscribe', 'student_password'
    ];

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function zooms()
    {
        return $this->belongsToMany(Zoom::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
