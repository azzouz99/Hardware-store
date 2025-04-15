<header class="bg-white shadow-md fixed top-0 left-64 right-0 h-16 flex items-center justify-between px-6 z-40 sm:left-16 md:left-64">
    <!-- Search Bar -->
    <div class="flex items-center w-1/3">
        <div class="relative w-full">
    
        </div>
    </div>

    <!-- Right Side: Notifications & User Profile -->
    <div class="flex items-center space-x-4">
        <!-- Notification Bell -->
        <button class="relative text-gray-600 hover:text-[#d4af37] focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
            </svg>
            <span class="absolute top-0 right-0 h-2 w-2 bg-gradient-to-r from-[#6a0a0a] to-[#8B0000] rounded-full"></span>
        </button>

        <!-- User Profile Dropdown -->
        <div class="relative">
            <button id="userMenuButton" class="flex items-center space-x-2 focus:outline-none">
                <img class="h-8 w-8 rounded-full object-cover border-2 border-[#d4af37]" src="https://via.placeholder.com/40" alt="User Avatar">
                <span class="text-black font-medium md:block sm:hidden">{{ auth()->user()->name ?? 'Admin User' }}</span>
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <!-- Dropdown Menu -->
            <div id="userMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg hidden">
                <div class="py-2">
                    <a href="{{ route('products.create') }}" class="block px-4 py-2 text-sm text-black hover:bg-gradient-to-r hover:from-[#6a0a0a] hover:to-[#8B0000] hover:text-white">Profile</a>
                    <a href="{{ route('products.create') }}" class="block px-4 py-2 text-sm text-black hover:bg-gradient-to-r hover:from-[#6a0a0a] hover:to-[#8B0000] hover:text-white">Settings</a>
                    <form action="{{ route('products.create') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-black hover:bg-gradient-to-r hover:from-[#6a0a0a] hover:to-[#8B0000] hover:text-white">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- JavaScript for Dropdown -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const userMenuButton = document.getElementById('userMenuButton');
        const userMenu = document.getElementById('userMenu');

        userMenuButton.addEventListener('click', () => {
            userMenu.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!userMenuButton.contains(e.target) && !userMenu.contains(e.target)) {
                userMenu.classList.add('hidden');
            }
        });
    });
</script>