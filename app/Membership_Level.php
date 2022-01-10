<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership_Level extends Model
{
    protected $table = 'membership_level';

    protected $fillable = [
        'level_id', 'name', 'membership_id', 'price', 'description', 'tax',
    ];
}
