<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\OnlineOrderDetails;

class OnlineOrder extends Model
{
   

    protected $table = 'online_orders';
    protected $fillable = ['user_id', 'status','amount'];

   
    public function user() {
        return $this->belongsTo('App\User');
    }  

    public function orderDetails() {
        return $this->hasMany('App\OnlineOrderDetails');
    }    
}

