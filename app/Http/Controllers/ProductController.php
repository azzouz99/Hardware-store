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
        return view('admin.products.create');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
