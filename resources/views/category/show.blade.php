@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8" x-data="{ activeSubcategory: {{ $category->subcategories->first()->id ?? 'null' }} }">

  <!-- Category Title with Underline -->
  <div class="text-center mb-8">
    <h2 class="text-3xl font-bold text-white bg-[#3f3f3f] p-4 uppercase">
      {{ $category->name }}
    </h2>
  </div>

  <!-- Horizontal Subcategory Tabs -->
  <div class="flex space-x-4 border-b border-gray-300 mb-6 overflow-x-auto">
    @foreach($category->subcategories as $subcat)
      <button
        @click="activeSubcategory = {{ $subcat->id }}"
        class="px-3 py-2 focus:outline-none text-gray-600 transition-colors"
        :class="activeSubcategory === {{ $subcat->id }} ? 'border-b-2 border-[#d4af37] text-[#d4af37]' : 'hover:text-[#d4af37]'"
      >
        {{ $subcat->name }}
      </button>
    @endforeach
  </div>

  <!-- Products for Each Subcategory -->
  @foreach($category->subcategories as $subcat)
      <div x-show="activeSubcategory === {{ $subcat->id }}" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
          @forelse($subcat->products as $product)
              <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow relative">
                  <!-- Icons (Wishlist & Cart) -->
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
                          <div class="text-blue-600 font-bold">
                              {{ $product->price }} DT
                          </div>
                      @endif
                      <div class="text-sm {{ $product->status == 'Disponible' ? 'text-green-600' : 'text-blue-600' }} text-right">
                          {{ $product->status }}
                      </div>
                  </div>
              </div>
          @empty
              <p>Aucun article trouvé dans cette sous-catégorie.</p>
          @endforelse
      </div>
  @endforeach

</div>
@endsection
