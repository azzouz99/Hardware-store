<div>
<!-- Hero Carousel Section -->
<div x-data="{
    activeSlide: 0,
    slides: [
        { image: '{{ asset('images/quincaillerie1.png') }}', title: 'Bienvenue chez Nouichi Store', subtitle: 'Votre partenaire en quincaillerie professionnelle' },
        { image: '{{ asset('images/quincaillerie2.PNG') }}', title: 'Qualité et Expertise', subtitle: 'Une large gamme d\'outils et matériaux' },
        { image: '{{ asset('images/quincaillerie3.png') }}', title: 'Service Professionnel', subtitle: 'Des conseils d\'experts à votre service' }
    ],
    init() {
        setInterval(() => {
            this.activeSlide = (this.activeSlide + 1) % 3;
        }, 5000);
    }
}" class="relative overflow-hidden mb-8 h-[400px] md:h-[500px]">
    <!-- Preload the first image -->
    <link rel="preload" as="image" href="{{ asset('images/quincaillerie1.png') }}" fetchpriority="high">
    
    <!-- Slides -->
    <template x-for="(slide, index) in slides" :key="index">
        <div x-show="activeSlide === index"
             x-transition:enter="transition duration-500 transform"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition duration-500 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             class="absolute inset-0">
            <div class="absolute inset-0 bg-black opacity-40"></div>
            <img :src="slide.image" 
                 :alt="slide.title" 
                 class="w-full h-full object-cover"
                 width="1920"
                 height="1080"
                 :loading="index === 0 ? 'eager' : 'lazy'"
                 :fetchpriority="index === 0 ? 'high' : 'low'"
                 decoding="async">
            <div class="absolute inset-0 flex flex-col justify-center items-center text-center text-white p-4">
                <h2 class="text-4xl md:text-5xl font-bold mb-4" x-text="slide.title"></h2>
                <p class="text-xl md:text-2xl" x-text="slide.subtitle"></p>
            </div>
        </div>
    </template>

    <!-- Navigation buttons -->
    <button @click="activeSlide = (activeSlide - 1 + 3) % 3" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black/50 text-white p-2 rounded-full hover:bg-black/70 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button @click="activeSlide = (activeSlide + 1) % 3" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black/50 text-white p-2 rounded-full hover:bg-black/70 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>

    <!-- Slide indicators -->
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
        <template x-for="(slide, index) in slides" :key="index">
            <button @click="activeSlide = index" 
                    :class="{'bg-white': activeSlide === index, 'bg-white/50': activeSlide !== index}"
                    class="w-3 h-3 rounded-full transition-colors duration-300">
            </button>
        </template>
    </div>
</div>

