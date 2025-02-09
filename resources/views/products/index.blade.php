<x-layouts.app>
    @foreach ($products as $product)
        <div>
            <h3>{{ $product->name }}</h3>
            <h4>{{ $product->shop_name }}</h4>
            <p>{{ $product->shop_qty }}</p>
            <a href="{{ route('products.show', $product)  }}">GO</a>
        </div>
    @endforeach
    {{ $products->links() }}
</x-layouts.app>