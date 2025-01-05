<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;


class GeolocationLive extends Component
{
    #[On("geolocation-update")]
    public function updateLocation($coords = null, $timestamp = null) {
        session([
            "coords" => $coords,
            "timestamp" => $timestamp
        ]);
    }

    public function render()
    {
        return view('livewire.geolocation-live');
    }
}
