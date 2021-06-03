<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\User;

class FavoriteProduct extends Model {
    
    protected $table = 'favorite_products';

    protected $fillable = ['product_id','user_id'];

    public function products() {
        return $this->belongsTo('App\Product');
    }
    public function user()
    {
        return $this->belongsTo('App\User'); 
    }
    
}
