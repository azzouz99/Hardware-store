<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Profile Information -->
            <div class="relative bg-gradient-to-r from-[#2d2d2d] to-[#3f3f3f] p-6 rounded-xl shadow-lg overflow-hidden">
                <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 25% 50%, white 0.5px, transparent 1px); background-size: 15px 15px;"></div>
                <div class="absolute right-0 top-0 h-full w-16 md:w-24 bg-gradient-to-l from-[#d4af37]/10 to-transparent"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="h-10 w-1 bg-[#d4af37] rounded-full"></div>
                        <h2 class="text-2xl font-bold text-white">
                            <span class="text-[#d4af37]">INFORMATIONS</span> DU PROFIL
                        </h2>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-inner">
                        <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                            @csrf
                            @method('patch')

                            <div class="space-y-1">
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Prenom</label>
                                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $user->first_name) }}" 
                                            placeholder="Prénom"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#d4af37] focus:ring focus:ring-[#d4af37]/20">
                                        @error('first_name')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nom</label>
                                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}"
                                            placeholder="Nom"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#d4af37] focus:ring focus:ring-[#d4af37]/20">
                                        @error('last_name')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#d4af37] focus:ring focus:ring-[#d4af37]/20">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Numéro de téléphone</label>
                                <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#d4af37] focus:ring focus:ring-[#d4af37]/20">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="border-t border-gray-200 pt-6 mt-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Informations de facturation (Optionnel)</h3>
                                
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                    <div>
                                        <label for="billing_address" class="block text-sm font-medium text-gray-700">Adresse</label>
                                        <input type="text" name="billing_address" id="billing_address" value="{{ old('billing_address', $user->billing_address) }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#d4af37] focus:ring focus:ring-[#d4af37]/20">
                                    </div>

                                    <div>
                                        <label for="billing_city" class="block text-sm font-medium text-gray-700">Ville</label>
                                        <input type="text" name="billing_city" id="billing_city" value="{{ old('billing_city', $user->billing_city) }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#d4af37] focus:ring focus:ring-[#d4af37]/20">
                                    </div>

                                    <div>
                                        <label for="billing_state" class="block text-sm font-medium text-gray-700">Région</label>
                                        <input type="text" name="billing_state" id="billing_state" value="{{ old('billing_state', $user->billing_state) }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#d4af37] focus:ring focus:ring-[#d4af37]/20">
                                    </div>

                                    <div>
                                        <label for="billing_postal_code" class="block text-sm font-medium text-gray-700">Code postal</label>
                                        <input type="text" name="billing_postal_code" id="billing_postal_code" value="{{ old('billing_postal_code', $user->billing_postal_code) }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#d4af37] focus:ring focus:ring-[#d4af37]/20">
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" 
                                    class="px-4 py-2 bg-[#d4af37] text-white rounded-lg hover:bg-[#b8972e] transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#d4af37]/50">
                                    Enregistrer les modifications
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete Account Section -->
            <div class="relative bg-gradient-to-r from-[#6a0a0a] to-[#8B0000] p-6 rounded-xl shadow-lg overflow-hidden">
                <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 25% 50%, white 0.5px, transparent 1px); background-size: 15px 15px;"></div>
                <div class="absolute right-0 top-0 h-full w-16 md:w-24 bg-gradient-to-l from-[#d4af37]/10 to-transparent"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="h-10 w-1 bg-[#d4af37] rounded-full"></div>
                        <h2 class="text-2xl font-bold text-white">
                            <span class="text-[#d4af37]">SUPPRIMER</span> LE COMPTE
                        </h2>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-inner">
                        <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6">
                            @csrf
                            @method('delete')

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe actuel</label>
                                <input type="password" name="password" id="password"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring focus:ring-red-500/20">
                                @error('password', 'userDeletion')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" 
                                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500/50"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.')">
                                    Supprimer le compte
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
