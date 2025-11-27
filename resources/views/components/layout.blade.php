<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Products' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container">
        <header>
            <x-navigation />
        </header>

        <aside>
            @if (session('message'))
                <div class="status-message">
                    {{ session('message') }}
                </div>
            @endif
        </aside>

        <main>
            {{ $slot }}
        </main>

        <footer>
            &copy; Ventspils Tehnikums 2025
        </footer>
    </div>
</body>
</html>
