<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class SearchBar extends Component
{
    public $query = '';
    public $results = [];
    public $showDropdown = false;

    public function updatedQuery()
    {
        if (strlen($this->query) >= 2) {
            $this->results = Product::where('name', 'like', '%' . $this->query . '%')
                ->orWhere('reference', 'like', '%' . $this->query . '%')
                ->with('images')
                ->take(5)
                ->get();
            $this->showDropdown = true;
        } else {
            $this->results = [];
            $this->showDropdown = false;
        }
    }

    public function clearSearch()
    {
        $this->query = '';
        $this->results = [];
        $this->showDropdown = false;
    }

    public function render()
    {
        return view('livewire.search-bar');
    }
}
