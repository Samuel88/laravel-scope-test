<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class ListProducts extends Component
{
    use WithPagination, WithoutUrlPagination;

    public float $latitude = 0.0;
    public float $longitude = 0.0;

    #[On("geolocation-update")]
    public function updateLocation($coords = null, $timestamp = null) {
        $this->latitude = $coords['latitude'];
        $this->longitude = $coords['longitude'];
    }

    public function render()
    {
        $products = Product::withNearestShopFrom($this->latitude, $this->longitude)
            ->paginate(perPage: 4);

        return view('livewire.products.list-products', compact('products'));
    }
}
