<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BalancePackage extends Model
{
    protected $table = 'balance_packages';

    protected $fillable = ['units','cost','company'];
}
