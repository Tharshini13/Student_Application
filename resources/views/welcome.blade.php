<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome | Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex items-center justify-center min-h-screen px-6">
    <div class="w-full max-w-3xl text-center">
        <header class="mb-8">
            @if (Route::has('login'))
                <nav class="flex justify-end space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2 rounded-md border border-gray-300 text-gray-900 dark:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-700 transition">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-5 py-2 rounded-md bg-green-600 text-white hover:bg-green-700 transition">Register</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <main class="space-y-6">
            <h1 class="text-4xl font-bold">Welcome to Student Crud application</h1>
            <div class="mt-6">
                <a href="{{ url('/dashboard') }}" class="px-6 py-3 bg-blue-600 text-white rounded-md shadow-md hover:bg-blue-700 transition">Get Started</a>
            </div>
        </main>
    </div>
</body>
</html>