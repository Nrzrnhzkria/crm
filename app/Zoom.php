<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zoom extends Model
{
    protected $table = 'zooms';

    protected $fillable = [
        'topic', 'start_time', 'end_time'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
