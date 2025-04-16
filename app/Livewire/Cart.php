<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Cart extends Component
{
    public function add($productId, $quantity = 1)
    {
        $product = Product::findOrFail($productId);
        
        // Initialize cart in session if not exists
        $cart = session()->get('cart', []);
        
        // Add or update product in cart
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->images->first()?->image_path,
            ];
        }
        
        // Save cart to session
        session()->put('cart', $cart);
        
        // Emit event to update cart counter
        $this->dispatch('cart-updated');
    }

    public function getCartCount()
    {
        $cart = session()->get('cart', []);
        return array_sum(array_column($cart, 'quantity'));
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
