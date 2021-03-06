<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {
        $total = 0;
        $cart = session()->get('cart');
        if ($cart) {
            foreach ($cart as $c) {
                $total += ($c['price'] * $c['qty']);
            }
        }
        return view('cashier.cart', compact('total'));
    }

    public function addQty($id)
    {
        $cart = session()->get('cart');
        $cart[$id]['qty']++;
        session()->put('cart', $cart);
        return response()->json($cart[$id]['qty']);
    }

    public function minQty($id)
    {
        $cart = session()->get('cart');
        if ($cart[$id]['qty'] > 1) {
            $cart[$id]['qty']--;
        } else {
            return response()->json('Item quantity is only one', 401);
        }
        session()->put('cart', $cart);
        return response()->json($cart[$id]['qty']);
    }

    public function delete($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect(route('cart'))->with([
                'type' => 'success',
                'message' => 'Berhasil Menghapus Barang'
            ]);
        } else {
            return redirect(route('cart'))->with([
                'type' => 'error',
                'message' => 'Data Tidak Valid'
            ]);
        }
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
                    'id' => $id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'qty' => 1,
                ]
            ];
            session()->put('cart', $cart);
            return response()->json(['message' => 'Item(s) successfully added to cart'], 200);
        }

        // if item exist in cart
        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
            session()->put('cart', $cart);
            return response()->json(['message' => 'Item Quantity increased'], 200);
        }

        // if not exist
        $cart[$id] = [
            'id' => $id,
            'name' => $product->name,
            'price' => $product->price,
            'qty' => 1
        ];
        session()->put('cart', $cart);
        return response()->json(['message' => 'Item(s) successfully added to cart'], 200);
    }
}
