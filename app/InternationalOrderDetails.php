<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\InternationalOrder;

class InternationalOrderDetails extends Model
{
    protected $table = 'international_orders_details';
    protected $fillable = ['order_id','website_link'];

 
    public function order() {
        return $this->belongsTo('App\InternationalOrder');
    }
}
