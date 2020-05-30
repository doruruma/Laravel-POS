<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class CashierController extends Controller
{

    public function index()
    {
        $categories = Category::with('products')->get();
        return view('cashier.index', compact('categories'));
    }

    public function cart()
    {
        return view('cashier.cart');
    }

    public function store($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Invalid Item'], 401);
        }

        $cart = session()->get('cart');
        // if cart not created yet
        if (!$cart) {
            $cart = [
                $id => [
                    'name' => $product->name,
                    'price' => $product->price,
                    'qty' => 1,
                ]
            ];
            session()->put('cart', $cart);
            return response()->json(['message' => 'Added to Cart'], 200);
        }

        // if item exist in cart
        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
            session()->put('cart', $cart);
            return response()->json(['message' => 'Added to Cart'], 200);
        }

        // if not exist
        $cart[$id] = [
            'name' => $product->name,
            'price' => $product->price,
            'qty' => 1
        ];
        session()->put('cart', $cart);
        return response()->json(['message' => 'Added to Cart'], 200);
    }

}
