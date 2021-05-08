<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'vendors';

    protected $fillable = ['user_id','shop_name','shop_phone_number','shop_address'];
}
