<span class="relative">
    <i class="fa fa-shopping-cart fa-lg"></i>
    @if($this->getCartCount() > 0)
        <span class="absolute -top-2 -right-2 bg-[#d4af37] text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
            {{ $this->getCartCount() }}
        </span>
    @endif
</span>