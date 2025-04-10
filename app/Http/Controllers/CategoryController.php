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

    $query = Product::query();

    // Apply filters if a subcategory is provided.
    if ($request->has('subcategory')) {
        $subcategoryId = $request->get('subcategory');
        $query->whereHas('subsubCategory', function ($q) use ($subcategoryId) {
            $q->where('subcategory_id', $subcategoryId);
        });
    }

    // Filter by search term.
    if ($request->filled('search')) {
        $query->where('name', 'LIKE', '%' . $request->search . '%');
    }

    // Apply sorting.
    if ($request->filled('sort')) {
        switch ($request->sort) {
            case 'prix-asc':
                $query->orderBy('price', 'asc');
                break;
            case 'prix-desc':
                $query->orderBy('price', 'desc');
                break;
            case 'pertinence':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }
    } else {
        $query->orderBy('created_at', 'desc');
    }

    // Apply price filtering before pagination.
    $minPrice = $request->get('minPrice', 7);
    $maxPrice = $request->get('maxPrice', 396);
    $query->whereBetween('price', [$minPrice, $maxPrice]);

    // Paginate results.
    $perPage = $request->get('perPage', 27);
    $products = $query->paginate($perPage);

    // Total product count for the header.
    $totalProducts = $products->total();

    return view('category.index', compact(
        'category',
        'subcategories',
        'products',
        'minPrice',
        'maxPrice',
        'perPage',
        'totalProducts'
    ));
}




}
