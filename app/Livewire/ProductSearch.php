<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Livewire\Attributes\Reactive;

class ProductSearch extends Component
{
    use WithPagination;

    #[Reactive]
    public $categoryId;

    public $minPrice;
    public $maxPrice;

    // Filtering properties
    #[Url]
    public $search = '';

    #[Url]
    public $sort = 'pertinence';

    #[Url]
    public $perPage = 8;

    #[Url]
    public $selectedSubcategory = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'sort' => ['except' => 'pertinence'],
        'perPage' => ['except' => 8],
        'selectedSubcategory' => ['except' => null],
        'minPrice' => ['except' => 0],
        'maxPrice' => ['except' => 800],
    ];

    public function mount($categoryId, $minPrice, $maxPrice)
    {
        $this->categoryId = $categoryId;
        $this->minPrice = $minPrice ?? 0;
        $this->maxPrice = $maxPrice ?? 800;
        $this->selectedSubcategory = request()->query('subcategory');
    }

    public function rules()
    {
        return [
            'minPrice' => 'nullable|numeric|min:0|max:800',
            'maxPrice' => 'nullable|numeric|min:0|max:800|gte:minPrice',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        $this->resetPage();

        // Ensure minPrice <= maxPrice
        if ($propertyName === 'minPrice' && $this->minPrice > $this->maxPrice) {
            $this->minPrice = $this->maxPrice;
        }
        if ($propertyName === 'maxPrice' && $this->maxPrice < $this->minPrice) {
            $this->maxPrice = $this->minPrice;
        }
    }

    public function render()
    {
        $products = Product::query()
            ->with(['subsubCategory.subcategory', 'images'])
            ->whereHas('subsubCategory.subcategory', fn($q) =>
                $q->where('category_id', $this->categoryId)
            )
            ->when($this->selectedSubcategory, fn($q) =>
                $q->whereHas('subsubCategory', fn($q) =>
                    $q->where('subcategory_id', $this->selectedSubcategory)
                )
            )
            ->when($this->search, fn($q) =>
                $q->where(function($q) {
                    $q->where('name', 'like', '%'.$this->search.'%')
                      ->orWhere('description', 'like', '%'.$this->search.'%');
                })
            )
            ->when(request()->has('subsubcategory'), fn($q) =>
                $q->where('subsub_category_id', request()->input('subsubcategory'))
            )
            ->whereBetween('price', [$this->minPrice ?: 0, $this->maxPrice ?: 800])
            ->when($this->sort === 'prix-asc', fn($q) => $q->orderBy('price', 'asc'))
            ->when($this->sort === 'prix-desc', fn($q) => $q->orderBy('price', 'desc'))
            ->when($this->sort === 'pertinence', fn($q) => $q->latest())
            ->paginate($this->perPage);

        return view('livewire.product-search', compact('products'));
    }
}