<div class="bg-gray-50 min-h-screen py-8">
    <div class="container max-w-7xl mx-auto px-4">
        <h1 class="text-2xl font-bold text-gray-900 mb-8">Finaliser la commande</h1>

        @if(count($this->getCartItems()) > 0)
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Checkout Form Section -->
                <div class="lg:w-2/3 bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-6">Informations de livraison</h2>
                    
                    <!-- Display Success Message -->
                    @if (session()->has('message'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                            {{ session('message') }}
                        </div>
                    @endif

                    <!-- Display Error Message -->
                    @if (session()->has('error'))
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                            {{ session('error') }}
                        </div>
                    @endif

                    @auth
                        <div class="mb-6 p-4 bg-blue-50 text-blue-700 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Vos informations ont été automatiquement remplies. Vous pouvez les modifier si nécessaire.
                            </div>
                        </div>
                    @endauth

                    <form wire:submit="placeOrder" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label for="firstName" class="block text-sm font-medium text-gray-700">Prénom</label>
                                <input type="text" id="firstName" wire:model="firstName" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#d4af37] focus:ring-[#d4af37]">
                                @error('firstName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Last Name -->
                            <div>
                                <label for="lastName" class="block text-sm font-medium text-gray-700">Nom</label>
                                <input type="text" id="lastName" wire:model="lastName"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#d4af37] focus:ring-[#d4af37]">
                                @error('lastName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" id="email" wire:model="email"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#d4af37] focus:ring-[#d4af37]">
                                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Phone -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                                <input type="tel" id="phone" wire:model="phone"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#d4af37] focus:ring-[#d4af37]">
                                @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Government -->
                            <div>
                                <label for="government" class="block text-sm font-medium text-gray-700">Gouvernorat</label>
                                <select id="government" wire:model="government"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#d4af37] focus:ring-[#d4af37]">
                                    <option value="">Sélectionnez un gouvernorat</option>
                                    <option value="Tunis">Tunis</option>
                                    <option value="Ariana">Ariana</option>
                                    <option value="Ben Arous">Ben Arous</option>
                                    <!-- Add other governorates -->
                                </select>
                                @error('government') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Address -->
                            <div class="md:col-span-2">
                                <label for="address" class="block text-sm font-medium text-gray-700">Adresse</label>
                                <input type="text" id="address" wire:model="address"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#d4af37] focus:ring-[#d4af37]">
                                @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Note -->
                            <div class="md:col-span-2">
                                <label for="note" class="block text-sm font-medium text-gray-700">Note sur la commande</label>
                                <textarea id="note" wire:model="note" rows="3"
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#d4af37] focus:ring-[#d4af37]"></textarea>
                            </div>
                        </div>

                        <button type="submit" 
                                class="w-full bg-[#d4af37] text-white py-3 px-4 rounded-md hover:bg-[#b8972e] transition-colors font-medium flex items-center justify-center space-x-2">
                            <span>Commander</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Cart Summary Section -->
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-lg shadow-sm p-6 sticky top-8">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Votre Panier</h2>
                        
                        <div class="space-y-4">
                            @foreach($this->getCartItems() as $key => $item)
                                <div class="flex items-center gap-4 py-4 border-b border-gray-100">
                                    <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0">
                                        @if($item['image'])
                                            <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" 
                                                 class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-sm font-medium text-gray-900 truncate">{{ $item['name'] }}</h3>
                                        <p class="text-sm text-gray-500">Quantité: {{ $item['quantity'] }}</p>
                                        <p class="text-sm font-bold text-[#d4af37]">
                                            {{ number_format(($item['promotion_price'] ?? $item['price']) * $item['quantity'], 2) }} DT
                                        </p>
                                    </div>
                                </div>
                            @endforeach

                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Sous-total</span>
                                    <span class="font-medium">{{ number_format($this->getCartSubtotal(), 2) }} DT</span>
                                </div>
                                
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Frais de livraison</span>
                                    <span class="font-medium">13.00 DT</span>
                                </div>

                                <div class="border-t border-gray-200 pt-4 mt-4">
                                    <div class="flex justify-between">
                                        <span class="text-lg font-bold text-gray-900">Total</span>
                                        <span class="text-xl font-bold text-[#d4af37]">{{ number_format($this->getCartTotal(), 2) }} DT</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart State -->
            <div class="text-center py-16 bg-white rounded-lg shadow-sm">
                <svg class="w-20 h-20 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <h2 class="mt-4 text-2xl font-bold text-gray-900">Votre panier est vide</h2>
                <p class="mt-2 text-gray-500">Vous n'avez pas encore ajouté d'articles à votre panier.</p>
                <a href="{{ route('home') }}" 
                   class="mt-6 inline-block bg-[#d4af37] text-white py-3 px-8 rounded-md hover:bg-[#b8972e] transition-colors font-medium">
                    Continuer vos achats
                </a>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', () => {
        console.log('Livewire initialized, setting up SweetAlert listener');
        
        Livewire.on('swal', (data) => {
            console.log('SweetAlert event received:', data);
            
            try {
                Swal.fire({
                    icon: data[0].icon,
                    title: data[0].title,
                    text: data[0].text,
                    timer: data[0].timer || null,
                    showConfirmButton: data[0].showConfirmButton !== false,
                    position: data[0].position || 'center',
                }).then((result) => {
                    console.log('SweetAlert shown successfully');
                    if (data[0].callback === 'redirect' && data[0].redirectUrl) {
                        window.location.href = data[0].redirectUrl;
                    }
                });
            } catch (error) {
                console.error('Error showing SweetAlert:', error);
            }
        });
    });
</script>
@endpush