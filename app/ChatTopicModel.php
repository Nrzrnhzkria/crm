<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatTopicModel extends Model
{
    //
	protected $table = 'chat_topic';
	
	protected $fillable = [
        'title', 'status'
    ];
}
