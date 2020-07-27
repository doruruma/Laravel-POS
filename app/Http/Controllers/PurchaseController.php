<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use App\Supplier;

class PurchaseController extends Controller
{
    
    public function index()
    {
        $purchases  = Purchase::paginate(5);
        $suppliers = Supplier::all();
        return view('purchase.index', compact('purchases', 'suppliers'));
    }

}
