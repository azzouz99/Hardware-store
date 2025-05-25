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
        // Get all categories with 4 random subcategories, each containing 8 random products
        $this->categories = Category::with(['subcategories' => function($query) {
            $query->inRandomOrder()->take(4)->with(['products' => function($query) {
                $query->inRandomOrder()->take(8);
            }]);
        }])->get();
        
        // Get promoted products
        $this->promotedProducts = Product::promoted()->inRandomOrder()->take(10)->get();
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
                'promotion_price' => $product->promotion ? $product->promotion_value : null,
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
