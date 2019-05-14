<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Project extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'deskripsi', 'team_id',
    ];

    /**
     * One to one relationship
     * 
     * return project yang dikerjakan oleh tim
     */
    public function team(){
        return $this->HasOne('App\Team');
    }

    /**
     * Many to one relationship
     * 
     * return task yang berada dalam project
     */
    public function task(){
        return $this->hasMany('App\Task');
    }

}
