<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    

    /**
     * Many to One relationship
     * 
     * return task yang dikerjakan user
     */
    public function task(){
        return $this->hasMany('App\Task');
    }

    /**
     * Many to Many relationship
     * 
     * return tim yang mengandung user ini
     */
    public function team(){
        return $this->belongsToMany('App\Team')->withPivot('level');
    }

    /**
     * Fungsi yang mereturn level dari user
     * 
     * @param user_id,team_id
     * 
     * return integer
     */

     public function level($id,$team_id){
          return $level = User::find($id)->team->find($team_id)->pivot->level;
     }
}
