<?php

namespace App\Http\Controllers;

use App\Product;
use App\Customer;
use Illuminate\Http\Request;

class CashierController extends Controller
{

    public function index()
    {
        $customers = Customer::paginate(4);
        $products = Product::with('category')->paginate(4);
        return view('cashier.index', compact('customers', 'products'));
    }

    public function paginateProduct(Request $req)
    {
        if ($req->ajax()) { 
            $products = Product::paginate(4);
            return view('cashier.productList', compact('products'))->render();
        }
    }

    public function paginateCustomer(Request $req)
    {
        if ($req->ajax()) { 
            $result = Customer::paginate(3);
            return view('cashier.customerList', compact('result'))->render();
        }
    }

    public function searchCustomer(Request $req)
    {
        $searchKey = $req->searchKey;
        $customers = Customer::where('name', 'like', '%' . $searchKey . '%')
            ->where('email', 'like', '%' . $searchKey . '%')->paginate(4);
        return view('cashier.customerList', compact('customers'));
    }

    public function searchProduct(Request $req)
    {
        $searchKey = $req->searchKey;
        $products = Product::where('name', 'like', '%' . $searchKey . '%')
            ->where('description', 'like', '%' . $searchKey . '%')->paginate(4);
        return view('cashier.productList', compact('products'));
    }
}
