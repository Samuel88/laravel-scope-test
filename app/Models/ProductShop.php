<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductShop extends Pivot
{
    public function colors() {
        return $this->belongsToMany(Color::class, 'product_shop_color', 'product_shop_id');
    }
}
