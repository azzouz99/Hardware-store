<x-guest-layout>
    <form class="space-y-6" method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">
                Email
            </label>
            <div class="mt-1">
                <input id="email" name="email" type="email" required autocomplete="username"
                       class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 
                              focus:outline-none focus:ring-[#d4af37] focus:border-[#d4af37] sm:text-sm transition-colors duration-200"
                       value="{{ old('email') }}" autofocus placeholder="votre@email.com">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">
                Mot de passe
            </label>
            <div class="mt-1">
                <input id="password" name="password" type="password" required autocomplete="current-password"
                       class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 
                              focus:outline-none focus:ring-[#d4af37] focus:border-[#d4af37] sm:text-sm transition-colors duration-200"
                       placeholder="••••••••">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Session Status -->
        <div>
            <x-auth-session-status class="mb-4" :status="session('status')" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input id="remember_me" name="remember" type="checkbox"
                       class="h-4 w-4 text-[#d4af37] focus:ring-[#d4af37] border-gray-300 rounded transition-colors duration-200">
                <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                    Se souvenir de moi
                </label>
            </div>

            @if (Route::has('password.request'))
                <div class="text-sm">
                    <a href="{{ route('password.request') }}" 
                       class="font-medium text-[#d4af37] hover:text-[#b8972e] transition-colors duration-200">
                        Mot de passe oublié?
                    </a>
                </div>
            @endif
        </div>

        <div class="space-y-4">
            <button type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium 
                           text-white bg-[#d4af37] hover:bg-[#b8972e] focus:outline-none focus:ring-2 
                           focus:ring-offset-2 focus:ring-[#d4af37] transition-all duration-200">
                Se connecter
            </button>

            <!-- Register Link -->
            <p class="text-center text-sm text-gray-600">
                Vous n'avez pas de compte?
                <a href="{{ route('register') }}" class="font-medium text-[#d4af37] hover:text-[#b8972e] transition-colors duration-200">
                    Inscrivez-vous
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
