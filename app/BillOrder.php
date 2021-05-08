<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillOrder extends Model
{
    protected $table = 'bill_orders';

    protected $fillable = ['type','amount','name','city','number','counter_number','status','user_id'];
}
