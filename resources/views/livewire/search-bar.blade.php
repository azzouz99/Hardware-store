<div class="relative">
    <div class="relative">
        <input type="text" 
               wire:model.live.debounce.300ms="query" 
               placeholder="Recherche des produits..."
               @click.away="$wire.showDropdown = false"
               @focus="$wire.showDropdown = true"
               class="w-full border border-gray-200 rounded-full py-2.5 pl-12 pr-4 focus:outline-none focus:ring-2 focus:ring-[#d4af37] focus:border-transparent transition-shadow"
        >
        <button type="button" class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 hover:text-[#d4af37] transition-colors">
            <i class="fa fa-search"></i>
        </button>
        @if($query)
            <button wire:click="clearSearch" type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors">
                <i class="fa fa-times"></i>
            </button>
        @endif
    </div>

    <!-- Dropdown Results -->
    @if($showDropdown && count($results) > 0)
        <div class="absolute z-50 w-full mt-2 bg-white rounded-lg shadow-lg border border-gray-100 max-h-96 overflow-y-auto">
            @foreach($results as $product)
                <a href="{{ route('products.show', $product) }}" class="block hover:bg-gray-50">
                    <div class="flex items-center p-4 border-b border-gray-100 last:border-0">
                        <!-- Product Image -->
                        <div class="w-12 h-12 flex-shrink-0 rounded-lg overflow-hidden bg-gray-100">
                            <img src="{{ asset($product->images->first()?->image_path ?? 'images/no-image.png') }}" 
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover">
                        </div>
                        
                        <!-- Product Info -->
                        <div class="ml-4 flex-1">
                            <h4 class="text-sm font-medium text-gray-900 line-clamp-1">{{ $product->name }}</h4>
                            <div class="flex items-center mt-1">
                                @if($product->promotion)
                                    <span class="text-xs text-red-500 line-through mr-2">{{ $product->price }} DT</span>
                                    <span class="text-sm font-bold text-[#d4af37]">{{ $product->promotion_value }} DT</span>
                                @else
                                    <span class="text-sm font-bold text-gray-900">{{ $product->price }} DT</span>
                                @endif
                                
                                <span class="ml-2 text-xs px-2 py-0.5 rounded-full {{ $product->status == 'Disponible' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ $product->status }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Arrow Icon -->
                        <div class="ml-4 text-gray-400">
                            <i class="fa fa-chevron-right"></i>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @elseif($showDropdown && strlen($query) >= 2 && count($results) === 0)
        <div class="absolute z-50 w-full mt-2 bg-white rounded-lg shadow-lg border border-gray-100 p-4 text-center text-gray-500">
            Aucun produit trouvé pour "{{ $query }}"
        </div>
    @endif
</div>
