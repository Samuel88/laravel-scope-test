<div>
    {{-- $products --}}
    {{ $latitude }} / {{ $longitude }}
    @foreach ($products as $product)
        <div>
            <h3>{{ $product->name }}</h3>
            <h4>{{ $product->shop_name }}</h4>
            <p>{{ $product->shop_qty }}</p>
        </div>
    @endforeach
    {{ $products->links() }}
</div>
