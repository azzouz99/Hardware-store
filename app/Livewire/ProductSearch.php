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
    
    public $minPrice;
    public $maxPrice;
    #[Reactive] 
    public $categoryId;
    
    // Filtering properties
    #[Url]
    public $search = '';
    
    #[Url]
    public $sort = 'pertinence'; // Set default value
    
    #[Url]
    public $perPage = 12; // Match default with query string
    
    #[Url]
    public $selectedSubcategory = null;

    public function mount($categoryId, $minPrice, $maxPrice)
    {
        $this->categoryId = $categoryId;
        $this->minPrice = $minPrice;
        $this->maxPrice = $maxPrice;
        $this->selectedSubcategory = request()->query('subcategory');
    }

    public function updating($name, $value)
    {
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::query()
            ->with(['subsubCategory.subcategory', 'images']) // Eager load relationships
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
            ->whereBetween('price', [$this->minPrice, $this->maxPrice])
            ->when($this->sort === 'prix-asc', fn($q) => $q->orderBy('price', 'asc'))
            ->when($this->sort === 'prix-desc', fn($q) => $q->orderBy('price', 'desc'))
            ->when($this->sort === 'pertinence', fn($q) => $q->latest())
            ->paginate($this->perPage);
        
        return view('livewire.product-search', compact('products'));
    }
}