<!-- Section 1: Grid of All Categories -->
<section class="py-12">
  <div class="container mx-auto px-4">
    <!-- Header with Dark Gradient -->
    <div class="relative bg-gradient-to-r from-[#2d2d2d] to-[#3f3f3f] p-3 md:p-5 mb-8 rounded-lg md:rounded-xl shadow-lg md:shadow-2xl overflow-hidden">
      <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 25% 50%, white 0.5px, transparent 1px); background-size: 15px 15px;"></div>
      <div class="absolute right-0 top-0 h-full w-16 md:w-24 bg-gradient-to-l from-[#d4af37]/10 to-transparent"></div>
      
      <div class="relative z-10 flex items-center space-x-2 md:space-x-4">
        <div class="h-8 w-0.5 md:h-10 md:w-1 bg-[#d4af37] rounded-full"></div>
        <h2 class="text-xl md:text-2xl font-bold text-white uppercase tracking-tight md:tracking-wider">
          <span class="text-[#d4af37]">NOS</span> CATÉGORIES
        </h2>
      </div>
      
      <div class="absolute bottom-0 left-0 right-0 h-0.5 md:h-1 bg-gradient-to-r from-[#d4af37] via-[#d4af37]/50 to-transparent"></div>
    </div>

    <!-- Category Grid: 5 per row on large screens -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
      @foreach($categories as $cat)
        <a href="{{ route('category.index', ['category' => $cat->id]) }}" 
           class="group block transform transition duration-300 hover:-translate-y-1">
          <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl shadow-md p-6 relative overflow-hidden">
            <!-- Decorative elements -->
            <div class="absolute inset-0 bg-gradient-to-br from-[#d4af37]/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-[#d4af37] to-transparent transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
            
            <!-- Icon container -->
            <div class="relative flex justify-center items-center mb-4">
              <div class="w-16 h-16 rounded-full bg-white shadow-md flex items-center justify-center group-hover:shadow-lg transition-shadow duration-300">
                <img src="{{ asset($cat->icon) }}" 
                     alt="{{ $cat->name }}" 
                     class="w-8 h-8 object-contain"
                     loading="lazy"
                     width="32"
                     height="32">
              </div>
            </div>
            
            <!-- Category name -->
            <div class="text-center relative">
              <h3 class="text-base font-semibold text-gray-800 group-hover:text-[#d4af37] transition-colors duration-300">
                {{ $cat->name }}
              </h3>
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
      <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 25% 50%, white 0.5px, transparent 1px); background-size: 10px 10px;"></div>
      <div class="absolute right-0 top-0 h-full w-16 md:w-24 bg-gradient-to-l from-[#d4af37]/10 to-transparent"></div>
      
      <div class="relative z-10 flex items-center justify-between">
        <div class="flex items-center space-x-2 md:space-x-4">
          <div class="h-8 w-0.5 md:h-10 md:w-1 bg-[#d4af37] rounded-full"></div>
          <h2 class="text-xl md:text-2xl font-bold text-white uppercase tracking-tight md:tracking-wider">
            <span class="text-[#d4af37]">NOS</span> ARTICLES EN PROMO
          </h2>
        </div>
      </div>
      <div class="absolute bottom-0 left-0 right-0 h-0.5 md:h-1 bg-gradient-to-r from-[#d4af37] via-[#d4af37]/50 to-transparent"></div>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6 px-4 md:px-0">
      @foreach($promotedProducts as $product)
      <div class="product-card snap-start flex-shrink-0 w-40 sm:w-48 md:w-56">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 relative group overflow-hidden h-full flex flex-col">
                @if($product->promotion)
                <div class="absolute top-2 left-2 bg-red-600 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow">
                    PROMO
                </div>
                @endif

                <div class="absolute top-2 right-2 flex flex-col space-y-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200 z-10">
                    <button class="p-1.5 bg-white rounded-full shadow text-gray-600 hover:text-[#d4af37] hover:bg-gray-50 transition-colors">
                        <i class="fa fa-heart text-xs"></i>
                    </button>
                    <button 
                        wire:click="addToCart({{ $product->id }})"
                        class="p-1.5 bg-white rounded-full shadow text-gray-600 hover:text-[#d4af37] hover:bg-gray-50 transition-colors">
                        <i class="fa fa-shopping-cart text-xs"></i>
                    </button>
                </div>

                <div class="w-full aspect-square overflow-hidden bg-gray-100">
                    <a href="{{ route('products.show', $product) }}" class="block">
                        <img src="{{ asset($product->images->first()->image_path ?? 'images/no-image.png') }}" 
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                            width="400"
                            height="400"
                            loading="lazy"
                            decoding="async">
                    </a>
                </div>

                <div class="p-2 flex flex-col flex-grow">
                    <a href="{{ route('products.show', $product) }}" class="block">
                        <h3 class="text-sm font-medium text-gray-800 mb-1 line-clamp-2 flex-grow hover:text-[#d4af37] transition-colors">
                            {{ $product->name }}
                        </h3>
                    </a>

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
      @endforeach
  </div>
</div>

