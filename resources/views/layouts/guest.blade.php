<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Nouichi Store</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Additional Styles -->
        <style>
            .bg-pattern {
                background-color: #f3f4f6;
                background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23d4af37' fill-opacity='0.08'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
    <header class="sticky top-0 z-50 bg-white shadow">
    <x-header />
    </header>

        <div class="min-h-screen flex flex-col items-center bg-pattern relative pt-8">
            <!-- Decorative Elements -->
            <div class="absolute inset-0 z-0 opacity-75 bg-gradient-to-br from-white via-transparent to-white"></div>
            
            <!-- Logo Area -->
            <div class="w-full sm:max-w-md px-6 py-2 z-10">
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Nouichi Store" class="h-16 w-auto">
                </div>
            </div>

            <!-- Main Content Box -->
            <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-[0_5px_25px_-5px_rgba(0,0,0,0.1)] rounded-lg z-10 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-[#d4af37] to-[#b8972e]"></div>
                {{ $slot }}
            </div>

          
        </div>
        <footer >
    <x-footer />
    </footer>
    </body>
</html>
