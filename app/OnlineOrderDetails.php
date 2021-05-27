<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\OnlineOrder;

class OnlineOrderDetails extends Model
{
    protected $table = 'online_orders_details';
    protected $fillable = ['order_id','product_id','price','quantity'];

    public function product() {
        return $this->belongsTo('App\Product');
    }
    public function order() {
        return $this->belongsTo('App\OnlineOrder');
    }
}
