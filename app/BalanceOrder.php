<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BalancePackage;


class BalanceOrder extends Model
{
    protected $table = 'balance_orders';

    protected $fillable = ['user_id','package_id','phone_number','status'];

    public function packages()
    {
        return $this->belongsTo('App\BalancePackage', 'package_id'); // links this->package_id to balance_packages.id
    }
}
