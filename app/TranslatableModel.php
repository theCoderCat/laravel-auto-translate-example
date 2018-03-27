<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class TranslatableModel extends Model 
{
    use Translatable;
    //
    public $translatedAttributes = [];

    protected $fillable = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $locale = \App::getLocale();
        
        $this->defaultLocale = $locale;
    }
}
