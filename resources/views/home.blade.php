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
<!-- Promotion section -->

<div class="container mx-auto px-4 py-8" >
    <!-- Category Header with Icon and "Voir tous" Link -->
    <div class="relative bg-gradient-to-r from-[#6a0a0a] to-[#8B0000] p-3 md:p-5 mb-6 md:mb-8 rounded-lg md:rounded-xl shadow-lg md:shadow-2xl overflow-hidden">
      <!-- Decorative elements -->
      <div class="absolute inset-0 opacity-20" style="
        background-image: radial-gradient(circle at 25% 50%, white 0.5px, transparent 1px);
        background-size: 10px 10px;
      "></div>
      
      <div class="absolute right-0 top-0 h-full w-16 md:w-24 bg-gradient-to-l from-[#d4af37]/10 to-transparent"></div>
      
      <!-- Main content -->
      <div class="relative z-10 flex items-center justify-between">
        <!-- Title with accent -->
        <div class="flex items-center space-x-2 md:space-x-4">
          <div class="h-8 w-0.5 md:h-10 md:w-1 bg-[#d4af37] rounded-full"></div>
          <h2 class="text-xl md:text-2xl font-bold text-white uppercase tracking-tight md:tracking-wider">
            <span class="text-[#d4af37]">NOS</span> ARTICLES EN PROMO
          </h2>
        </div>
        
        <!-- "Voir tous" button with gold accent -->
        <a href="{{ route('category.index', $category->id) }}" 
          class="flex items-center space-x-1 group transition-all duration-300">
          <span class="text-white group-hover:text-[#d4af37] font-medium text-base md:text-lg transition-colors">
            Voir tous
          </span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5 text-white group-hover:text-[#d4af37] group-hover:translate-x-1 transition-all" 
              fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
          </svg>
        </a>
      </div>
      
      <!-- Bottom accent -->
      <div class="absolute bottom-0 left-0 right-0 h-0.5 md:h-1 bg-gradient-to-r from-[#d4af37] via-[#d4af37]/50 to-transparent"></div>
    </div>

</div>

<!-- Section 2: Detailed View for Each Category -->
@foreach($categories as $category)
<div class="container mx-auto px-4 py-8" 
       x-data='{ "activeSubcategory": @json($category->subcategories->first()->id ?? null) }'>
    <!-- Category Header with Icon and "Voir tous" Link -->
    <div class="relative bg-gradient-to-r from-[#2d2d2d] to-[#3f3f3f] p-3 md:p-5 mb-6 md:mb-8 rounded-lg md:rounded-xl shadow-lg md:shadow-2xl overflow-hidden">
      <!-- Decorative elements -->
      <div class="absolute inset-0 opacity-20" style="
        background-image: radial-gradient(circle at 25% 50%, white 0.5px, transparent 1px);
        background-size: 15px 15px;
      "></div>
      
      <div class="absolute right-0 top-0 h-full w-16 md:w-24 bg-gradient-to-l from-[#d4af37]/10 to-transparent"></div>
      
      <!-- Main content -->
      <div class="relative z-10 flex items-center justify-between">
        <!-- Category icon and name with accent -->
        <div class="flex items-center space-x-2 md:space-x-4">
          <div class="bg-white rounded-full flex items-center justify-center w-8 h-8 md:w-10 md:h-10 mr-1 md:mr-2">
            <img src="{{ asset($category->icon) }}" alt="{{ $category->name }}" class="w-4 h-4 md:w-6 md:h-6">
          </div>
          <h2 class="text-lg md:text-2xl font-bold text-white uppercase tracking-tight md:tracking-wider">
            <span class="text-[#d4af37]">{{ strtok($category->name, ' ') }}</span> 
            {{ substr(strstr($category->name, ' '), 1) }}
          </h2>
        </div>
        
        <!-- "Voir tous" button with gold accent -->
        <a href="{{ route('category.index', $category->id) }}" 
          class="flex items-center space-x-1 group transition-all duration-300">
          <span class="text-white group-hover:text-[#d4af37] font-medium text-sm md:text-lg transition-colors">
            Voir tous
          </span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5 text-white group-hover:text-[#d4af37] group-hover:translate-x-1 transition-all" 
              fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
          </svg>
        </a>
      </div>
      
      <!-- Bottom accent -->
      <div class="absolute bottom-0 left-0 right-0 h-0.5 md:h-1 bg-gradient-to-r from-[#d4af37] via-[#d4af37]/50 to-transparent"></div>
    </div>


    <!-- Horizontal Subcategory Tabs -->
    <div class="relative mb-6 sm:mb-8 px-2 sm:px-4">
      <!-- Scrolling container with subtle gradient fade -->
      <div class="relative overflow-x-auto pb-2">
        <div class="flex space-x-1 md:space-x-2 w-max min-w-full">
          @foreach($category->subcategories as $subcat)
            <button
              @click="activeSubcategory = {{ $subcat->id }}"
              class="px-4 py-2.5 rounded-lg focus:outline-none transition-all duration-200 whitespace-nowrap text-sm"
              :class="{
                'bg-[#d4af37] text-white shadow-md': activeSubcategory === {{ $subcat->id }},
                'bg-white/10 text-black-200 hover:bg-white/20': activeSubcategory !== {{ $subcat->id }}
              }"
            >
              {{ $subcat->name }}
            </button>
          @endforeach
        </div>
      </div>
      
      <!-- Bottom accent line that matches category header -->
      <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-[#d4af37] via-[#d4af37]/50 to-transparent"></div>
    </div>


    <!-- Products for Each Subcategory -->
    @foreach($category->subcategories as $subcat)
        <div x-show="activeSubcategory === {{ $subcat->id }}" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($subcat->products as $product)
            <div class="bg-white border border-gray-300 rounded-lg shadow-md p-2 w-48 hover:shadow-lg transition-shadow relative">
            @if($product->promotion)
                <div class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                    PROMO
                </div>
            @endif
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
                        <div class="text-red-400 line-through">{{ $product->price }} DT</div>
                        <div class="text-black-500 font-bold">{{ $product->price }} DT</div>
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
