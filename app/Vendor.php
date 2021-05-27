<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
class Vendor extends Model
{
    protected $table = 'vendors';

    protected $fillable = ['user_id','shop_name','shop_phone_number','shop_address'];


    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
