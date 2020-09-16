<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Purchase;
use App\Purchase_detail;
use App\Supplier;
use App\Product;
use App\Helpers\PurchaseHelper;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\Facades\DataTables as DataTables;

class PurchaseController extends Controller
{

    public function index()
    {
        if (request()->ajax()) {
            $purchases  = Purchase::all();
            return DataTables::of($purchases)
                ->addIndexColumn()
                ->removeColumn('total')
                ->addColumn('supplier', function ($purchases) {
                    return $purchases->supplier->name;
                })
                ->addColumn('Total', function ($purchases) {
                    return "Rp " . number_format($purchases->total);
                })
                ->addColumn('Action', function ($purchases) {
                    return view('purchase.datable_column', compact('purchases'));
                })
                ->removeColumn('id')
                ->rawColumns(['Action', 'supplier', 'Total'])
                ->make(true);
        }
        return view('purchase.index');
    }

    public function create()
    {
        return view('purchase.create');
    }

    public function getSuppliers()
    {
        $suppliers = Supplier::latest()->get();
        return DataTables::of($suppliers)
            ->addIndexColumn()
            ->addColumn('Action', function ($suppliers) {
                return "<center><button style='border-radius: 0%' class='btn btn-sm btn-success btn-check-supplier' data-id='$suppliers->id'><i class='fas fa-check'></i></button></center>";
            })
            ->rawColumns(['Action'])
            ->make(true);
    }

    public function getProducts()
    {
        $products = Product::all();
        return DataTables::of($products)
            ->addIndexColumn()
            ->addColumn('Action', function ($products) {
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

    public function store(Request $req)
    {
        // validasi
        $customMessages = [
            // qty
            'qty.*.required' => 'Item quantity is required',
            'qty.*.numeric' => 'Item quantity must be a number',
            'qty.*.digits_between' => 'Item quantitiy length should be between 1 and 4 digits',
            'qty.*.min' => 'Item quantity must be at least 1',
            // price
            'price.*.required' => 'Item price is required',
            'price.*.numeric' => 'Item price must be a number',
            'price.*.min' => 'Item price must be at least 3 digits',
            // product_id
            'product_id.*.required' => 'Product is required',
            'product_id.*.distinct' => 'Product field has a duplicate value'
        ];

        $validator = Validator::make($req->all(), [
            'supplier_id' => 'required|numeric',
            'product_id' => 'required|array',
            'product_id.*' => 'required|distinct',
            'price' => 'required|array',
            'price.*' => 'required|numeric|min:3',
            'qty' => 'required|array',
            'qty.*' => 'required|numeric|digits_between:1,4|min:1'
        ], $customMessages, [
            'supplier_id' => 'supplier'
        ]);

        if ($validator->fails()) {
            $errors = [
                $validator->errors()->first('product_id.*'),
                $validator->errors()->first('price.*'),
                $validator->errors()->first('qty.*'),
            ];
            return response()->json($errors, 422);
        }

        // menghitung total
        $total = PurchaseHelper::count_total($req->price, $req->qty);

        // input ke table purchase
        $purchase = new Purchase;
        $purchase->total = $total;
        $purchase->supplier_id = $req->supplier_id;
        $purchase->save();

        // input ke table purchase_details
        foreach ($req->product_id as $key => $value) {
            $details = new Purchase_detail;
            $details->purchase_id = $purchase->id;
            $details->product_id = $value;
            $details->subtotal = $req->price[$key] * $req->qty[$key];
            $details->price = $req->price[$key];
            $details->qty = $req->qty[$key];
            $details->save();
        }

        // mengembalikan pesan sukses
        return response()->json([
            'type' => 'success',
            'message' => 'Berhasil Menambah Data'
        ]);
    }

    public function detail($id)
    {
        $total = Purchase::findOrFail($id)->total;
        $details = Purchase_detail::where('purchase_id', $id)->get();
        return view('purchase.purchase_detail', compact('details', 'total'));
    }

    public function addQty(Request $req)
    {
        $qty = $req->qty += 1;
        return response()->json($qty, 200);
    }

    public function minQty(Request $req)
    {
        if ($req->qty == 1) {
            return response()->json([
                'type' => 'error',
                'message' => '1 is minimum quantity'
            ], 422);
        }
        $qty = $req->qty -= 1;
        return response()->json($qty, 200);
    }

    public function generatePdf()
    {
        $purchases = Purchase::all();
        $pdf = PDF::loadView('purchase.purchase_pdf', compact('purchases'));
        return $pdf->stream();
    }

    public function generateDetailPdf($id)
    {
        $purchase = Purchase::findOrFail($id);
        $pdf = PDF::loadView('purchase.purchase_detail_pdf', compact('purchase'));
        return $pdf->stream();
    }

}
