<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $promotedProducts = Product::promoted()->get();
        $categories = Category::with('subcategories.subsubcategories', 'subcategories.products')->get();
        $category = $categories->first(); // For instance, show details for the first category
        return view('home', compact('categories', 'category','promotedProducts'));
    }
    
}
