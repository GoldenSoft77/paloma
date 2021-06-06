<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiRequest extends Model
{
    public $timestamps = true;

    protected $table = 'api_requests';
    protected $fillable = ['api_request','edit_time'];
  
}
