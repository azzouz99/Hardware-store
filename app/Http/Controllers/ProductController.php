<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubsubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function create()
    {
        // Fetch all sub‑subcategories (you can customize this query as needed)
        $categories = Category::with('subcategories.subsubcategories')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'               => 'required|string|max:255',
            'unite'              => 'required|string|max:50',
            'reference'          => 'required|string|max:100',
            'quantity'           => 'required|integer',
            'status'             => 'required|in:Disponible,sur commande',
            'promotion'          => 'nullable|boolean',
            'price'              => 'required|numeric|min:0',
            'promotion_value'    => 'nullable|integer|min:0|max:100',
            'subsub_category_id' => 'required|exists:subsub_categories,id',
            'images'             => 'nullable|array',
            'images.*'           => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Handle images as needed (file upload, etc.)
        ]);

        // Create the product (adjust if you need to process images)
        $product = Product::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                // Store the image in the "products" folder of your public disk.
                $path = $imageFile->store('products', 'public');
    
                // Create or retrieve an Image model record.
                // We store the image path (e.g., "/storage/products/filename.jpg").
                $image = \App\Models\Image::firstOrCreate([
                    'image_path' => '/storage/' . $path,
                ]);
    
                // Attach the image to the product via the pivot table.
                $product->images()->attach($image->id);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }
}
