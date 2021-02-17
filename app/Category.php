<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];

    //Category belongsToMany books 
    public function books()
    {
        return $this->belongsToMany('App\Book');
    }
}
