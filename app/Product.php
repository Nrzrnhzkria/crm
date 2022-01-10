<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $fillable = [
        'product_id', 'name', 'status', 'date_from', 'date_to', 'time_from', 'time_to', 'cert_image', 'offer_id', 'collection_id', 'survey_form', 'zoom_link', 'tq_page'
    ];

}
