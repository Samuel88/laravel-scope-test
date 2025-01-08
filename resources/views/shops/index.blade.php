<x-layouts.app>
    <x-slot:title>
        Shop List
    </x-slot:title>

    <x-slot:head>
        <meta title="Shop List">
        <meta description="List all shops">
    </x-slot:head>

    <livewire:geolocation-live/>
    {{--<livewire:shops.list-shops/>--}}
    <livewire:products.list-products/>
</x-layouts.app>