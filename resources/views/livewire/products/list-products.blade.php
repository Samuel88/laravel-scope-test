<div>
    {{-- $products --}}
    @foreach ($products as $product)
        <div>
            <h3>{{ $product->name }}</h3>
            <h4>{{ $product->shop_name }}</h4>
        </div>
    @endforeach
    {{ $products->links() }}
</div>
