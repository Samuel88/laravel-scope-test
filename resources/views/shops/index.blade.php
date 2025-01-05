<x-layouts.app>
    <x-slot:title>
        Shop List
    </x-slot:title>

    <x-slot:head>
        <meta title="Shop List">
        <meta description="List all shops">
    </x-slot:head>

    <livewire:geolocation-live/>

    @foreach ($shops as $shop)
        <x-shops.item :item="$shop"/>
    @endforeach

    {{ $shops->links() }}
</x-layouts.app>