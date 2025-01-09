<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;

class ListProducts extends Component
{
    public function render()
    {

        $latitude = 43.6636831;
        $longitude = 10.6282204;

        $products = Product::select('*')
            ->withNearestShopTo($latitude, $longitude)
            ->paginate(4);

        return view('livewire.products.list-products', compact('products'));
    }
}
