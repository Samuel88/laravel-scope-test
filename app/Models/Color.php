<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function productShops() {
        return $this->belongsToMany(ProductShop::class, 'product_shop_color', 'color_id');
    }
}
