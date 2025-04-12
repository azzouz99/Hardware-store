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
      <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow relative group">
        <!-- Wishlist & Cart Icons -->
        <div class="absolute top-3 right-3 flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
          <button class="p-1.5 bg-white rounded-full shadow text-gray-500 hover:text-[#d4af37] hover:bg-gray-50">
            <i class="fa fa-heart text-sm"></i>
          </button>
          <button class="p-1.5 bg-white rounded-full shadow text-gray-500 hover:text-[#d4af37] hover:bg-gray-50">
            <i class="fa fa-shopping-cart text-sm"></i>
          </button>
        </div>
        
        <!-- Product Image -->
        <div class="w-full h-48 overflow-hidden mb-3 rounded-lg bg-gray-100">
        <img src="{{ asset($product->images->first()->image_path ?? 'images/no-image.png') }}"
         alt="{{ $product->name }}"
         class="w-full h-full object-cover">
      </div>
              
        <!-- Product Info -->
        <div class="pt-1">
          <h3 class="text-gray-800 line-clamp-2 mb-1">{{ $product->name }}</h3>
          
          <!-- Price -->
          <div class="flex items-center justify-between mt-2">
            @if($product->promotion)
            <div class="flex flex-col">
            <span class="text-sm text-red-500 line-through">{{ $product->price }} DT</span>
              <span class="text-black-600 ">{{ $product->price }} DT</span>
              
          </div>
            @else
              <span class="text-black-600 ">{{ $product->price }} DT</span>
            @endif
            
            <span class="text-xs px-2 py-1 rounded-full {{ $product->status == 'Disponible' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
              {{ $product->status }}
            </span>
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