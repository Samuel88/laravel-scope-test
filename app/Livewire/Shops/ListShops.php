<?php

namespace App\Livewire\Shops;

use Livewire\Component;
use App\Models\Shop;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;



class ListShops extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $latitude = 0.0;
    public $longitude = 0.0;

    #[On("geolocation-update")]
    public function updateLocation($coords = null, $timestamp = null) {
        $this->latitude = $coords['latitude'];
        $this->longitude = $coords['longitude'];
    }

    public function updateLocation2($latitude, $longitude) {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function render()
    {
        return view('livewire.shops.list-shops', [
            'shops' => Shop::select('*')
                ->withDistanceTo($this->latitude, $this->longitude)
                ->orderBy('distance', 'desc')
                ->paginate(4),
        ]);
    }
}
