<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class Cart extends Component
{
    protected $listeners = ['add-to-cart' => 'add', 'cart-updated' => '$refresh'];

    // Form Properties
    public $firstName = '';
    public $lastName = '';
    public $email = '';
    public $phone = '';
    public $government = '';
    public $address = '';
    public $note = '';

    protected $rules = [
        'firstName' => 'required|min:2',
        'lastName' => 'required|min:2',
        'email' => 'required|email',
        'phone' => 'required|regex:/^[0-9]{8}$/',
        'government' => 'required',
        'address' => 'required|min:5',
    ];

    protected $messages = [
        'firstName.required' => 'Le prénom est requis',
        'lastName.required' => 'Le nom est requis',
        'email.required' => 'L\'email est requis',
        'email.email' => 'L\'email n\'est pas valide',
        'phone.required' => 'Le numéro de téléphone est requis',
        'phone.regex' => 'Le numéro de téléphone doit contenir 8 chiffres',
        'government.required' => 'Le gouvernorat est requis',
        'address.required' => 'L\'adresse est requise',
        'address.min' => 'L\'adresse doit contenir au moins 5 caractères',
    ];

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
        return 13.00;
    }

    public function getCartTotal()
    {
        return $this->getCartSubtotal() + $this->getShippingCost();
    }

    public function placeOrder()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            // Create the order
            $order = Order::create([
                'first_name' => $this->firstName,
                'last_name' => $this->lastName,
                'email' => $this->email,
                'phone' => $this->phone,
                'government' => $this->government,
                'address' => $this->address,
                'note' => $this->note,
                'subtotal' => $this->getCartSubtotal(),
                'shipping_cost' => $this->getShippingCost(),
                'total' => $this->getCartTotal(),
                'status' => 'pending'
            ]);

            // Create order items
            foreach ($this->getCartItems() as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'],
                    'price' => $item['promotion_price'] ?? $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => ($item['promotion_price'] ?? $item['price']) * $item['quantity']
                ]);
            }

            DB::commit();

            // Clear the cart
            $this->clearCart();

            // Show success message
            session()->flash('message', 'Votre commande a été placée avec succès!');

            // Redirect to success page or home
            return redirect()->route('home')->with('success', 'Commande effectuée avec succès');

        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('error', 'Une erreur est survenue lors de la création de votre commande. Veuillez réessayer.');
        }
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