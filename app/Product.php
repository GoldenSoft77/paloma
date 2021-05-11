<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductImage;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name','price','description','count','status','section_id','vendor_id','main_img'];

    public function images() {
        return $this->hasMany('App\ProductImage');
    }  

}
