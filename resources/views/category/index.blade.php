@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <!-- Category Header (static, from controller) -->
  <div class="mb-8">
    <h1 class="text-base text-gray-800 flex items-center space-x-2">
      <!-- Breadcrumbs -->
      <a href="{{ route('home') }}" class="text-gray-500 hover:text-[#d4af37] transition">Accueil</a>
      <span class="text-gray-500">/</span>
        <!-- Category Link -->
        <a 
            href="{{ route('category.index', ['category' => $category->id]) }}"
            class="hover:text-[#d4af37] transition"
        >
            {{ $category->name }}
        </a>

        <!-- Subcategory Link -->
        @if(request()->has('subcategory'))
            @php
                $selectedSubcategory = $subcategories->firstWhere('id', request()->input('subcategory'));
            @endphp
            @if($selectedSubcategory)
                <span class="text-gray-500">/</span>
                <a 
                    href="{{ route('category.index', ['category' => $category->id, 'subcategory' => $selectedSubcategory->id]) }}"
                    class="hover:text-[#d4af37] transition"
                >
                    {{ $selectedSubcategory->name }}
                </a>
            @endif
        @endif

        <!-- Sub-subcategory Link -->
        @if(request()->has('subsubcategory'))
            @if($selectedSubcategory && $selectedSubcategory->subsubcategories)
                @php
                    $selectedSubsubcategory = $selectedSubcategory->subsubcategories->firstWhere('id', request()->input('subsubcategory'));
                @endphp
                @if($selectedSubsubcategory)
                    <span class="text-gray-500">/</span>
                    <a 
                        href="{{ route('category.index', [
                            'category' => $category->id,
                            'subcategory' => $selectedSubcategory->id,
                            'subsubcategory' => $selectedSubsubcategory->id
                        ]) }}"
                        class="hover:text-[#d4af37] transition"
                    >
                        {{ $selectedSubsubcategory->name }}
                    </a>
                @endif
            @endif
        @endif

        <!-- Product Count -->
        <span class="text-gray-600 text-sm ml-2">
            • {{ $totalProducts }} article(s) trouvé(s)
        </span>
    </h1>
  </div>

  <!-- Responsive Layout: vertical on small screens, horizontal on md+ -->
  <div class="flex flex-col md:flex-row gap-6">
    <!-- Left Sidebar: full width on small screens, fixed width on medium+ -->
    <aside class="w-full md:w-64 bg-white border border-gray-200 rounded-lg shadow-md p-4">
      <!-- Category Filter -->
      <h2 class="text-lg font-bold mb-2">Catégories</h2>
      <ul class="space-y-2 mb-6">
        @if(request()->has('subcategory'))
          <!-- Show only sub-subcategories for the selected subcategory -->
          @php
            $selectedSubcategory = $subcategories->firstWhere('id', request()->input('subcategory'));
          @endphp
          <li>
            <a href="{{ route('category.index', ['category' => $category->id, 'subcategory' => $selectedSubcategory->id]) }}"
               class="block text-gray-700 hover:text-[#d4af37] transition {{ !request()->has('subsubcategory') ? 'font-bold text-[#d4af37]' : '' }}">
               Tous ({{ $selectedSubcategory->products->count() }})
            </a>
          </li>
          @if($selectedSubcategory && $selectedSubcategory->subsubcategories->isNotEmpty())
            @foreach($selectedSubcategory->subsubcategories as $subsubcat)
              <li>
                <a href="{{ route('category.index', [
                    'category' => $category->id,
                    'subcategory' => $selectedSubcategory->id,
                    'subsubcategory' => $subsubcat->id
                  ]) }}"
                  class="block text-sm text-gray-600 hover:text-[#d4af37] transition {{ request('subsubcategory') == $subsubcat->id ? 'font-bold text-[#d4af37]' : '' }}">
                  {{ $subsubcat->name }} ({{ $subsubcat->products->count() }})
                </a>
              </li>
            @endforeach
          @endif
        @else
          <!-- Show all subcategories -->
          <li>
            <a href="{{ route('category.index', ['category' => $category->id]) }}"
               class="block text-gray-700 hover:text-[#d4af37] transition {{ !request()->has('subcategory') ? 'font-bold text-[#d4af37]' : '' }}">
               Tous ({{ $totalProducts }})
            </a>
          </li>
          @foreach($subcategories as $subcat)
            <li>
              <a href="{{ route('category.index', ['category' => $category->id, 'subcategory' => $subcat->id]) }}"
                 class="block text-sm text-gray-600 hover:text-[#d4af37] transition{{ request('subcategory') == $subcat->id ? 'font-bold text-[#d4af37]' : '' }}">
                 {{ $subcat->name }} ({{ $subcat->products->count() }})
              </a>
            </li>
          @endforeach
        @endif
      </ul>

      <!-- Price Filter -->
      <div class="border-t border-gray-200 pt-4">
        <h2 class="text-lg font-bold mb-2">Price Range</h2>
        <div class="flex flex-col sm:flex-row gap-4">
          <div class="flex-1">
            <label for="min_price" class="block text-sm font-medium text-gray-700">Min</label>
            <input 
              type="number" 
              id="min_price" 
              wire:model.live="minPrice" 
              min="0" 
              max="800" 
              step="1" 
              placeholder="0" 
              class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-[#d4af37] focus:border-[#d4af37] sm:text-sm"
            >
            @error('minPrice') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
          </div>
          <div class="flex-1">
            <label for="max_price" class="block text-sm font-medium text-gray-700">Max</label>
            <input 
              type="number" 
              id="max_price" 
              wire:model.live="maxPrice" 
              min="0" 
              max="800" 
              step="1" 
              placeholder="800" 
              class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-[#d4af37] focus:border-[#d4af37] sm:text-sm"
            >
            @error('maxPrice') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
          </div>
        </div>
      </div>
    </aside>

    <!-- Main Content (Right) using Livewire -->
    <section class="flex-1">
      <livewire:product-search :categoryId="$category->id" :minPrice="$minPrice" :maxPrice="$maxPrice" />
    </section>
  </div>
</div>
@endsection