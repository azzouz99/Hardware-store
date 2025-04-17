<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;

class HomePage extends Component
{
    public $categories;
    public $promotedProducts;
    
    protected $listeners = ['add-to-cart' => 'addToCart'];

    public function mount()
    {
        $this->categories = Category::with('subcategories.subsubcategories', 'subcategories.products')->get();
        $this->promotedProducts = Product::promoted()->get();
    }

    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->images->first()?->image_path,
            ];
        }

        session()->put('cart', $cart);
        $this->dispatch('cart-updated');
    }

    public function render()
    {
        return view('livewire.home-page', [
            'categories' => $this->categories,
            'promotedProducts' => $this->promotedProducts
        ]);
    }
}
