<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class CashierController extends Controller
{

    public function index()
    {
        $products = Product::with('category')->paginate(4);
        return view('cashier.index', compact('products'));
    }

    public function paginateProduct(Request $req)
    {
        if ($req->ajax()) { 
            $products = Product::paginate(4);
            return view('cashier.productList', compact('products'))->render();
        }
    }

    public function searchProduct(Request $req)
    {
        $searchKey = $req->searchKey;
        $products = Product::where('name', 'like', '%' . $searchKey . '%')
            ->where('description', 'like', '%' . $searchKey . '%')->paginate(4);
        return view('cashier.productList', compact('products'));
    }
}
