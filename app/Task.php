<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'project_id', 'nama', 'deskripsi', 'konten', 'kategori', 'bobot',
    ];

    /**
     * One to Many relationship
     * 
     * return user yang mengerjakan task
     */
    public function user(){
        return $this->belongsTo('App\User');
    }

    /**
     * one to Many relationship
     * 
     * return project yang memiliki task ini
     */
    public function project(){
        return $this->belongsTo('App\Project');
    }
}
