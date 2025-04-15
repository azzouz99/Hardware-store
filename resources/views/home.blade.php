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

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6 px-4 md:px-0">
      @foreach($promotedProducts as $product)
      <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 relative group overflow-hidden">
          <!-- PROMO Badge -->
          @if($product->promotion)
          <div class="absolute top-3 left-3 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-full shadow-md z-10">
              PROMO
          </div>
          @endif

          <!-- Action Buttons -->
          <div class="absolute top-3 right-3 flex flex-col space-y-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 z-10">
              <button class="p-2 bg-white rounded-full shadow-md text-gray-600 hover:text-[#d4af37] hover:bg-gray-50 transition-colors">
                  <i class="fa fa-heart"></i>
              </button>
              <button class="p-2 bg-white rounded-full shadow-md text-gray-600 hover:text-[#d4af37] hover:bg-gray-50 transition-colors">
                  <i class="fa fa-shopping-cart"></i>
              </button>
          </div>

          <!-- Product Image -->
          <div class="w-full aspect-square overflow-hidden bg-gray-100">
              <img src="{{ asset($product->images->first()->image_path ?? 'images/no-image.png') }}" 
                  alt="{{ $product->name }}"
                  class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
          </div>

          <!-- Product Info -->
          <div class="p-3">
              <h3 class="text-sm font-medium text-gray-800 mb-1 line-clamp-2">
                  {{ $product->name }}
              </h3>

              <!-- Price -->
              <div class="flex items-center justify-between mt-2">
                  @if($product->promotion)
                      <div class="flex flex-col">
                      <span class="text-sm text-red-500 line-through">{{ $product->price }} DT</span>
                      <span class="text-lg font-bold text-black">{{ $product->price }} DT</span>
                      </div>
                  @else
                      <span class="text-lg font-bold text-[#d4af37]">{{ $product->price }} DT</span>
                  @endif

                  <span class="text-xs px-2 py-1 rounded-full {{ $product->status == 'Disponible' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                      {{ $product->status }}
                  </span>
              </div>
          </div>
      </div>
      @endforeach
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
    <div 
    x-show="activeSubcategory === {{ $subcat->id }}" 
    x-data="{
        startIndex: 1,
        visibleCount: 0,
        total: {{ $subcat->products->count() }},
        cardWidth: 200, // Smaller base card width
        updateScroll() {
            const container = this.$refs.scrollContainer;
            const cards = container.querySelectorAll('.product-card');
            const containerRect = container.getBoundingClientRect();
            let firstVisible = null;
            let lastVisible = null;

            cards.forEach((card, index) => {
                const cardRect = card.getBoundingClientRect();
                if (cardRect.right > containerRect.left && cardRect.left < containerRect.right) {
                    if (firstVisible === null) firstVisible = index + 1;
                    lastVisible = index + 1;
                }
            });

            this.startIndex = firstVisible || 1;
            this.visibleCount = lastVisible || 0;
            this.cardWidth = cards[0]?.getBoundingClientRect().width + 16 || 200; // card width + gap
        },
        scrollLeft() {
            this.$refs.scrollContainer.scrollBy({ left: -this.cardWidth, behavior: 'smooth' });
        },
        scrollRight() {
            this.$refs.scrollContainer.scrollBy({ left: this.cardWidth, behavior: 'smooth' });
        }
    }"
    x-init="updateScroll()"
    @resize.window.debounce.100="updateScroll()"
    class="relative"
>
    <!-- Navigation Arrows -->
    <button 
        @click="scrollLeft()" 
        x-show="startIndex > 1"
        class="absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white p-2 rounded-full shadow hover:bg-gray-100 transition-all"
    >
        <i class="fa fa-chevron-left text-gray-600 text-sm"></i>
    </button>

    <button 
        @click="scrollRight()" 
        x-show="visibleCount < total"
        class="absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white p-2 rounded-full shadow hover:bg-gray-100 transition-all"
    >
        <i class="fa fa-chevron-right text-gray-600 text-sm"></i>
    </button>

    <!-- Scrollable Container -->
    <div 
        x-ref="scrollContainer"
        class="flex overflow-x-auto gap-3 px-3 py-2 scrollbar-hide scroll-smooth snap-x snap-mandatory"
        @scroll.debounce.100ms="updateScroll"
    >
        @foreach($subcat->products as $product)
        <div class="product-card snap-start flex-shrink-0 w-40 sm:w-48 md:w-56"> <!-- Smaller responsive widths -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 relative group overflow-hidden h-full">
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
                <div class="p-2">
                    <h3 class="text-xs font-medium text-gray-800 mb-1 line-clamp-2">
                        {{ $product->name }}
                    </h3>

                    <!-- Price -->
                    <div class="flex items-center justify-between mt-1">
                        @if($product->promotion)
                            <div class="flex flex-col">
                               
                                <span class="text-[10px] text-red-500 line-through">{{ $product->price }} DT</span>
                                <span class="text-sm font-bold text-black">{{ $product->price }} DT</span>
                            </div>
                        @else
                            <span class="text-sm font-bold text-black">{{ $product->price }} DT</span>
                        @endif

                        <span class="text-[10px] px-1.5 py-0.5 rounded-full {{ $product->status == 'Disponible' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ $product->status }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Product Range Indicator -->
    <div class="text-center text-xs text-gray-500 mt-1" x-show="total > 0">
        <span x-text="`${startIndex}-${visibleCount} of ${total}`"></span>
    </div>
</div>
    @endforeach
  </div>
@endforeach

@endsection
