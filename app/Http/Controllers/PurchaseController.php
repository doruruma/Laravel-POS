<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Purchase;
use App\Purchase_detail;
use App\Supplier;
use App\Product;
use Yajra\DataTables\Facades\DataTables as DataTables;

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
                return "<center><button style='border-radius: 0%' class='btn btn-sm btn-success btn-check-supplier' data-id='$suppliers->id'><i class='fas fa-check'></i></button></center>";
            })
            ->rawColumns(['Action'])
            ->make(true);
    }

    public function getProducts()
    {
        $products = Product::all();
        return DataTables::of($products)
            ->addColumn('Action', function($products) {
                return "<center><button style='border-radius: 0%' class='btn btn-sm btn-success btn-check-product' data-id='$products->id' data-name='$products->name'><i class='fas fa-check'></i></button></center>";
            })
            ->rawColumns(['Action'])
            ->make(true);
    }

    public function getSupplierById($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('purchase.list_group_item_supplier', compact('supplier'));
    }

    public function getTableProduct()
    {
        return view('purchase.table_product');
    }

    public function create()
    {
        return view('purchase.create');
    }

    public function store(Request $req)
    {

        $customMessages = [
            // qty
            'qty.*.required' => 'Item quantity is required',
            'qty.*.numeric' => 'Item quantity must be a number',
            // price
            'price.*.required' => 'Item price is required',
            'price.*.numeric' => 'Item price must be a number',
            'price.*.min' => 'Item price must be at least 3 digits',
            // product_id
            'product_id.*.required' => 'Product is required'
        ];

        $validator = Validator::make($req->all(), [
            'supplier_id' => 'required|numeric',
            'product_id' => 'required|array',
            'product_id.*' => 'required',
            'price' => 'required|array',
            'price.*' => 'required|numeric|min:3',
            'qty' => 'required|array',
            'qty.*' => 'required|numeric'
        ], $customMessages, [
            'supplier_id' => 'supplier'
        ]);
        
        if($validator->fails()) {
            $errors = [
                $validator->errors()->first('product_id.*'),
                $validator->errors()->first('price.*'),
                $validator->errors()->first('qty.*'),
            ];
            return response()->json($errors, 422);
        }
    }

    public function detail($id)
    {
        $total = Purchase::findOrFail($id)->total;
        $details = Purchase_detail::where('purchase_id', $id)->get();
        return view('purchase.purchase_detail', compact('details', 'total'));
    }

}
