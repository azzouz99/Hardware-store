<div x-data='{"menuOpen": false, "cartOpen": false, "categories": @json($categories ?? [])}' @click.outside="cartOpen = false">
    <!-- Top Bar -->
    <div class="bg-[#2d2d2d] text-white px-4 py-2 text-sm hidden md:block">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <span><i class="fa fa-phone mr-2"></i>+216 XX XXX XXX</span>
                <span><i class="fa fa-envelope mr-2"></i>contact@nouichistore.com</span>
            </div>
            <div class="flex items-center space-x-4">
                <a href="/shipping" class="hover:text-[#d4af37] transition-colors">Shipping</a>
                <a href="/contact" class="hover:text-[#d4af37] transition-colors">Contact</a>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <div class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between gap-4">
                <!-- Left: Burger Icon and Logo -->
                <div class="flex items-center space-x-4 lg:space-x-6">
                    <button @click="menuOpen = !menuOpen" class="lg:hidden text-gray-600 hover:text-[#d4af37] transition-colors focus:outline-none">
                        <i class="fa fa-bars fa-lg"></i>
                    </button>
                    <a href="/" class="flex-shrink-0">
                        <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="h-10">
                    </a>
                </div>

                <!-- Center: Search Bar -->
                <div class="flex-1 max-w-2xl hidden md:block">
                    <form action="/search" method="GET" class="relative">
                        <input type="text" 
                               name="query" 
                               placeholder="Recherche des produits..."
                               class="w-full border border-gray-200 rounded-full py-2.5 pl-12 pr-4 focus:outline-none focus:ring-2 focus:ring-[#d4af37] focus:border-transparent transition-shadow"
                        >
                        <button type="submit" class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 hover:text-[#d4af37] transition-colors">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>

                <!-- Right: Icons -->
                <div class="flex items-center space-x-3 md:space-x-6">
                    <a href="/account" class="text-gray-600 hover:text-[#d4af37] transition-colors group relative p-2">
                        <i class="fa fa-user fa-lg"></i>
                        <span class="hidden md:block absolute -bottom-4 left-1/2 transform -translate-x-1/2 text-xs font-medium opacity-0 group-hover:opacity-100 transition-opacity">Account</span>
                    </a>
                    <a href="/wishlist" class="text-gray-600 hover:text-[#d4af37] transition-colors group relative p-2">
                        <i class="fa fa-heart fa-lg"></i>
                        <span class="hidden md:block absolute -bottom-4 left-1/2 transform -translate-x-1/2 text-xs font-medium opacity-0 group-hover:opacity-100 transition-opacity">Wishlist</span>
                    </a>
                    <div class="relative group p-2">
                        <button @click="cartOpen = !cartOpen" class="text-gray-600 hover:text-[#d4af37] transition-colors focus:outline-none">
                            <livewire:cart-counter />
                        </button>
                        <span class="hidden md:block absolute -bottom-4 left-1/2 transform -translate-x-1/2 text-xs font-medium opacity-0 group-hover:opacity-100 transition-opacity">Cart</span>
                        <div x-show="cartOpen" x-cloak x-transition>
                            <livewire:cart-dropdown />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Search (visible on mobile only) -->
            <div class="mt-4 md:hidden">
                <form action="/search" method="GET" class="relative">
                    <input type="text" 
                           name="query" 
                           placeholder="Recherche des produits..."
                           class="w-full border border-gray-200 rounded-full py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-[#d4af37] focus:border-transparent"
                    >
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                        <i class="fa fa-search"></i>
                    </span>
                </form>
            </div>
        </div>
    </div>

    <!-- Vertical Sidebar Menu (opens when burger icon is clicked) -->
    <div x-show="menuOpen" x-cloak class="fixed inset-0 z-50 flex">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/50 transition-opacity" @click="menuOpen = false"></div>
        
        <!-- Sidebar -->
        <div class="relative w-80 max-w-[80vw] bg-white shadow-xl overflow-y-auto transition-transform transform"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full">
            
            <!-- Close button -->
            <button @click="menuOpen = false" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                <i class="fa fa-times fa-lg"></i>
            </button>

            <!-- Categories Menu -->
            <nav class="p-4">
                <ul class="space-y-2">
                    <template x-for="(cat, catIndex) in categories" :key="catIndex">
                        <li class="border-b border-gray-100 last:border-none">
                            <button @click="cat.open = !cat.open" 
                                    class="w-full py-3 flex items-center justify-between text-left hover:text-[#d4af37] transition-colors">
                                <div class="flex items-center space-x-3">
                                    <img :src="cat.icon" :alt="cat.name" class="w-6 h-6">
                                    <span class="font-medium" x-text="cat.name"></span>
                                </div>
                                <i class="fa" :class="cat.open ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                            </button>
                            
                            <ul x-show="cat.open" 
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 -translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="pl-9 pb-3 space-y-2">
                                <template x-for="(sub, subIndex) in cat.subcategories" :key="subIndex">
                                    <li>
                                        <button @click="sub.open = !sub.open" 
                                                class="w-full py-2 flex items-center justify-between text-left text-gray-600 hover:text-[#d4af37] transition-colors">
                                            <span x-text="sub.name"></span>
                                            <i class="fa" :class="sub.open ? 'fa-minus' : 'fa-plus'"></i>
                                        </button>
                                        
                                        <ul x-show="sub.open" 
                                            x-transition:enter="transition ease-out duration-200"
                                            x-transition:enter-start="opacity-0 -translate-y-2"
                                            x-transition:enter-end="opacity-100 translate-y-0"
                                            class="pl-4 py-2 space-y-2">
                                            <template x-for="(subsub, subsubIndex) in sub.subsubcategories" :key="subsubIndex">
                                                <li>
                                                    <a :href="'/category/' + subsub.id" 
                                                       class="block py-1.5 text-sm text-gray-500 hover:text-[#d4af37] transition-colors"
                                                       x-text="subsub.name"></a>
                                                </li>
                                            </template>
                                        </ul>
                                    </li>
                                </template>
                            </ul>
                        </li>
                    </template>
                </ul>
            </nav>
        </div>
    </div>
</div>