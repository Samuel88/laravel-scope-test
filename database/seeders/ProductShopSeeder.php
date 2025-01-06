<?php

namespace Database\Seeders;

use App\Models\Shop;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shops = Shop::inRandomOrder()->limit(6)->get();
        foreach ($shops as $shop) {
            $products = Product::inRandomOrder()->limit(fake()->randomNumber(1))->get();
            $products->each(function ($product) use ($shop) {
                $shop->products()->attach($product->id, [
                    'qty' => fake()->randomNumber(1)
                ]);
            });
        }
    }
}
