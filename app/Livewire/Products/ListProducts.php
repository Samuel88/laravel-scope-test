<?php

namespace App\Livewire\Products;

use App\Models\Product;
use DB;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;

class ListProducts extends Component
{
    public function render()
    {

        $latitude = 43.6636831;
        $longitude = 10.6282204;

        $products = Product::select('*')
            ->joinSub(
                DB::query()
                    ->fromSub(
                        DB::table("product_shop")
                            ->select([
                                'product_shop.product_id AS product_id',
                                'shops.id AS shop_id',
                                'shops.name AS shop_name',
                                'shops.address AS shop_address',
                                'shops.city AS shop_city',
                                'shops.phone AS shop_phone',
                                'shops.latitude AS shop_latitude',
                                'shops.longitude AS shop_longitude',
                            ])
                            ->selectRaw('
                                ROW_NUMBER() OVER(
                                    PARTITION BY `product_shop`.`product_id`
                                    ORDER BY ST_Distance_Sphere(
                                        Point(`shops`.`latitude`, `shops`.`longitude`),
                                        Point(?, ?)
                                    )
                                ) AS `counter`
                            ', [$latitude, $longitude])
                            ->join("shops","shops.id","=","product_shop.shop_id"), 
                        't'
                    )
                    ->where('t.counter', '=', 1),
                'product_shop_nearest',
                'products.id',
                '=',
                'product_shop_nearest.product_id'
            )
            ->paginate(4);

        return view('livewire.products.list-products', compact('products'));
    }
}
