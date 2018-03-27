<?php

namespace App;


class Category extends TranslatableModel
{
    //
    public $translatedAttributes = [    
      'title',
    ];
    protected $fillable = [
      'title',
    ];

    public function posts() {
        return $this->hasMany('App\Post');
    }
}
