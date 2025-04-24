<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="relative bg-gradient-to-r from-[#2d2d2d] to-[#3f3f3f] p-6 rounded-xl shadow-lg overflow-hidden">
                <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 25% 50%, white 0.5px, transparent 1px); background-size: 15px 15px;"></div>
                <div class="absolute right-0 top-0 h-full w-16 md:w-24 bg-gradient-to-l from-[#d4af37]/10 to-transparent"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="h-10 w-1 bg-[#d4af37] rounded-full"></div>
                        <h2 class="text-2xl font-bold text-white">
                            <span class="text-[#d4af37]">PROFILE</span> INFORMATION
                        </h2>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-inner">
                        <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                            @csrf
                            @method('patch')

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#d4af37] focus:ring focus:ring-[#d4af37]/20">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#d4af37] focus:ring focus:ring-[#d4af37]/20">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" 
                                    class="px-4 py-2 bg-[#d4af37] text-white rounded-lg hover:bg-[#b8972e] transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#d4af37]/50">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="relative bg-gradient-to-r from-[#6a0a0a] to-[#8B0000] p-6 rounded-xl shadow-lg overflow-hidden">
                <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 25% 50%, white 0.5px, transparent 1px); background-size: 15px 15px;"></div>
                <div class="absolute right-0 top-0 h-full w-16 md:w-24 bg-gradient-to-l from-[#d4af37]/10 to-transparent"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="h-10 w-1 bg-[#d4af37] rounded-full"></div>
                        <h2 class="text-2xl font-bold text-white">
                            <span class="text-[#d4af37]">DELETE</span> ACCOUNT
                        </h2>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-inner">
                        <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6">
                            @csrf
                            @method('delete')

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Current Password</label>
                                <input type="password" name="password" id="password"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring focus:ring-red-500/20">
                                @error('password', 'userDeletion')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" 
                                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500/50"
                                    onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
                                    Delete Account
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
