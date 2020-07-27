<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use App\Purchase_detail;
use App\Supplier;

class PurchaseController extends Controller
{
    
    public function index()
    {
        $purchases  = Purchase::paginate(5);
        $suppliers = Supplier::all();
        return view('purchase.index', compact('purchases', 'suppliers'));
    }

    public function detail($id)
    {
        $total = Purchase::findOrFail($id)->total;
        $details = Purchase_detail::where('purchase_id', $id)->get();
        return view('purchase.purchase_detail', compact('details', 'total'));
    }

}
