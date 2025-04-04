<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller {
    public function index() {
        // Eager-load subcategories and their subsubcategories
        $categories = Category::with('subcategories.subsubcategories')->get();
        return view('menu', compact('categories'));
    }
}
