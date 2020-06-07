<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class CashierController extends Controller
{

    public function index()
    {
        $products = Product::with('category')->get();
        return view('cashier.index', compact('products'));
    }

}
