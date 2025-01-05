@props([
    'item'
])

<div>
    <h3>{{ $item->name }} / {{ $item->latitude }} {{ $item->longitude }} / {{ $item->distance }}</h3>
    <p>{{ $item->address }} - {{ $item->city }}</p>
    <p>{{ $item->phone }}</p>
    <pre>{{ json_encode($item) }}</pre>
</div>