<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class Cart extends Component
{
    protected $listeners = ['add-to-cart' => 'add', 'cart-updated' => '$refresh'];

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
        
        // Emit event to update cart counter and dropdown
        $this->dispatch('cart-updated');
        
        // Flash success message
        session()->flash('message', 'Product added to cart!');
    }

    public function incrementQuantity($productId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
            session()->put('cart', $cart);
            $this->dispatch('cart-updated');
        }
    }

    public function decrementQuantity($productId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId]) && $cart[$productId]['quantity'] > 1) {
            $cart[$productId]['quantity']--;
            session()->put('cart', $cart);
            $this->dispatch('cart-updated');
        }
    }

    public function updateCartItemQuantity($productId, $quantity)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $quantity = max(1, intval($quantity)); // Ensure quantity is at least 1
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
            $this->dispatch('cart-updated');
        }
    }

    public function removeCartItem($productId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            $this->dispatch('cart-updated');
        }
    }

    public function getCartItems()
    {
        return session()->get('cart', []);
    }

    public function getCartSubtotal()
    {
        $cart = $this->getCartItems();
        return collect($cart)->sum(function ($item) {
            $price = isset($item['promotion_price']) && $item['promotion_price'] < $item['price'] 
                ? $item['promotion_price'] 
                : $item['price'];
            return $price * $item['quantity'];
        });
    }

    public function getShippingCost()
    {
        // You can implement your shipping cost logic here
        return 0;
    }

    public function getCartTotal()
    {
        return $this->getCartSubtotal() + $this->getShippingCost();
    }

    public function clearCart()
    {
        session()->forget('cart');
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
?>