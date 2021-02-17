<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //eh el 7agat ely ynf3 a3mlha create fel database
    protected $fillable = [
        'name', 'desc', 'img', 'price', 'author_id'
    ];

    //Book belongsTo author
    public function author()
    {
        return $this->belongsTo('App\Author');
    }

    //Book belongsToMany categories 
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
    
}