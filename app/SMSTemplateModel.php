<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SMSTemplateModel extends Model
{
    protected $table = 'sms_template';
	
	protected $fillable = [
        'title', 'content', 'description', 'user_id'
    ];

    public function bulks()
    {
        return $this->hasMany(SMSBulkModel::class);
    }
}
