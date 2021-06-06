<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public $timestamps = true;

    protected $table = 'notifications';
    protected $fillable = ['notification_message','user_id','status'];
  
}
