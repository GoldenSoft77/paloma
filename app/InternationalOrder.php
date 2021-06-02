<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\InternationalOrderDetails;

class InternationalOrder extends Model
{
   

    protected $table = 'international_orders';
    protected $fillable = ['user_id', 'status','amount','receiver_city','receiver_address','receiver_name','receiver_number'];

   
    public function user() {
        return $this->belongsTo('App\User');
    }  

    public function orderDetails() {
        return $this->hasMany('App\InternationalOrderDetails');
    }    
}

