<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Arr;
use App\Models\SubsubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        // Validate the request data, including the images array.
        $validated = $request->validate([
            'name'               => 'required|string|max:255',
            'unite'              => 'required|string|max:50',
            'reference'          => 'required|string|max:100',
            'quantity'           => 'required|integer',
            'status'             => 'required|in:Disponible,sur commande',
            'promotion'          => 'nullable|boolean',
            'promotion_value'    => 'nullable|integer|min:0|max:100',
            'price'              => 'required|numeric|min:0',
            'subsub_category_id' => 'required|exists:subsub_categories,id',
            'description'        => 'nullable|string',
            'images'             => 'nullable|array',
            'images.*'           => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Remove the images key from the validated data so it doesn't get inserted into products table.
        $productData = Arr::except($validated, ['images']);
    
        Log::info('Creating product with data:', $productData);
    
        // Create the product using the data that does not include images.
        $product = Product::create($productData);
        Log::info("Product created with ID: {$product->id}");
    
        // Process uploaded images (if any)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $originalName = $imageFile->getClientOriginalName();
                Log::info("Processing image: {$originalName}");
    
                // Store the image file in the 'products' directory on the 'public' disk
                $path = $imageFile->store('products', 'public');
                Log::info("Stored image at path: {$path}");
    
                // Create or retrieve an Image record in the images table
                $image = Image::firstOrCreate([
                    'image_path' => '/storage/' . $path,
                ]);
                Log::info("Image record created with ID: {$image->id}");
    
                // Attach the image to the product using the pivot table image_product
                $product->images()->attach($image->id);
                Log::info("Attached image {$image->id} to product {$product->id}");
            }
        } else {
            Log::info("No images uploaded for product ID: {$product->id}");
        }
    
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }
}
