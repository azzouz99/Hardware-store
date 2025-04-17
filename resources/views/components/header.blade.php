<div x-data='{"menuOpen": false, "cartOpen": false, "categories": @json($categories ?? [])}' @click.outside="cartOpen = false">
  <!-- Main Header -->
  <header class="bg-white shadow px-4 py-4 flex justify-between items-center">
    <!-- Left: Burger Icon and Logo -->
    <div class="flex items-center space-x-4">
      <!-- Burger Icon triggers sidebar on click -->
      <button @click="menuOpen = !menuOpen" class="text-gray-600 focus:outline-none">
        <i class="fa fa-bars fa-lg"></i>
      </button>
      <!-- Logo -->
      <a href="/">
        <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="h-8">
      </a>
    </div>
    <!-- Center: Search Bar -->
    <div class="flex-1 mx-4">
      <form action="/search" method="GET">
        <div class="relative">
          <input type="text" name="query" placeholder="Recherche des produits..."
                 class="w-full border rounded-full py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-[#d4af37]">
          <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
            <i class="fa fa-search"></i>
          </span>
        </div>
      </form>
    </div>
    <!-- Right: Icons -->
    <div class="flex items-center space-x-4">
      <a href="/account" class="text-gray-600 hover:text-[#d4af37]">
        <i class="fa fa-user fa-lg"></i>
      </a>
      <a href="/wishlist" class="text-gray-600 hover:text-[#d4af37]">
        <i class="fa fa-heart fa-lg"></i>
      </a>
      <div class="relative">
        <button @click="cartOpen = !cartOpen" class="text-gray-600 hover:text-[#d4af37] focus:outline-none">
          <livewire:cart-counter />
        </button>
        <div x-show="cartOpen" x-cloak x-transition>
          <livewire:cart-dropdown />
        </div>
      </div>
    </div>
  </header>

  <!-- Vertical Sidebar Menu (opens when burger icon is clicked) -->
  <div x-show="menuOpen" x-cloak class="fixed inset-0 z-50 flex">
    <!-- Overlay to close menu -->
    <div class="absolute inset-0 bg-black opacity-50" @click="menuOpen = false"></div>
    <!-- Sidebar Container -->
    <div class="relative z-10 w-64 bg-white shadow-lg overflow-y-auto">
      <!-- Dynamic Nested Menu -->
      <ul class="divide-y divide-gray-200">
        <template x-for="(cat, catIndex) in categories" :key="catIndex">
          <li>
            <!-- Category Button with Icon -->
            <button @click="cat.open = !cat.open" class="w-full text-left p-4 flex justify-between items-center">
              <div class="flex items-center space-x-2">
                <!-- Category Icon -->
                <img :src="cat.icon" alt="Category Icon" class="w-8 h-8">
                <!-- Category Name -->
                <span x-text="cat.name"></span>
              </div>
              <span x-text="cat.open ? '-' : '+'"></span>
            </button>
            <!-- Subcategories List -->
            <ul x-show="cat.open" class="pl-4" x-collapse>
              <template x-for="(sub, subIndex) in cat.subcategories" :key="subIndex">
                <li>
                  <button @click="sub.open = !sub.open" class="w-full text-left p-2 flex justify-between items-center">
                    <span class="text-[#d4af37] font-bold" x-text="sub.name"></span>
                    <span class="text-[#d4af37] font-bold" x-text="sub.open ? '-' : '+'"></span>
                  </button>
                  <!-- Sub‑Subcategories List -->
                  <ul x-show="sub.open" class="pl-4" x-collapse>
                    <template x-for="(subsub, subsubIndex) in sub.subsubcategories" :key="subsubIndex">
                      <li class="p-2">
                        <a href="#" class="block hover:text-[#d4af37]" x-text="subsub.name"></a>
                      </li>
                    </template>
                  </ul>
                </li>
              </template>
            </ul>
          </li>
        </template>
      </ul>
    </div>
  </div>
</div>