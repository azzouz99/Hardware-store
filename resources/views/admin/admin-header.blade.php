<header class="bg-white shadow p-4 flex justify-between items-center">
    <!-- Title -->
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Admin Dashboard</h1>
    </div>

    <!-- Right Side: Search and Profile -->
    <div class="flex items-center space-x-4">
        <!-- Search Form -->
        <div class="relative">
            <form action="#" method="GET">
                <input type="text" placeholder="Search..." class="border border-gray-300 rounded-full py-1 pl-10 pr-4 focus:outline-none">
                <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                    <i class="fa fa-search"></i>
                </div>
            </form>
        </div>

        <!-- Profile Dropdown -->
        <div class="relative">
            <button class="flex items-center focus:outline-none">
                <img src="{{ asset('images/admin-avatar.png') }}" alt="Admin Avatar" class="w-8 h-8 rounded-full">
                <span class="ml-2 text-gray-700">Admin Name</span>
                <i class="fa fa-chevron-down ml-1 text-gray-500"></i>
            </button>
            <!-- Optional Dropdown Menu (toggle with Alpine.js or JS if needed) -->
            <div class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg hidden">
                <a href="#" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100">Settings</a>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100">Logout</a>
            </div>
        </div>
    </div>
</header>
