<?php

namespace App\Livewire\Shops;

use Livewire\Component;
use App\Models\Shop;
use Livewire\Attributes\On;


class ListShops extends Component
{
    public $shops;
    public $latitude = 0.0;
    public $longitude = 0.0;

    public function mount() {
        $this->shops = Shop::select('*')
            ->withDistanceTo($this->latitude, $this->longitude)
            ->orderBy('distance', 'desc')
            ->get();
    }

    #[On("geolocation-update")]
    public function updateLocation($coords = null, $timestamp = null) {
        $this->latitude = $coords['latitude'];
        $this->longitude = $coords['longitude'];
        $this->shops = Shop::select('*')
            ->withDistanceTo($this->latitude, $this->longitude)
            ->orderBy('distance', 'desc')
            ->get();
    }

    public function updateLocation2($latitude, $longitude) {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->shops = Shop::select('*')
            ->withDistanceTo($this->latitude, $this->longitude)
            ->orderBy('distance', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.shops.list-shops');
    }
}
