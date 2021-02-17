<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'content', 'user_id'
    ];

    //Note belongsTo one user 
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
