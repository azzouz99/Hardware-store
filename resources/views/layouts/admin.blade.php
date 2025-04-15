<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/appAdmin.js'])
    <!-- Custom Admin CSS -->
    @vite(['resources/css/admin.css'])
   
@livewireStyles
</head>
<body>
    <div class="flex">
        @include('admin.admin-sidebar')
        <div class="flex-1 ml-64">
            @include('admin.admin-header')
            <main class="p-6 pt-20"> <!-- Added pt-20 (padding-top: 5rem or 80px) -->
                @yield('content')
            </main>
        </div>
    </div>
    @livewireScripts
</body>
</html>