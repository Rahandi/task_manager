<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignTask extends Model
{
    protected $table = "assign_task";
    protected $fillable = [ 
    	'task_id','filename','id_user'
    ] ;

    
}
