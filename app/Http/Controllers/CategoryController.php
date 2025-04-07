<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        // Optionally load related data, e.g.:
        // $category->load('products');

        return view('category.show', compact('category'));
    }

    public function showCategory($id)
{
    $category = Category::with(['subcategories.products'])->findOrFail($id);

    return view('home', compact('category'));
}
}
