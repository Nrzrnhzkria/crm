<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $table = 'feature';

    protected $fillable = [
        'feat_id', 'name', 'product_id', 'package_id'
    ];
}
