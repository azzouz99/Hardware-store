<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nouichi Store</title>
    @livewireStyles
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
   
    @vite(['resources/css/app.css']) <!-- CSS only here -->
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 text-gray-900">

    {{-- 🔼 Header --}}
    <header class="sticky top-0 z-50 bg-white shadow">
        <x-header />
    </header>

    {{-- 📦 Page Content --}}
    <main class="container mx-auto p-6">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    {{-- 🔽 Footer --}}
    <footer>
        <x-footer />
    </footer>

    @livewireScripts
    @vite(['resources/js/app.js']) 

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('swal', (data) => {
                console.log('SweetAlert event received:', data);
                
                const options = {
                    icon: data[0].icon || 'success',
                    title: data[0].title || '',
                    text: data[0].text || '',
                    timer: data[0].timer || undefined,
                    showConfirmButton: data[0].showConfirmButton !== false,
                    position: data[0].position || 'center',
                };

                Swal.fire(options).then((result) => {
                    console.log('SweetAlert shown successfully');
                    if (data[0].callback === 'redirect' && data[0].redirectUrl) {
                        window.location.href = data[0].redirectUrl;
                    }
                });
            });
        });
    </script>
</body>
</html>
