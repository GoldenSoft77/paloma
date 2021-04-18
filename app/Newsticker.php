<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsticker extends Model
{
    protected $table = 'news_tickers';
    protected $fillable = ['sentencs'];
}
