<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Socailmedia extends Model
{
    protected $table = 'socail_links';
    protected $fillable = ['facebook','twitter','instagram','youtube','whatsapp'];
}
