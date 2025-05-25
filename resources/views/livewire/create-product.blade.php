<div class="container mx-auto p-4 sm:p-6 max-w-4xl">
    <h1 class="text-2xl sm:text-3xl font-bold mb-6 text-gray-800">Create Product</h1>

    @if($message)
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            {{ $message }}
        </div>
    @endif

    @if($error)
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            {{ $error }}
        </div>
    @endif

    <form wire:submit.prevent="save" enctype="multipart/form-data" class="space-y-6">
        <!-- Product Details -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-semibold mb-4 text-gray-700">Product Details</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" wire:model.blur="name" id="name" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-[#d4af37] focus:border-[#d4af37] sm:text-sm" required>
                    @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <!-- Unit -->
                <div>
                    <label for="unite" class="block text-sm font-medium text-gray-700">Unit</label>
                    <input type="text" wire:model.blur="unite" id="unite" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-[#d4af37] focus:border-[#d4af37] sm:text-sm" required>
                    @error('unite') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <!-- Reference -->
                <div>
                    <label for="reference" class="block text-sm font-medium text-gray-700">Reference</label>
                    <input type="text" wire:model.blur="reference" id="reference" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-[#d4af37] focus:border-[#d4af37] sm:text-sm" required>
                    @error('reference') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <!-- Quantity -->
                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                    <input type="number" wire:model.blur="quantity" id="quantity" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-[#d4af37] focus:border-[#d4af37] sm:text-sm" >
                    @error('quantity') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <!-- Description -->
            <div class="mt-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea wire:model.blur="description" id="description" rows="4" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-[#d4af37] focus:border-[#d4af37] sm:text-sm" placeholder="Enter product description"></textarea>
                @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Pricing -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-semibold mb-4 text-gray-700">Pricing</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Price (DT)</label>
                    <input type="number" step="0.001" wire:model.blur="price" id="price" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-[#d4af37] focus:border-[#d4af37] sm:text-sm" required>
                    @error('price') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <!-- Promotion -->
                <div>
                    <label for="promotion" class="block text-sm font-medium text-gray-700">Promotion</label>
                    <select wire:model.blur="promotion" id="promotion" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-[#d4af37] focus:border-[#d4af37] sm:text-sm">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                    @error('promotion') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <!-- Promotion Value -->
                <div>
                    <label for="promotion_value" class="block text-sm font-medium text-gray-700">Promotion Percentage</label>
                    <input type="number" step="0.01" wire:model.blur="promotion_value" id="promotion_value" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-[#d4af37] focus:border-[#d4af37] sm:text-sm">
                    @error('promotion_value') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Category Selection -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-semibold mb-4 text-gray-700">Category</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <!-- Category -->
                <div>
                    <label for="selectedCategory" class="block text-sm font-medium text-gray-700">Category</label>
                    <select wire:model.blur="selectedCategory" id="selectedCategory" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-[#d4af37] focus:border-[#d4af37] sm:text-sm">
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('selectedCategory') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <!-- Subcategory -->
                <div>
                    <label for="selectedSubcategory" class="block text-sm font-medium text-gray-700">Subcategory</label>
                    <select wire:model.blur="selectedSubcategory" id="selectedSubcategory" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-[#d4af37] focus:border-[#d4af37] sm:text-sm" {{ !$selectedCategory ? 'disabled' : '' }}>
                        <option value="">-- Select Subcategory --</option>
                        @foreach($categories->find($selectedCategory)?->subcategories ?? [] as $sub)
                            <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                        @endforeach
                    </select>
                    @error('selectedSubcategory') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <!-- Sub-Subcategory -->
                <div>
                    <label for="subsub_category_id" class="block text-sm font-medium text-gray-700">Sub-Subcategory</label>
                    <select wire:model.blur="subsub_category_id" id="subsub_category_id" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-[#d4af37] focus:border-[#d4af37] sm:text-sm" {{ !$selectedSubcategory ? 'disabled' : '' }}>
                        <option value="">-- Select Sub-Subcategory --</option>
                        @foreach($categories->find($selectedCategory)?->subcategories->find($selectedSubcategory)?->subsubcategories ?? [] as $subsub)
                            <option value="{{ $subsub->id }}">{{ $subsub->name }}</option>
                        @endforeach
                    </select>
                    @error('subsub_category_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Status -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-semibold mb-4 text-gray-700">Status</h2>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select wire:model.blur="status" id="status" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-[#d4af37] focus:border-[#d4af37] sm:text-sm" required>
                    <option value="Disponible">Disponible</option>
                    <option value="sur commande">Sur commande</option>
                </select>
                @error('status') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Images -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-semibold mb-4 text-gray-700">Images</h2>
            <!-- Existing Images -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Select Existing Images</label>
                @if($existingImages->isEmpty())
                    <p class="text-gray-500 text-sm">No existing images available.</p>
                @else
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 max-h-80 overflow-y-auto p-4 border border-gray-200 rounded-lg bg-gray-50">
                        @foreach($existingImages as $image)
                            <label class="relative block cursor-pointer">
                                <input 
                                    type="checkbox" 
                                    wire:model.live="existing_images" 
                                    value="{{ $image->id }}" 
                                    class="absolute opacity-0 peer" 
                                >
                                <img 
                                    src="{{ asset($image->image_path) }}" 
                                    alt="Image" 
                                    class="w-24 h-24 object-cover rounded-md border-2 transition-all duration-200 peer-checked:border-[#d4af37] peer-checked:ring-2 peer-checked:ring-[#d4af37]/50 hover:border-[#d4af37]/70"
                                >
                                <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-10 transition-all duration-200 rounded-md"></div>
                                <svg 
                                    class="absolute top-2 right-2 w-6 h-6 text-[#d4af37] opacity-0 peer-checked:opacity-100 transition-opacity duration-200" 
                                    fill="currentColor" 
                                    viewBox="0 0 20 20"
                                >
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </label>
                        @endforeach
                    </div>
                @endif
                @error('existing_images') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <!-- New Images -->
            <div>
                <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Upload New Images (You can select multiple images)</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-[#d4af37] transition-colors duration-200">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="images" class="relative cursor-pointer bg-white rounded-md font-medium text-[#d4af37] hover:text-[#b38f1d] focus-within:outline-none">
                                <span>Select multiple files</span>
                                <input type="file" wire:model="images" id="images" multiple accept="image/*" class="sr-only">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB each</p>
                    </div>
                </div>
                @error('images.*') 
                    <span class="text-red-600 text-sm block mt-2">{{ $message }}</span> 
                @enderror
                
                <!-- Preview selected images -->
                @if ($images)
                    <div class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @foreach($images as $image)
                            @if($image && method_exists($image, 'temporaryUrl'))
                                <div class="relative group">
                                    <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="h-24 w-24 object-cover rounded-lg">
                                    <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-200 rounded-lg flex items-center justify-center">
                                        <button type="button" wire:click="removeUploadedImage({{ $loop->index }})" class="text-white hover:text-red-500">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="bg-[#6a0a0a] text-white px-6 py-2 rounded-md hover:bg-[#8B0000] focus:outline-none focus:ring-2 focus:ring-[#d4af37] transition">
                Create Product
            </button>
        </div>
    </form>
</div>