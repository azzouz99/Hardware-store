@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Create Product</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Product Name -->
        <div class="mb-4">
            <label for="name" class="block font-medium">Name:</label>
            <input type="text" name="name" id="name" class="w-full border p-2" required>
        </div>
        <!-- Description  -->
        <div class="mb-4">
            <label for="description" class="block font-medium">Description:</label>
            <textarea name="description" id="description" rows="4" class="w-full border p-2" placeholder="Enter product description"></textarea>
        </div>

        <!-- Unit -->
        <div class="mb-4">
            <label for="unite" class="block font-medium">Unité:</label>
            <input type="text" name="unite" id="unite" class="w-full border p-2" required>
        </div>
        <!-- Price Field -->
        <div class="mb-4">
            <label for="price" class="block font-medium">Price (DT):</label>
            <input type="number" step="0.001" name="price" id="price" class="w-full border p-2" required>
        </div>
        <!-- Reference -->
        <div class="mb-4">
            <label for="reference" class="block font-medium">Reference:</label>
            <input type="text" name="reference" id="reference" class="w-full border p-2" required>
        </div>

        <!-- Quantity -->
        <div class="mb-4">
            <label for="quantity" class="block font-medium">Quantity:</label>
            <input type="number" name="quantity" id="quantity" class="w-full border p-2" required>
        </div>

        <!-- Status -->
        <div class="mb-4">
            <label for="status" class="block font-medium">Status:</label>
            <select name="status" id="status" class="w-full border p-2" required>
                <option value="Disponible">Disponible</option>
                <option value="sur commande">Sur commande</option>
            </select>
        </div>

        <!-- Promotion -->
        <div class="mb-4">
            <label for="promotion" class="block font-medium">Promotion:</label>
            <select name="promotion" id="promotion" class="w-full border p-2">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>

        <!-- Promotion Value -->
        <div class="mb-4">
            <label for="promotion_value" class="block font-medium">Promotion Percentage:</label>
            <input type="number" step="0.01" name="promotion_value" id="promotion_value" class="w-full border p-2" value="0">
        </div>

        <!-- Dependent Dropdowns for Sub-Subcategory Selection -->
        <div x-data='{
            "selectedCategory": "",
            "selectedSubcategory": "",
            "categories": @json($categories ?? []),
            get filteredSubcategories() {
                const cat = this.categories.find(c => c.id == this.selectedCategory);
                return cat ? cat.subcategories : [];
            },
            get filteredSubsubcategories() {
                const sub = this.filteredSubcategories.find(s => s.id == this.selectedSubcategory);
                return sub ? sub.subsubcategories : [];
            }
        }' class="mb-4">
            <!-- Category Dropdown -->
            <div class="mb-4">
                <label for="category" class="block font-medium">Category:</label>
                <select x-model="selectedCategory" id="category" class="w-full border p-2">
                    <option value="">-- Select Category --</option>
                    <template x-for="cat in categories" :key="cat.id">
                        <option :value="cat.id" x-text="cat.name"></option>
                    </template>
                </select>
            </div>

            <!-- Subcategory Dropdown -->
            <div class="mb-4" x-show="selectedCategory != ''">
                <label for="subcategory" class="block font-medium">Subcategory:</label>
                <select x-model="selectedSubcategory" id="subcategory" class="w-full border p-2">
                    <option value="">-- Select Subcategory --</option>
                    <template x-for="sub in filteredSubcategories" :key="sub.id">
                        <option :value="sub.id" x-text="sub.name"></option>
                    </template>
                </select>
            </div>

            <!-- Sub‑Subcategory Dropdown -->
            <div class="mb-4" x-show="selectedSubcategory != ''">
                <label for="subsub_category_id" class="block font-medium">Sub‑Subcategory:</label>
                <select name="subsub_category_id" id="subsub_category_id" class="w-full border p-2">
                    <option value="">-- Select Sub‑Subcategory --</option>
                    <template x-for="subsub in filteredSubsubcategories" :key="subsub.id">
                        <option :value="subsub.id" x-text="subsub.name"></option>
                    </template>
                </select>
            </div>
        </div>

        <!-- Images (Optional) -->
        <div class="mb-4">
            <label for="images" class="block font-medium">Images:</label>
            <input type="file" name="images[]" id="images" multiple class="w-full border p-2">
        </div>

        <button type="submit" class="bg-blue-600 text-BLACK px-4 py-2 rounded">Create Product</button>
    </form>
</div>
@endsection
