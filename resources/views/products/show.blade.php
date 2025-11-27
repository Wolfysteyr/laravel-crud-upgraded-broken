<x-layout>
    <x-slot:title>
        Show a product
    </x-slot>

    @if ($errors->any())
        <div class="error-message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>{{ $product->name }}</h1>
    <h4>Quantity: {{ $product->quantity }}</h4>
    <p>{{ $product->description }}</p>

    <form action="{{route('products.increase', $product)}}" method="post">
        @csrf
        @method('POST')
        <input type="submit" value="Increase Quantity">
    </form>

    <form action="{{route('products.decrease', $product)}}" method="post">
        @csrf
        @method('POST')
        <input type="submit" value="Decrease Quantity">
    </form>


    <a href="{{ route('products.edit', $product) }}">Edit</a>
    <form action="{{ route('products.destroy', $product) }}" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete">
    </form>
</x-layout>