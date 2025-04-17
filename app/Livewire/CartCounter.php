<?php

namespace App\Livewire;

use Livewire\Component;

class CartCounter extends Component
{
    protected $listeners = ['cart-updated' => '$refresh'];

    public function getCartCount()
    {
        $cart = session()->get('cart', []);
        return array_sum(array_column($cart, 'quantity'));
    }

    public function render()
    {
        return view('livewire.cart-counter');
    }
}