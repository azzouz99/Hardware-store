<div x-data="{ open: false }" @closeCart.window="open = false" class="relative">
    <a href="{{ route('cart.view') }}" class="relative text-gray-700 hover:text-[#d4af37]">
        <i class="fa fa-shopping-cart text-xl"></i>
        @if ($cartCount > 0)
            <span class="absolute -top-2 -right-2 bg-[#d4af37] text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">
                {{ $cartCount }}
            </span>
        @endif
    </a>
</div>
