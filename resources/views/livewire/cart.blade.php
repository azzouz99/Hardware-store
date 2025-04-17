<div>
    @if(session()->has('cart') && count(session('cart')) > 0)
        <div class="space-y-4">
            @foreach(session('cart') as $item)
                <div class="flex items-center border-b border-gray-200 py-4">
                    @if($item['image'])
                        <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded-md mr-4">
                    @else
                        <div class="w-16 h-16 bg-gray-100 rounded-md mr-4 flex items-center justify-center">
                            <span class="text-gray-500">No Image</span>
                        </div>
                    @endif
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $item['name'] }}</h3>
                        <p class="text-gray-600">{{ number_format($item['price'], 2) }} DT x {{ $item['quantity'] }}</p>
                    </div>
                    <p class="text-gray-800 font-bold">{{ number_format($item['price'] * $item['quantity'], 2) }} DT</p>
                </div>
            @endforeach
            <div class="text-right">
                <p class="text-xl font-bold text-gray-800">
                    Total: {{ number_format(collect(session('cart'))->sum(fn($item) => $item['price'] * $item['quantity']), 2) }} DT
                </p>
            </div>
        </div>
    @else
        <p class="text-gray-500">Your cart is empty.</p>
    @endif
</div>