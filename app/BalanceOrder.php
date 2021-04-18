<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BalanceOrder extends Model
{
    protected $table = 'balance_orders';

    protected $fillable = ['user_id','package_id','phone_number','status'];
}
