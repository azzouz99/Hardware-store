<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">
                Nom complet
            </label>
            <div class="mt-1">
                <input id="name" name="name" type="text" required autocomplete="name"
                       class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 
                              focus:outline-none focus:ring-[#d4af37] focus:border-[#d4af37] sm:text-sm transition-colors duration-200"
                       value="{{ old('name') }}" placeholder="Jean Dupont">
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">
                Email
            </label>
            <div class="mt-1">
                <input id="email" name="email" type="email" required autocomplete="username"
                       class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 
                              focus:outline-none focus:ring-[#d4af37] focus:border-[#d4af37] sm:text-sm transition-colors duration-200"
                       value="{{ old('email') }}" placeholder="votre@email.com">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">
                Mot de passe
            </label>
            <div class="mt-1">
                <input id="password" name="password" type="password" required autocomplete="new-password"
                       class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 
                              focus:outline-none focus:ring-[#d4af37] focus:border-[#d4af37] sm:text-sm transition-colors duration-200"
                       placeholder="••••••••">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                Confirmer le mot de passe
            </label>
            <div class="mt-1">
                <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                       class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 
                              focus:outline-none focus:ring-[#d4af37] focus:border-[#d4af37] sm:text-sm transition-colors duration-200"
                       placeholder="••••••••">
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="space-y-4">
            <button type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium 
                           text-white bg-[#d4af37] hover:bg-[#b8972e] focus:outline-none focus:ring-2 
                           focus:ring-offset-2 focus:ring-[#d4af37] transition-all duration-200">
                S'inscrire
            </button>

            <!-- Login Link -->
            <p class="text-center text-sm text-gray-600">
                Vous avez déjà un compte?
                <a href="{{ route('login') }}" class="font-medium text-[#d4af37] hover:text-[#b8972e] transition-colors duration-200">
                    Connectez-vous
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
