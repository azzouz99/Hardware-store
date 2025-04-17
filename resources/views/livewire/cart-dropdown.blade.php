<div x-data="{ open: false }" class="absolute right-0 mt-2 w-full sm:w-96 bg-white border border-gray-200 rounded-xl shadow-2xl z-50 overflow-hidden transition-all duration-200" wire:poll>
    <!-- Cart Header -->
    <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
        <h3 class="text-lg font-bold text-gray-800 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#d4af37]" viewBox="0 0 20 20" fill="currentColor">
                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
            </svg>
            Shopping Cart ({{ count($this->getCartItems()) }})
        </h3>
    </div>

    @if($this->getCartItems() && count($this->getCartItems()) > 0)
        <!-- Cart Items -->
        <div class="max-h-[60vh] overflow-y-auto p-4 space-y-4">
            @foreach($this->getCartItems() as $key => $item)
                <div class="flex gap-4 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                    <!-- Product Image -->
                    <div class="flex-shrink-0">
                        @if($item['image'])
                            <img src="{{ asset($item['image']) }}" 
                                 alt="{{ $item['name'] }}" 
                                 class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-lg border border-gray-200">
                        @else
                            <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Product Info -->
                    <div class="flex-1 min-w-0">
                        <h3 class="text-sm sm:text-base font-semibold text-gray-800 truncate">{{ $item['name'] }}</h3>
                        
                        <!-- Price Display -->
                        <div class="mt-1 flex items-center gap-2">
                            @if(isset($item['promotion_price']) && $item['promotion_price'] < $item['price'])
                                <span class="text-xs sm:text-sm text-red-500 line-through">
                                    {{ number_format($item['price'], 2) }} DT
                                </span>
                                <span class="text-sm sm:text-base font-bold text-[#d4af37]">
                                    {{ number_format($item['promotion_price'], 2) }} DT
                                </span>
                            @else
                                <span class="text-sm sm:text-base font-bold text-gray-800">
                                    {{ number_format($item['price'], 2) }} DT
                                </span>
                            @endif
                        </div>

                        <!-- Quantity Controls -->
                        <div class="mt-2 flex items-center">
                            <button wire:click="decrementQuantity('{{ $key }}')" 
                                    class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-l-md bg-gray-100 hover:bg-gray-200 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                </svg>
                            </button>
                            <input type="number" min="1" 
                                   wire:change="updateCartItemQuantity('{{ $key }}', $event.target.value)"
                                   value="{{ $item['quantity'] }}"
                                   class="w-12 h-8 text-center border-t border-b border-gray-300 focus:outline-none focus:ring-1 focus:ring-[#d4af37]">
                            <button wire:click="incrementQuantity('{{ $key }}')" 
                                    class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-r-md bg-gray-100 hover:bg-gray-200 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remove & Total -->
                    <div class="flex flex-col items-end justify-between">
                        <button wire:click="removeCartItem('{{ $key }}')" 
                                class="text-red-500 hover:text-red-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                        <p class="text-sm font-bold text-gray-800 whitespace-nowrap">
                            {{ number_format(($item['promotion_price'] ?? $item['price']) * $item['quantity'], 2) }} DT
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Cart Footer -->
        <div class="border-t border-gray-200 bg-gray-50 p-4">
            <div class="space-y-2">
                <div class="flex justify-between">
                    <span class="text-gray-600">Subtotal:</span>
                    <span class="font-medium">{{ number_format($this->getCartSubtotal(), 2) }} DT</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Shipping:</span>
                    <span class="font-medium">{{ number_format($this->getShippingCost(), 2) }} DT</span>
                </div>
                <div class="flex justify-between pt-2 border-t border-gray-200">
                    <span class="font-bold text-gray-800">Total:</span>
                    <span class="font-bold text-lg text-[#d4af37]">{{ number_format($this->getCartTotal(), 2) }} DT</span>
                </div>
            </div>

            <div class="mt-4 grid grid-cols-1 gap-3">
                <a href="{{ route('cart') }}" 
                   class="flex items-center justify-center px-4 py-2 bg-[#d4af37] text-white rounded-md hover:bg-[#b8972e] transition font-medium">
                    View Cart
                </a>
                <button wire:click="clearCart"
                        class="flex items-center justify-center px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition font-medium">
                    Delete All
                </button>
                <button @click="$dispatch('closeCart')"
                        class="flex items-center justify-center px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 transition font-medium">
                    Continue Shopping
                </button>
            </div>
        </div>
    @else
        <!-- Empty Cart State -->
        <div class="p-6 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <h4 class="mt-2 text-lg font-medium text-gray-700">Your cart is empty</h4>
            <p class="mt-1 text-gray-500">Start shopping to add items to your cart</p>
            <button @click="$dispatch('closeCart')"
                   class="mt-4 inline-block px-6 py-2 bg-[#d4af37] text-white rounded-md hover:bg-[#b8972e] transition font-medium">
                Continue Shopping
            </button>
        </div>
    @endif
</div>