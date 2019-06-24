<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = [ 
    	'project_name','id_mgr'
    ] ;

    public function tasks() {
    	return $this->hasMany('App\Task');
    }


}
