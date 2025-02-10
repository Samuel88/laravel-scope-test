<x-layouts.app>

    <x-slot:title>
        Product
    </x-slot:title>

    @dump($product)
    
    @foreach ($colors as $color)
        @dump($color)
    @endforeach
</x-layouts.app>