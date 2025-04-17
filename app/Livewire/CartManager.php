<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class CartManager extends Component
{
    protected $listeners = ['add-to-cart'];

    public function addToCart($data)
    {
        $productId = $data['productId'];
        $product = Product::with(['images' => function($query) {
            $query->withPivot('image_path'); // Load pivot data
        }])->findOrFail($productId);

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += 1;
        } else {
            $imagePath = $product->images->isNotEmpty() 
            ? $product->images->first()->image_path 
            : null;
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $imagePath,
            ];
        }

        session()->put('cart', $cart);

        // Emit event to update header
        $this->emit('cartUpdated');
    }

    public function render()
    {
        return view('livewire.cart-manager');
    }
}

