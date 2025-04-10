<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nouichi Store</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- If using Laravel Breeze --}}
</head>
<body class="bg-gray-100 text-gray-900">

    {{-- 🔼 Header --}}
    <header>
    <x-header />
    </header>

    {{-- 📦 Page Content --}}
    <main class="container mx-auto p-6">
        @yield('content')
    </main>

    {{-- 🔽 Footer --}}
    <footer class="bg-white shadow p-4 mt-12">
    <x-footer />
    </footer>
<!-- jQuery -->


<!-- Bootstrap JS (with Popper) -->

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>



</script>
</body>
</html>
