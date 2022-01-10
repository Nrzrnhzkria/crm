<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'ticket';

    protected $fillable = [
        'ticket_id', 'ticket_type', 'ic', 'pay_price', 'upgrade_count', 'pay_method', 'status', 'stripe_id', 'billplz_id', 'email_status', 'stud_id', 'product_id', 'package_id', 'payment_id', 'user_id'
    ];
}
