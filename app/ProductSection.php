<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSection extends Model
{
    protected $table = 'product_sections';

    protected $fillable = ['icon','name'];
}
