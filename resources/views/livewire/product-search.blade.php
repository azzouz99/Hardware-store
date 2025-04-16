<div class="bg-white shadow-sm rounded-lg p-4 mb-6">
  <!-- Search and Filter Bar -->
  <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <!-- Left Controls - Sort and Items Per Page -->
    <div class="flex flex-col sm:flex-row gap-3 sm:items-center">
      <!-- Sort Dropdown -->
      <div class="relative">
        <label class="sr-only">Trier par</label>
        <div class="flex items-center">
          <span class="text-sm font-medium text-gray-600 mr-2">Trier par:</span>
          <select wire:model.live="sort" 
                  class="appearance-none bg-white border border-gray-200 rounded-lg pl-3 pr-8 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#d4af37] focus:border-[#d4af37] transition-all">
            <option value="pertinence">Pertinence</option>
            <option value="prix-asc">Prix croissant</option>
            <option value="prix-desc">Prix décroissant</option>
          </select>
          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
            
          </div>
        </div>
      </div>
      
      <!-- Items Per Page Dropdown -->
      <div class="relative">
        <label class="sr-only">Afficher</label>
        <div class="flex items-center">
          <span class="text-sm font-medium text-gray-600 mx-2">Afficher:</span>
          <select wire:model.live="perPage" 
                  class="appearance-none bg-white border border-gray-200 rounded-lg pl-3 pr-8 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#d4af37] focus:border-[#d4af37] transition-all">
            <option value="8">8</option>
            <option value="12">12</option>
            <option value="27">27</option>
            <option value="48">48</option>
          </select>
          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
            
          </div>
        </div>
      </div>
    </div>
    
    <!-- Search Input -->
    <div class="relative flex-1 max-w-md">
      <label for="search" class="sr-only">Rechercher</label>
      <div class="relative">
        <input
            id="search"
            type="search"
            wire:model.live.debounce.500ms="search"
            placeholder="Rechercher produits..."
            class="w-full bg-white border border-gray-200 rounded-lg pl-10 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#d4af37] focus:border-[#d4af37] transition-all"
        >
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          <i class="fa fa-search text-gray-400"></i>
        </div>
        @if($search)
        <button wire:click="$set('search', '')" 
                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors">
          <i class="fa fa-times"></i>
        </button>
        @endif
      </div>
    </div>
  </div>
  
  <!-- Loading Indicator -->
  <div wire:loading class="py-8 flex justify-center">
    <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-[#d4af37]"></div>
  </div>

  <!-- Product Cards Grid -->
  <div wire:loading.remove class="mt-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    @forelse($products as $product)
    <div class="product-card snap-start flex-shrink-0 w-40 sm:w-48 md:w-56"> <!-- Smaller responsive widths -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 relative group overflow-hidden h-full flex flex-col">
                <!-- PROMO Badge (smaller) -->
                @if($product->promotion)
                <div class="absolute top-2 left-2 bg-red-600 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow">
                    PROMO
                </div>
                @endif

                <!-- Action Buttons (smaller) -->
                <div class="absolute top-2 right-2 flex flex-col space-y-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200 z-10">
                    <button class="p-1.5 bg-white rounded-full shadow text-gray-600 hover:text-[#d4af37] hover:bg-gray-50 transition-colors">
                        <i class="fa fa-heart text-xs"></i>
                    </button>
                    <button class="p-1.5 bg-white rounded-full shadow text-gray-600 hover:text-[#d4af37] hover:bg-gray-50 transition-colors">
                        <i class="fa fa-shopping-cart text-xs"></i>
                    </button>
                </div>

                <!-- Product Image -->
                <div class="w-full aspect-square overflow-hidden bg-gray-100">
                    <img src="{{ asset($product->images->first()->image_path ?? 'images/no-image.png') }}" 
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                </div>

                <!-- Product Info (adjusted for smaller size) -->
                <div class="p-2 flex flex-col flex-grow">
                    <h3 class="text-sm font-medium text-gray-800 mb-1 line-clamp-2 flex-grow">
                        {{ $product->name }}
                    </h3>

                    <!-- Price -->
                    <div class="flex items-center justify-between mt-2">
                        @if($product->promotion)
                            <div class="flex flex-col">
                               
                                <span class="text-[10px] text-red-500 line-through">{{ $product->price }} DT</span>
                                <span class="text-sm font-bold text-black">{{ $product->price }} DT</span>
                            </div>
                        @else
                            <span class="text-sm font-bold text-black">{{ $product->price }} DT</span>
                        @endif

                        <span class="text-xs px-2 py-1 rounded-full {{ $product->status == 'Disponible' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ $product->status }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @empty
      <div class="col-span-full py-12 text-center">
        <div class="text-gray-400 mb-2">
          <i class="fa fa-search fa-2x"></i>
        </div>
        <p class="text-gray-600 font-medium">Aucun produit trouvé</p>
        @if($search)
          <p class="text-sm text-gray-500 mt-1">pour "{{ $search }}"</p>
        @endif
      </div>
    @endforelse
  </div>

  <!-- Pagination -->
  @if($products->hasPages())
  <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
    <div class="text-sm text-gray-500">
      @if($products->total() > 0)
        Affichage de <span class="font-medium">{{ $products->firstItem() }}</span> à <span class="font-medium">{{ $products->lastItem() }}</span> sur <span class="font-medium">{{ $products->total() }}</span> résultats
      @endif
    </div>
    
    <div class="flex flex-wrap items-center justify-center gap-1">
      <!-- Previous Button -->
      <button wire:click="previousPage" 
              @disabled(!$products->onFirstPage())
              class="px-3 py-1 rounded border border-gray-200 text-sm {{ $products->onFirstPage() ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'hover:bg-gray-50 text-gray-600' }}">
        <i class="fa fa-chevron-left mr-1"></i> Précédent
      </button>
      
      <!-- Page Numbers -->
      @foreach($products->getUrlRange(max(1, $products->currentPage()-2), min($products->lastPage(), $products->currentPage()+2)) as $page => $url)
        @if($page == $products->currentPage())
          <span class="px-3 py-1 bg-[#d4af37] text-white rounded text-sm font-medium">{{ $page }}</span>
        @else
          <button wire:click="gotoPage({{ $page }})" 
                  class="px-3 py-1 rounded border border-gray-200 text-sm text-gray-600 hover:bg-gray-50">
            {{ $page }}
          </button>
        @endif
      @endforeach
      
      <!-- Next Button -->
      <button wire:click="nextPage" 
              @disabled(!$products->hasMorePages())
              class="px-3 py-1 rounded border border-gray-200 text-sm {{ !$products->hasMorePages() ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'hover:bg-gray-50 text-gray-600' }}">
        Suivant <i class="fa fa-chevron-right ml-1"></i>
      </button>
    </div>
  </div>
  @endif
</div>