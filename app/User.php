<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'admin' ,'password','idUser','role','has_finish_tour'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tasks() {
        return $this->hasMany('App\Task') ;
    }

    public function isMhs()    {        
        return $this->admin === 0;    
    }

    public function isAdmin()    {        
        return $this->admin === 1;    
    }

    public function isDosen()    {        
        return $this->role === 'dosen';    
    }

}
