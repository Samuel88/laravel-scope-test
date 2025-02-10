<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ProductShop;
use App\Models\Color;

class ProductShopColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productShops = ProductShop::inRandomOrder()->limit(10)->get();
        foreach ($productShops as $productShop) {
            $colors = Color::inRandomOrder()->limit(2)->get();
            $colors->each(function ($color) use ($productShop) {
                $productShop->colors()->attach($color->id);
            });
        }
    }
}
