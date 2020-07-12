<?php

namespace App\Http\Controllers;

use App\Product;
use App\Customer;
use Illuminate\Http\Request;

class CashierController extends Controller
{

    public function index()
    {
        $customers = Customer::all();
        $products = Product::with('category')->get();
        return view('cashier.index', compact('customers', 'products'));
    }

}
