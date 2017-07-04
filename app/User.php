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
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function detail()
    {
        return $this->hasOne('App\UserDetail', 'user_id');
    }

    public function socialToken()
    {
        return $this->hasOne('App\SocialToken', 'user_id');
    }

    public function organizers()
    {
        return $this->hasMany('App\Organizer', 'user_id');
    }
}
