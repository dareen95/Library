<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'api_token' , 'oauth_token'
    ];

    protected $hidden = [
        'password'
    ];

    //User hasMany notes
    public function notes()
    {
        return $this->hasMany('App\Note');
    }
}
