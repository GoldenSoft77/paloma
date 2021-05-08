<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BalanceOrder;

class BalancePackage extends Model
{
    protected $table = 'balance_packages';

    protected $fillable = ['units','cost','company'];

    public function orders()
    {
        return $this->hasMany(BalanceOrder::class);
    }
}
