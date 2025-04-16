<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        // Eager-load subcategories so we can loop over them.
        $category->load('subcategories');

        // For each subcategory, dynamically fetch its products.
        // We assume your subsub_categories table has a "subcategory_id" column.
        foreach ($category->subcategories as $subcat) {
            // Query Products whose related subsubCategory belongs to the current subcategory.
            // This uses a whereHas on the product's subsubCategory.
            $subcat->products = Product::whereHas('subsubCategory', function ($query) use ($subcat) {
                $query->where('subcategory_id', $subcat->id);
            })->get();
        }

        return view('category.show', compact('category'));
    }

    public function showCategory($id)
{
    $category = Category::with(['subcategories.products'])->findOrFail($id);

    return view('home', compact('category'));
}

public function index(Category $category, Request $request)
{
    // Use the already-bound Category model.
    $subcategories = $category->subcategories;
    
    // Set defaults for price filtering; you'll pass these along.
    $minPrice = $request->get('minPrice', 0);
    $maxPrice = $request->get('maxPrice', 10000);
    
    // Optionally, if you want to display an initial product count,
    // you can run a query like the one you had earlier:
    $totalProducts = Product::query()
    ->whereHas('subsubCategory.subcategory.category', fn($q) => 
        $q->where('id', $category->id)
    )
    ->when($request->has('subcategory'), fn($q) =>
        $q->whereHas('subsubCategory', fn($q) =>
            $q->where('subcategory_id', $request->input('subcategory'))
        )
    )
    ->when($request->has('subsubcategory'), fn($q) =>
        $q->where('subsub_category_id', $request->input('subsubcategory'))
    )
    ->count();
    
    // Pass necessary context to the view.
    return view('category.index', compact('category', 'subcategories', 'minPrice', 'maxPrice', 'totalProducts'));
}





}
