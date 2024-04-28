<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel URL Shortener</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center">

<header class="container mx-auto p-6 bg-white rounded-lg shadow-md max-w-md">
    <h1 class="text-4xl font-bold text-blue-900 dark:text-blue-900">URL Shortener</h1>
    <nav>
        @auth
            <a href="{{ url('/dashboard') }}" class="text-gray-800 hover:text-gray-600">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="text-gray-800 hover:text-gray-600">Log in</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="text-gray-800 hover:text-gray-600 ml-4">Register</a>
            @endif
        @endauth
    </nav>
</header>
@if (session('success'))
    <br>
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<br>
<main class="container mx-auto p-6 bg-white rounded-lg shadow-md max-w-md">
    <section class="mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-2">Shorten Your URL</h2>
        <form method="POST" id="shorten-form" action="{{ route('short.url') }}">
            @csrf
            <label for="url-input" class="sr-only">URL</label>
            <input type="url" id="url-input" placeholder="Paste your long URL here"
                   class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" name="url" required>
            <button type="submit"
                    class="bg-blue-500 text-white font-medium py-2 px-4 rounded-md mt-4 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Short
            </button>
        </form>
    </section>

    <section class="result-section" id="shortened-url">
        <h3 class="text-lg font-bold text-gray-800 mb-2">Your shortened URL: @if(session ('shortedUrl')) <p id="short-link" class="rounded-md px-4 py-2 bg-gray-200 text-white-800">{{ url(session('shortedUrl')) }}</p> @endif</h3>
        <div class="flex items-center">
            <button id="copy-button" data-clipboard-target="#short-link"
                    class="bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-md ml-4 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                Copy
            </button>
        </div>
    </section>
</main>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.11/dist/clipboard.min.js"></script>
<script>
    var clipboard = new ClipboardJS('#copy-button');

    clipboard.on('success', function(e) {
        // Optional: Display a success message or change button appearance
    });

    clipboard.on('error', function(e) {
        // Optional: Handle copy errors
    });
</script>
</body>
</html>
