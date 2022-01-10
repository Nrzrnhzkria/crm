<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserChatModel extends Model
{
    //
	protected $table = 'user_chat';
	
	protected $fillable = [
        'name', 'phone', 'email', 'stud_id', 'user_id', 'notes', 'channel', 'topic_id'
    ];
	
	public function student(){
		return $this->belongsTo(Student::class);
	}
	
	public function user(){
		return $this->belongsTo(User::class);
	}
}
