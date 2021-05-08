<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Newsticker extends Model
{
    use Translatable;

    protected $table = 'news_tickers';
    protected $fillable = ['static'];
    public $translatedAttributes = ['sentencs'];
}
