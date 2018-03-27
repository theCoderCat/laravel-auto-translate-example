<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Post extends BaseModel
{
    //
    public $translatedAttributes = [
      'title',
      'content'
    ];
    protected $fillable = [
      'title',
      'content'
    ];
}
