@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <!-- Category Header (static, from controller) -->
  <div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-800">
      {{ $category->name }}
      <span class="text-gray-600 text-sm ml-2">
        • {{ $totalProducts }} article(s) trouvé(s)
      </span>
    </h1>
  </div>

  <!-- Responsive Layout: vertical on small screens, horizontal on md+ -->
  <div class="flex flex-col md:flex-row gap-6">
    <!-- Left Sidebar: full width on small screens, fixed width on medium+ -->
    <aside class="w-full md:w-64 bg-white border border-gray-200 rounded-lg shadow-md p-4">
      <!-- Subcategory Filter -->
      <h2 class="text-lg font-bold mb-2">Catégories</h2>
      <ul class="space-y-2">
        <li>
          <a href="{{ route('category.index', ['category' => $category->id]) }}"
             class="block text-gray-700 hover:text-[#d4af37] transition">
             Tous ({{ $totalProducts }})
          </a>
        </li>
        @foreach($subcategories as $subcat)
          <li>
            <a href="{{ route('category.index', ['category' => $category->id, 'subcategory' => $subcat->id]) }}"
               class="block text-gray-700 hover:text-[#d4af37] transition">
               {{ $subcat->name }} ({{ $subcat->products->count() }})
            </a>
          </li>
        @endforeach
      </ul>

      <!-- Price Range Filter -->
      <!-- <div class="mt-6">
        <h3 class="text-md font-bold mb-2">Prix</h3>
        <form action="{{ route('category.index', ['category' => $category->id]) }}" method="GET" id="priceFilterForm">
          <input type="hidden" name="category" value="{{ $category->id }}">
          @if(request('subcategory'))
            <input type="hidden" name="subcategory" value="{{ request('subcategory') }}">
          @endif
          <div class="flex items-center justify-between">
            <span class="text-sm">{{ $minPrice }} DT</span>
            <span class="text-sm">{{ $maxPrice }} DT</span>
          </div>
          <input type="range" name="minPrice" min="{{ $minPrice }}" max="{{ $maxPrice }}" step="1" value="{{ request('minPrice', $minPrice) }}" class="w-full mt-2">
          <div class="flex justify-between mt-1 text-sm">
            <span>{{ $minPrice }} DT</span>
            <span>{{ request('minPrice', $minPrice) }} DT</span>
            <span>{{ $maxPrice }} DT</span>
          </div>
          <button type="submit" class="mt-2 w-full px-3 py-1 bg-[#d4af37] text-white rounded hidden">Filtrer</button>
        </form>
      </div> -->
    </aside>

    <!-- Main Content (Right) using Livewire -->
    <section class="flex-1">
      <livewire:product-search :categoryId="$category->id" :minPrice="$minPrice" :maxPrice="$maxPrice" />
    </section>
  </div>
</div>
@endsection