<!-- Section 2: Detailed View for Each Category -->
@foreach($categories as $category)
<div class="container mx-auto px-4 py-8" 
     x-data='{ "activeSubcategory": @json($category->subcategories->first()->id ?? null) }'>
    <div class="relative bg-gradient-to-r from-[#2d2d2d] to-[#3f3f3f] p-3 md:p-5 mb-6 md:mb-8 rounded-lg md:rounded-xl shadow-lg md:shadow-2xl overflow-hidden">
      <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 25% 50%, white 0.5px, transparent 1px); background-size: 15px 15px;"></div>
      <div class="absolute right-0 top-0 h-full w-16 md:w-24 bg-gradient-to-l from-[#d4af37]/10 to-transparent"></div>
      
      <div class="relative z-10 flex items-center justify-between">
        <div class="flex items-center space-x-2 md:space-x-4">
          <div class="bg-white rounded-full flex items-center justify-center w-8 h-8 md:w-10 md:h-10 mr-1 md:mr-2">
            <img src="{{ asset($category->icon) }}" alt="{{ $category->name }}" class="w-4 h-4 md:w-6 md:h-6">
          </div>
          <h2 class="text-lg md:text-2xl font-bold text-white uppercase tracking-tight md:tracking-wider">
            <span class="text-[#d4af37]">{{ strtok($category->name, ' ') }}</span> 
            {{ substr(strstr($category->name, ' '), 1) }}
          </h2>
        </div>
        
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
      
      <div class="absolute bottom-0 left-0 right-0 h-0.5 md:h-1 bg-gradient-to-r from-[#d4af37] via-[#d4af37]/50 to-transparent"></div>
    </div>

    <div class="relative mb-6 sm:mb-8 px-2 sm:px-4">
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
      
      <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-[#d4af37] via-[#d4af37]/50 to-transparent"></div>
    </div>
    
    @foreach($category->subcategories as $subcat)
    <div 
    x-show="activeSubcategory === {{ $subcat->id }}" 
    x-data="{
        startIndex: 1,
        visibleCount: 0,
        total: {{ $subcat->products->count() }},
        cardWidth: 200,
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
            this.cardWidth = cards[0]?.getBoundingClientRect().width + 16 || 200;
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

    <div 
        x-ref="scrollContainer"
        class="flex overflow-x-auto gap-3 px-3 py-2 scrollbar-hide scroll-smooth snap-x snap-mandatory"
        @scroll.debounce.100ms="updateScroll"
    >
        @foreach($subcat->products as $product)
        <div class="product-card snap-start flex-shrink-0 w-40 sm:w-48 md:w-56">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 relative group overflow-hidden h-full flex flex-col">
                @if($product->promotion)
                <div class="absolute top-2 left-2 bg-red-600 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow">
                    PROMO
                </div>
                @endif

                <div class="absolute top-2 right-2 flex flex-col space-y-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200 z-10">
                    <button class="p-1.5 bg-white rounded-full shadow text-gray-600 hover:text-[#d4af37] hover:bg-gray-50 transition-colors">
                        <i class="fa fa-heart text-xs"></i>
                    </button>
                    <button 
                        wire:click="addToCart({{ $product->id }})"
                        class="p-1.5 bg-white rounded-full shadow text-gray-600 hover:text-[#d4af37] hover:bg-gray-50 transition-colors">
                        <i class="fa fa-shopping-cart text-xs"></i>
                    </button>
                </div>

                <div class="w-full aspect-square overflow-hidden bg-gray-100">
                    <a href="{{ route('products.show', $product) }}" class="block">
                        <img src="{{ asset($product->images->first()->image_path ?? 'images/no-image.png') }}" 
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                            width="400"
                            height="400"
                            loading="lazy"
                            decoding="async">
                    </a>
                </div>

                <div class="p-2 flex flex-col flex-grow">
                    <a href="{{ route('products.show', $product) }}" class="block">
                        <h3 class="text-sm font-medium text-gray-800 mb-1 line-clamp-2 flex-grow hover:text-[#d4af37] transition-colors">
                            {{ $product->name }}
                        </h3>
                    </a>

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
        @endforeach
    </div>

    <div class="text-center text-xs text-gray-500 mt-1" x-show="total > 0">
        <span x-text="`${startIndex}-${visibleCount} of ${total}`"></span>
    </div>
</div>
    @endforeach
</div>
@endforeach
</div>
