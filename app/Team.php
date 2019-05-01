<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id', 'nama', 'deskripsi',
    ];

    /**
     * One to One relationship
     * 
     * return project yang dikerjakan tim
     */
    public function project(){
        return $this->belongsTo('App\Project');
    }

    /**
     * Many to Many relationship
     * 
     * return user yang berada pada tim ini
     */
    public function user(){
        return $this->belongsToMany('App\User')->withPivot('level');
    }
}
