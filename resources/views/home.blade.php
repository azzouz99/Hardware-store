@extends('layouts.app')

@section('content')
<!-- <img src="/storage/products/7iUnODxKcttpiFaYf4BLCmvLSg1rUXZZ0ilU2ZDZ.jpg" alt=""> -->
<!-- Section 1: Grid of All Categories -->
<section class="py-12 bg-gray-100">
  <div class="container mx-auto px-4">
    <!-- Header with Underline -->
    <div class="text-center mb-12">
      <h2 class="text-2xl font-bold text-gray-800">NOS CATÉGORIES</h2>
      <div class="mt-2 w-24 mx-auto border-b-4 border-[#d4af37]"></div>
    </div>

    <!-- Category Grid: 5 per row on large screens -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
      @foreach($categories as $cat)
        <a href="{{ route('category.index', ['category' => $cat->id]) }}" class="block transform transition duration-300 hover:scale-95">
          <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4 hover:shadow-xl transition-shadow duration-300 hover:border-[#d4af37]">
            <div class="flex justify-center pt-6">
              <img src="{{ asset($cat->icon) }}" alt="{{ $cat->name }}" class="w-16 h-16">
            </div>
            <div class="p-4 text-center">
              <h3 class="text-base font-semibold text-black truncate">{{ $cat->name }}</h3>
            </div>
          </div>
        </a>
      @endforeach
    </div>
  </div>
</section>

<!-- Section 2: Detailed View for Each Category -->
@foreach($categories as $category)
<div class="container mx-auto px-4 py-8" 
       x-data='{ "activeSubcategory": @json($category->subcategories->first()->id ?? null) }'>
    <!-- Category Header with Icon and "Voir tous" Link -->
    <div class="flex items-center justify-between bg-[#3f3f3f] p-4 mb-6">
      <!-- Category Icon and Name -->
      <div class="flex items-center">
        <div class="bg-white rounded-full flex items-center justify-center w-10 h-10 mr-2">
          <img src="{{ asset($category->icon) }}" alt="{{ $category->name }}" class="w-6 h-6">
        </div>
        <h2 class="text-xl font-bold text-white uppercase">
          {{ $category->name }}
        </h2>
      </div>
      <!-- "Voir tous" Link -->
      <a href="{{ route('category.index', $category->id) }}" class="text-white hover:text-[#d4af37] font-semibold">
        Voir tous
      </a>
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
        <div x-show="activeSubcategory === {{ $subcat->id }}" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($subcat->products as $product)
            <div class="bg-white border border-gray-300 rounded-lg shadow-md p-2 w-48 hover:shadow-lg transition-shadow relative">
                <!-- Icons: Wishlist & Add to Cart -->
                <div class="absolute top-2 right-2 flex space-x-2">
                    <!-- Wishlist (Love) Icon -->
                    <a href="#"
                    class="p-2 text-gray-500 hover:text-[#d4af37] transition"
                    title="Add to Wishlist">
                    <i class="fa fa-heart"></i>
                    </a>

                    <!-- Add to Cart Icon -->
                    <a href="#"
                    class="p-2 text-gray-500 hover:text-[#d4af37] transition"
                    title="Add to Cart">
                    <i class="fa fa-shopping-cart"></i>
                    </a>
                </div>

                <!-- Product Image -->
                <img src="{{ asset($product->images && $product->images->isNotEmpty() ? $product->images->first()->image_path : 'images/no-image.png') }}"
                    alt="{{ $product->name }}"
                    class="w-40 h-30 object-cover mb-3 rounded"
                    >


                <!-- Product Title -->
                <h3 class="mt-1 text-sm text-gray-500">
                    {{ $product->name }}
                </h3>

                <div class="flex justify-between items-center mt-1">
                <!-- Price Section -->
                @if($product->promotion)
                    <div>
                        <div class="text-red-400 line-through">{{ $product->original_price }} DT</div>
                        <div class="text-green-500 font-bold">{{ $product->discounted_price }} DT</div>
                    </div>
                @else
                    <div class="text-black-500 font-bold">{{ $product->price }} DT</div>
                @endif

                <!-- Availability Status -->
                <div class="text-sm text-right {{ $product->status == 'Disponible' ? 'text-green-600' : 'text-blue-600' }}">
                    {{ $product->status }}
                </div>
            </div>


            </div>

            @endforeach
        </div>
    @endforeach
  </div>
@endforeach

@endsection
