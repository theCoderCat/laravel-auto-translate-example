<?php

namespace App;

class Post extends TranslatableModel
{
    //
    public $translatedAttributes = [
      'title',
      'content'
    ];
    protected $fillable = [
      'category_id',
    ];
}
