<div x-data='{"menuOpen": false, "cartOpen": false, "accountOpen": false, "categories": @json($categories ?? [])}' @click.outside="cartOpen = false; accountOpen = false">
    <!-- Top Bar -->
    <div class="bg-[#2d2d2d] text-white px-4 py-2 text-sm hidden md:block">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <span>Bienvenue dans notre boutique Nouichi :</span>
                <span><i class="fa fa-phone mr-2"></i>+216 58 092 904</span>
                <span><i class="fa fa-envelope mr-2"></i>Nouichi650@gmail.com</span>
            </div>
            <!-- <div class="flex items-center space-x-4">
                <a href="/shipping" class="hover:text-[#d4af37] transition-colors">Shipping</a>
                <a href="/contact" class="hover:text-[#d4af37] transition-colors">Contact</a>
            </div> -->
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
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10">
                    </a>
                </div>

                <!-- Center: Search Bar -->
                <div class="flex-1 max-w-2xl hidden md:block">
                    <livewire:search-bar />
                </div>

                <!-- Right: Icons -->
                <div class="flex items-center space-x-3 md:space-x-6">
                    <!-- Account Dropdown -->
                    <div class="relative group p-2">
                        <button @click="accountOpen = !accountOpen" class="text-gray-600 hover:text-[#d4af37] transition-colors focus:outline-none">
                            <i class="fa fa-user fa-lg"></i>
                            <span class="hidden md:block absolute -bottom-4 left-1/2 transform -translate-x-1/2 text-xs font-medium opacity-0 group-hover:opacity-100 transition-opacity">Compte</span>
                        </button>
                        <!-- Account Dropdown Menu -->
                        <div x-show="accountOpen" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-50">
                            <div class="py-2">
                                @auth
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-black hover:text-[#d4af37] transition-colors">
                                        <i class="fa fa-user-circle mr-2"></i>Mon Compte
                                    </a>
                                    <a href="{{ route('profile.orders') }}" class="block px-4 py-2 text-sm text-black hover:text-[#d4af37] transition-colors">
                                        <i class="fa fa-shopping-bag mr-2"></i>Mes Commandes
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-100 mt-2">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-black hover:text-[red] transition-colors">
                                            <i class="fa fa-sign-out-alt mr-2"></i>Se déconnecter
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-black hover:text-[#d4af37] transition-colors">
                                        <i class="fa fa-sign-in-alt mr-2"></i>Se Connecter
                                    </a>
                                    <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-black hover:text-[#d4af37] transition-colors">
                                        <i class="fa fa-user-plus mr-2"></i>Créer un compte
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                    
                    <a href="/wishlist" class="text-gray-600 hover:text-[#d4af37] transition-colors group relative p-2">
                        <i class="fa fa-heart fa-lg"></i>
                        <span class="hidden md:block absolute -bottom-4 left-1/2 transform -translate-x-1/2 text-xs font-medium opacity-0 group-hover:opacity-100 transition-opacity">Favoris</span>
                    </a>
                    <!-- Cart Dropdown -->
                    <div class="relative group p-2">
                        <button @click="cartOpen = !cartOpen" class="text-gray-600 hover:text-[#d4af37] transition-colors focus:outline-none">
                            <livewire:cart-counter />
                        </button>
                        <span class="hidden md:block absolute -bottom-4 left-1/2 transform -translate-x-1/2 text-xs font-medium opacity-0 group-hover:opacity-100 transition-opacity">Panier</span>
                        <div x-show="cartOpen" x-cloak x-transition>
                            <livewire:cart-dropdown />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Search (visible on mobile only) -->
            <div class="mt-4 md:hidden">
                <livewire:search-bar />
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