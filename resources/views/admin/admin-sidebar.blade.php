<aside id="sidebar" class="fixed top-0 left-0 h-screen w-64 bg-black text-white flex flex-col transition-all duration-300 ease-in-out sm:w-16 md:w-64 z-50">
    <!-- Logo -->
    <div class="flex items-center justify-between p-4">
        <div class="flex items-center space-x-2">
            <span class="text-2xl font-bold text-[#d4af37] md:block sm:hidden">Admin</span>
        </div>
        <button id="toggleSidebar" class="text-white md:hidden">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="flex-1">
        <ul class="space-y-2 p-4">
            <li>
                <a href="{{ route('admin.products.create') }}" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gradient-to-r hover:from-[#6a0a0a] hover:to-[#8B0000] text-white {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-[#6a0a0a] to-[#8B0000]' : '' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="md:block sm:hidden">Dashboard</span>
                </a>
            </li>
            <!-- Orders Menu Item -->
            <li>
                <a href="{{ route('admin.orders') }}" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gradient-to-r hover:from-[#6a0a0a] hover:to-[#8B0000] text-white {{ request()->routeIs('admin.orders') ? 'bg-gradient-to-r from-[#6a0a0a] to-[#8B0000]' : '' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span class="md:block sm:hidden">Les commandes</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.products.create') }}" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gradient-to-r hover:from-[#6a0a0a] hover:to-[#8B0000] text-white {{ request()->routeIs('admin.users') ? 'bg-gradient-to-r from-[#6a0a0a] to-[#8B0000]' : '' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <span class="md:block sm:hidden">Users</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.products.create') }}" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gradient-to-r hover:from-[#6a0a0a] hover:to-[#8B0000] text-white {{ request()->routeIs('admin.settings') ? 'bg-gradient-to-r from-[#6a0a0a] to-[#8B0000]' : '' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    </svg>
                    <span class="md:block sm:hidden">Settings</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.products.create') }}" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gradient-to-r hover:from-[#6a0a0a] hover:to-[#8B0000] text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span class="md:block sm:hidden">Logout</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Footer (Optional) -->
    <div class="p-4 border-t border-gray-700">
        <p class="text-sm text-[#d4af37] md:block sm:hidden">© 2025 Admin Panel</p>
    </div>
</aside>