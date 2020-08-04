<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use App\Purchase_detail;
use App\Supplier;
use DataTables;

class PurchaseController extends Controller
{
    
    public function index()
    {
        $purchases  = Purchase::paginate(5);
        return view('purchase.index', compact('purchases'));
    }

    public function getSuppliers()
    {
        $suppliers = Supplier::latest()->get();
        return DataTables::of($suppliers)
            ->addColumn('Action', function($suppliers) {
                return "<button style='border-radius: 0%' class='btn btn-sm btn-success btn-check-supplier' data-id='$suppliers->id'><i class='fas fa-check'></i></button>";
            })
            ->rawColumns(['Action'])
            ->make(true);
    }

    public function getSupplierById($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('purchase.list_group_item_supplier', compact('supplier'));
    }

    public function getTableItem()
    {
        return view('purchase.table_item');
    }

    public function create()
    {
        $suppliers = Supplier::all();
        return view('purchase.create', compact('suppliers'));
    }

    public function detail($id)
    {
        $total = Purchase::findOrFail($id)->total;
        $details = Purchase_detail::where('purchase_id', $id)->get();
        return view('purchase.purchase_detail', compact('details', 'total'));
    }

}
