<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nilaitask extends Model
{
    protected $table = 'nilaitask';
    protected $fillable =[ 
    	'task_id','user_id','nilai'];

}
