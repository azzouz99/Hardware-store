@extends('layouts.admin')

@section('content')
    <div class="relative bg-gradient-to-r from-[#2d2d2d] to-[#3f3f3f] p-6 rounded-xl shadow-lg overflow-hidden mb-6">
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 25% 50%, white 0.5px, transparent 1px); background-size: 15px 15px;"></div>
        <div class="absolute right-0 top-0 h-full w-16 md:w-24 bg-gradient-to-l from-[#d4af37]/10 to-transparent"></div>
        
        <div class="relative z-10">
            <div class="flex items-center space-x-4 mb-6">
                <div class="h-10 w-1 bg-[#d4af37] rounded-full"></div>
                <h2 class="text-2xl font-bold text-white">
                    <span class="text-[#d4af37]">GESTION</span> DES COMMANDES
                </h2>
            </div>

            <!-- Orders Table Component -->
            <div class="bg-white rounded-lg shadow-inner">
                <livewire:admin.orders-table />
            </div>
        </div>
    </div>
@endsection
