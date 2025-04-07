<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('subcategories.subsubcategories', 'subcategories.products')->get();
        $category = $categories->first(); // For instance, show details for the first category
        return view('home', compact('categories', 'category'));
    }
    
}
