<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.orders.index');
    }

    public function customerOrders()
    {
        $user = Auth::user();

        $orders = $user->orders()->with('products')->get();
        return view('profile.orders', compact('orders'));
    }
}
