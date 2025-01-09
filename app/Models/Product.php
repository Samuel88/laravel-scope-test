<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price'];

    public function shops(): BelongsToMany {
        return $this->belongsToMany(Shop::class)
            ->withPivot('qty');
    }

    public function scopeWithNearestShopFrom(Builder $query, float $latitude, float $longitude): void {
        $query->joinSub(
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
        );
    }
}
