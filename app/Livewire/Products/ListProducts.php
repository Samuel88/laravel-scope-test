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
        $products = DB::table("products")
            ->joinSub("
                SELECT
                        `t`.*
                    FROM (
                        SELECT
                            `product_shop`.`product_id`,
                            `shops`.`id` AS `shop_id`,	
                            `shops`.`name` AS `shop_name`,
                            `shops`.`address` AS `shop_address`,
                            `shops`.`city` AS `shop_city`,
                            `shops`.`phone` AS `shop_phone`,
                            `shops`.`latitude` AS `shop_latitude`,
                            `shops`.`longitude` AS `shop_longitude`,
                            ROW_NUMBER() OVER(
                                PARTITION BY `product_shop`.`product_id`
                                ORDER BY ST_Distance_Sphere(
                                    Point(`shops`.`latitude`, `shops`.`longitude`),
                                    Point(43.6636831, 10.6282204)
                                )
                            ) AS `counter`
                        FROM `product_shop`
                            JOIN `shops`
                                ON `shops`.`id` = `product_shop`.`shop_id`
                    ) AS `t`
                    WHERE
                        `t`.`counter` = 1
            ", 'product_shop_nearest', "products.id","=","product_shop_nearest.product_id")
            //->toRawSql();
            //->toSql();
            ->paginate(2);
        //$products = Product::with('shops')->get();

        return view('livewire.products.list-products', compact('products'));
    }
}
