<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumbs -->
    <nav class="mb-8">
        <ol class="flex items-center space-x-2 text-sm">
            <li><a href="{{ route('home') }}" class="text-gray-500 hover:text-[#d4af37] transition">Accueil</a></li>
            <li><span class="text-gray-500">/</span></li>
            <li><a href="{{ route('category.index', $product->subsubCategory->subcategory->category) }}" class="text-gray-500 hover:text-[#d4af37] transition">{{ $product->subsubCategory->subcategory->category->name }}</a></li>
            <li><span class="text-gray-500">/</span></li>
            <li class="text-gray-900 font-medium">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Left: Product Images -->
        <div class="space-y-4">
            <div class="aspect-square w-full bg-white rounded-xl overflow-hidden border border-gray-200">
                <img 
                    src="{{ asset($product->images->first()?->image_path ?? 'images/no-image.png') }}" 
                    alt="{{ $product->name }}"
                    class="w-full h-full object-contain"
                    id="mainImage"
                >
            </div>
            @if($product->images->count() > 1)
            <div class="grid grid-cols-4 gap-4">
                @foreach($product->images as $image)
                <button 
                    onclick="document.getElementById('mainImage').src = '{{ asset($image->image_path) }}'"
                    class="aspect-square rounded-lg overflow-hidden border border-gray-200 hover:border-[#d4af37] transition-colors">
                    <img 
                        src="{{ asset($image->image_path) }}" 
                        alt="{{ $product->name }}"
                        class="w-full h-full object-contain"
                    >
                </button>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Right: Product Info -->
        <div class="space-y-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h1>
                <p class="text-sm text-gray-500 mt-1">Référence: {{ $product->reference }}</p>
            </div>

            <!-- Price -->
            <div class="space-y-2">
                @if($product->promotion)
                    <div class="flex items-center space-x-2">
                        <span class="text-lg text-red-500 line-through">{{ number_format($product->price, 2) }} DT</span>
                        <span class="text-2xl font-bold text-gray-900">{{ number_format($product->promotion_value, 2) }} DT</span>
                    </div>
                    <div class="inline-block bg-red-100 text-red-800 text-xs font-medium px-2 py-0.5 rounded">
                        Promotion
                    </div>
                @else
                    <span class="text-2xl font-bold text-gray-900">{{ number_format($product->price, 2) }} DT</span>
                @endif
            </div>

            <!-- Status and Quantity -->
            <div class="flex items-center space-x-4">
                <span class="px-3 py-1 rounded-full text-sm {{ $product->status == 'Disponible' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                    {{ $product->status }}
                </span>
                @if($product->status == 'Disponible')
                    <span class="text-sm text-gray-500">
                        {{ $product->quantity }} {{ $product->unite }} en stock
                    </span>
                @endif
            </div>

            <!-- Add to Cart Button -->
            <div>
                <button 
                    wire:click="addToCart"
                    class="w-full bg-[#d4af37] text-white px-6 py-3 rounded-lg hover:bg-[#b8972e] transition-colors flex items-center justify-center space-x-2"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span>Ajouter au panier</span>
                </button>
            </div>

            <!-- Description -->
            @if($product->description)
            <div class="border-t border-gray-200 pt-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Description</h2>
                <div class="prose prose-sm text-gray-500">
                    {{ $product->description }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>