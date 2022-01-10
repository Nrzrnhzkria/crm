<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'package';

    protected $fillable = [
        'package_id', 'name', 'price', 'package_image', 'product_id'
    ];
}
