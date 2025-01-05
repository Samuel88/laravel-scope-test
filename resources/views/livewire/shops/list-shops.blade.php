<div>
    <h1>{{ $latitude }}</h1>
    <h1>{{ $longitude }}</h1>
    <button wire:click="updateLocation2(0.0, 0.0)">Aggiorna Locazione</button>
    @foreach ($shops as $shop)
        <x-shops.item wire:key="{{ $shop->id }}" :item="$shop"/>
    @endforeach
</div>
