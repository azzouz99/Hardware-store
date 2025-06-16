@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header with Dark Gradient -->
    <div class="relative bg-gradient-to-r from-[#2d2d2d] to-[#3f3f3f] p-3 md:p-5 mb-8 rounded-lg md:rounded-xl shadow-lg md:shadow-2xl overflow-hidden">
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 25% 50%, white 0.5px, transparent 1px); background-size: 15px 15px;"></div>
        <div class="absolute right-0 top-0 h-full w-16 md:w-24 bg-gradient-to-l from-[#d4af37]/10 to-transparent"></div>
        
        <div class="relative z-10 flex items-center space-x-2 md:space-x-4">
            <div class="h-8 w-0.5 md:h-10 md:w-1 bg-[#d4af37] rounded-full"></div>
            <h2 class="text-xl md:text-2xl font-bold text-white uppercase tracking-tight md:tracking-wider">
                <span class="text-[#d4af37]">MES</span> COMMANDES
            </h2>
        </div>
        
        <div class="absolute bottom-0 left-0 right-0 h-0.5 md:h-1 bg-gradient-to-r from-[#d4af37] via-[#d4af37]/50 to-transparent"></div>
    </div>

    @if($orders->isEmpty())
        <div class="bg-white rounded-xl shadow-md p-8 text-center">
            <div class="flex flex-col items-center justify-center space-y-4">
                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <p class="text-xl text-gray-600 font-medium">Vous n'avez pas encore passé de commande.</p>
                <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-[#d4af37] text-white rounded-lg hover:bg-[#b28f2d] transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Découvrir nos produits
                </a>
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($orders as $order)
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl shadow-md group hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                    <!-- Order Header -->
                    <div class="bg-gradient-to-r from-[#2d2d2d] to-[#3f3f3f] p-4 relative">
                        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 25% 50%, white 0.5px, transparent 1px); background-size: 10px 10px;"></div>
                        <div class="relative">
                            <div class="flex justify-between items-center">
                                <span class="text-[#d4af37] font-semibold">Commande #TN-{{ $order->id }}</span>
                                <span class="text-white text-sm">{{ $order->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Order Content -->
                    <div class="p-4">
                        <!-- Products List -->
                        <div class="space-y-3 mb-4">
                            @foreach($order->products as $product)
                                <div class="flex items-center space-x-3 p-2 rounded-lg bg-white shadow-sm group-hover:shadow-md transition-shadow duration-200">
                                    <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center overflow-hidden">
                                        <img src="{{ asset($product->images->first()->image_path ?? 'images/no-image.png') }}" 
                                             alt="{{ $product->name }}"
                                             class="w-full h-full object-cover"
                                             loading="lazy">
                                    </div>
                                    <div class="flex-grow">
                                        <h4 class="text-sm font-medium text-gray-800">{{ $product->name }}</h4>
                                        <div class="flex justify-between items-center mt-1">
                                            <span class="text-xs text-gray-500">Quantité: {{ $product->pivot->quantity }}</span>
                                            <span class="text-xs font-medium text-[#d4af37]">
                                                {{ number_format($product->price * $product->pivot->quantity, 3) }} DT
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Order Footer -->
                        <div class="border-t border-gray-200 pt-3 mt-3">
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-sm font-medium text-gray-600">Total:</span>
                                <span class="text-lg font-bold text-[#d4af37]">{{ number_format($order->total, 3) }} DT</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
