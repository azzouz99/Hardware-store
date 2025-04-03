<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hardware Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- If using Laravel Breeze --}}
</head>
<body class="bg-gray-100 text-gray-900">

    {{-- 🔼 Header --}}
    <header class="bg-white shadow p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">🛠️ Hardware Store</h1>
            <nav>
                <a href="/" class="mx-2 hover:underline">Home</a>
                <a href="/products" class="mx-2 hover:underline">Products</a>
                <a href="/cart" class="mx-2 hover:underline">Cart</a>
                @auth
                    <a href="/dashboard" class="mx-2 hover:underline">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="mx-2 hover:underline text-red-600">Logout</button>
                    </form>
                @else
                    <a href="/login" class="mx-2 hover:underline">Login</a>
                    <a href="/register" class="mx-2 hover:underline">Register</a>
                @endauth
            </nav>
        </div>
    </header>

    {{-- 📦 Page Content --}}
    <main class="container mx-auto p-6">
        @yield('content')
    </main>

    {{-- 🔽 Footer --}}
    <footer class="bg-white shadow p-4 mt-12">
        <div class="text-center text-sm text-gray-600">
            © {{ date('Y') }} Hardware Store. All rights reserved.
        </div>
    </footer>

</body>
</html>
