<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CashierController extends Controller
{

    public function index()
    {
        $categories = Category::with('products')->get();
        return view('cashier.index', compact('categories'));
    }

}
