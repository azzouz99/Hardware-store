@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <!-- Category Header: Displays Category Name and Total Product Count -->
  <div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-800">
      {{ $category->name }}
      <span class="text-gray-600 text-sm ml-2">
        • {{ $totalProducts }} article(s) trouvé(s)
      </span>
    </h1>
  </div>

  <div class="flex gap-6">
    <!-- Left Sidebar -->
    <aside class="w-64 bg-white border border-gray-200 rounded-lg shadow-md p-4">
      <!-- Subcategory Filter -->
      <h2 class="text-lg font-bold mb-3">Sous-catégories</h2>
      <ul class="space-y-2">
        <li>
          <!-- "Tous" Link removes subcategory filtering -->
          <a href="{{ route('category.index', ['category' => $category->id]) }}"
             class="block text-gray-700 hover:text-[#d4af37] transition">
            Tous ({{ $totalProducts }})
          </a>
        </li>
        @foreach($subcategories as $subcat)
          <li>
            <a href="{{ route('category.index', ['category' => $category->id, 'subcategory' => $subcat->id]) }}"
               class="block text-gray-700 hover:text-[#d4af37] transition">
              {{ $subcat->name }} ({{ $subcat->products->count() }})
            </a>
          </li>
        @endforeach
      </ul>

      <!-- Price Range Filter -->
      <div class="mt-6">
        <h3 class="text-md font-bold mb-2">Prix</h3>
        <form action="{{ route('category.index', ['category' => $category->id]) }}" method="GET" id="priceFilterForm">
          <!-- Preserve current category and subcategory filters -->
          <input type="hidden" name="category" value="{{ $category->id }}">
          @if(request('subcategory'))
            <input type="hidden" name="subcategory" value="{{ request('subcategory') }}">
          @endif
          <div class="flex items-center justify-between">
            <span class="text-sm">{{ $minPrice }} DT</span>
            <span class="text-sm">{{ $maxPrice }} DT</span>
          </div>
          <input type="range" name="minPrice" min="{{ $minPrice }}" max="{{ $maxPrice }}" step="1" value="{{ request('minPrice', $minPrice) }}" class="w-full mt-2">
          <div class="flex justify-between mt-1 text-sm">
            <span>{{ $minPrice }} DT</span>
            <span>{{ request('minPrice', $minPrice) }} DT</span>
            <span>{{ $maxPrice }} DT</span>
          </div>
          <button type="submit" class="mt-2 w-full px-3 py-1 bg-[#d4af37] text-white rounded">Filtrer</button>
        </form>
      </div>
    </aside>

    <!-- Main Content (Right) -->
    <section class="flex-1">
      <!-- Top Bar: Sorting, Display Count, and Search -->
      <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 space-y-3 md:space-y-0">
        <div class="flex items-center space-x-2">
          <!-- Sorting Dropdown -->
          <label class="flex items-center">
            <span class="mr-1 text-gray-700">Trier par:</span>
            <select name="sort" form="filtersForm" class="border border-gray-300 rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-[#d4af37]">
              <option value="pertinence" {{ request('sort') == 'pertinence' ? 'selected' : '' }}>Pertinence</option>
              <option value="prix-asc" {{ request('sort') == 'prix-asc' ? 'selected' : '' }}>Prix croissant</option>
              <option value="prix-desc" {{ request('sort') == 'prix-desc' ? 'selected' : '' }}>Prix décroissant</option>
            </select>
          </label>
          <!-- Display Count Dropdown -->
          <label class="flex items-center">
            <span class="mx-2 text-gray-700">Afficher:</span>
            <select name="perPage" form="filtersForm" class="border border-gray-300 rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-[#d4af37]">
              <option value="12" {{ request('perPage') == 12 ? 'selected' : '' }}>12</option>
              <option value="27" {{ request('perPage', 27) == 27 ? 'selected' : '' }}>27</option>
              <option value="48" {{ request('perPage') == 48 ? 'selected' : '' }}>48</option>
            </select>
          </label>
        </div>

        <!-- Right Controls: Search Input -->
        <form action="{{ route('category.index', ['category' => $category->id]) }}" method="GET" id="filtersForm" class="flex items-center space-x-4">
          <!-- Preserve current filters as hidden inputs -->
          <input type="hidden" name="category" value="{{ $category->id }}">
          @if(request('subcategory'))
            <input type="hidden" name="subcategory" value="{{ request('subcategory') }}">
          @endif
          @if(request('minPrice'))
            <input type="hidden" name="minPrice" value="{{ request('minPrice') }}">
          @endif
          @if(request('maxPrice'))
            <input type="hidden" name="maxPrice" value="{{ request('maxPrice') }}">
          @endif
          <input type="search" name="search" placeholder="Rechercher" value="{{ request('search') }}"
                 class="border border-gray-300 rounded-lg pr-10 pl-3 py-1 focus:outline-none focus:ring-2 focus:ring-[#d4af37]">
          <button type="submit" class="px-3 py-1 bg-[#d4af37] text-white rounded">Rechercher</button>
        </form>
      </div>

      <!-- Product Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach($products as $product)
          <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow relative">
            <!-- Icons: Wishlist & Cart -->
            <div class="absolute top-2 right-2 flex space-x-2">
              <a href="#" class="p-1 text-gray-500 hover:text-[#d4af37]" title="Ajouter au Wishlist">
                <i class="fa fa-heart"></i>
              </a>
              <a href="#" class="p-1 text-gray-500 hover:text-[#d4af37]" title="Ajouter au Panier">
                <i class="fa fa-shopping-cart"></i>
              </a>
            </div>
            <!-- Product Image -->
            <div class="w-full h-40 overflow-hidden mb-3">
              <img src="{{ asset(optional($product->images->first())->image_path ?? 'images/no-image.png') }}"
                   alt="{{ $product->name }}"
                   class="w-full h-full object-cover rounded">
            </div>
            <!-- Product Title -->
            <h3 class="text-md font-bold text-gray-800 truncate">
              {{ $product->name }}
            </h3>
            <!-- Pricing & Availability -->
            <div class="flex justify-between items-center mt-2">
              @if($product->promotion)
                <div>
                  <div class="text-red-500 line-through">{{ $product->original_price }} DT</div>
                  <div class="text-green-600 font-bold">{{ $product->price }} DT</div>
                </div>
              @else
                <div class="text-blue-600 font-bold">{{ $product->price }} DT</div>
              @endif
              <div class="text-sm {{ $product->status == 'Disponible' ? 'text-green-600' : 'text-blue-600' }} text-right">
                {{ $product->status }}
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <!-- Pagination -->
      <div class="mt-8">
        {{ $products->appends(request()->query())->links() }}
      </div>
    </section>
  </div>
</div>
@endsection
