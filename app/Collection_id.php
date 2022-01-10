<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection_id extends Model
{
    protected $table = 'billplz_collection_id';

    protected $fillable = [
        'collection_id', 'name'
    ];
}
