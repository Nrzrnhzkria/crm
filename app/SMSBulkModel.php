<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SMSBulkModel extends Model
{
    protected $table = 'smsbulk';
	
	protected $fillable = [
        'phone', 'template_id', 'user_id', 'message'
    ];
	
	public function template()
    {
        return $this->belongsTo(SMSTemplateModel::class);
    }
}
