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

    <h2>Tagi</h2>
    @if ($product->tags->isEmpty())
        <p>Nav pievienotu tagu.</p>
    @else
        <ul>
            @foreach ($product->tags as $tag)
                <li>
                    {{ $tag->name }}
                    <form
                        action="{{ route('products.tags.destroy', [$product, $tag]) }}"
                        method="POST"
                        style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">X</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
    <h3>Pievienot tagu</h3>
    <form
        action="{{ route('products.tags.store', $product) }}"
        method="POST"
        autocomplete="off">
        @csrf
        <input
            type="text"
            name="name"
            placeholder="Jauns tags"
            required
            autocomplete="off"
            data-tag-autocomplete
            data-autocomplete-url="{{ route('tags.search') }}"
        >
        <button type="submit">Pievienot</button>
    </form>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <a href="{{ route('products.edit', $product) }}">Edit</a>
    <form action="{{ route('products.destroy', $product) }}" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete">
    </form>
    @vite(['resources/js/product-quantity.js', 'resources/js/tags-autocomplete.js'])
</x-layout>