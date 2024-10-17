{{-- demo show list product client by field status and show at home --}}
@foreach ($products as $product)
    <div class="product">
        <h2>{{ $product->name }}</h2>
        <p>{{ $product->short_description }}</p>
        <span>{{ $product->price }}</span>
    </div>
    <a href="{{ route('client.show', $product->id) }}" class="btn btn-secondary">Show</a>
@endforeach
