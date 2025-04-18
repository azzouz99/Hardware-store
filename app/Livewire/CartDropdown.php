<?php

namespace App\Livewire;

use Livewire\Component;

class CartDropdown extends Component
{
    protected $listeners = ['cart-updated' => '$refresh'];

    public function incrementQuantity($productId)
    {
        $this->dispatch('add-to-cart', $productId, 1);
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

    public function removeCartItem($productId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            $this->dispatch('cart-updated');
        }
    }

    public function clearCart()
    {
        session()->forget('cart');
        $this->dispatch('cart-updated');
    }

    public function getCartItems()
    {
        return session()->get('cart', []);
    }

    public function getCartSubtotal()
    {
        $cart = $this->getCartItems();
        return collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
    }

    public function getShippingCost()
    {
        return 0;
    }

    public function getCartTotal()
    {
        return $this->getCartSubtotal() + $this->getShippingCost();
    }

    public function render()
    {
        return view('livewire.cart-dropdown');
    }
}