<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{

    public function index()
    {
        if (request()->ajax()) {
            $suppliers = Supplier::all();
            return DataTables::of($suppliers)
                ->addIndexColumn()
                ->addColumn('Action', function ($suppliers) {
                    return view('supplier.datatable_column', compact('suppliers'));
                })
                ->removeColumn('id')
                ->rawColumns(['Action'])
                ->make(true);
        }
        return view('supplier.index');
    }

    public function get($supplier)
    {
        return response()->json(Supplier::findOrFail($supplier));
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|min:3',
            'address' => 'required|min:4',
            'phone' => 'required|numeric|min:11'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $supplier = new Supplier;
        $supplier->name = $req->name;
        $supplier->address = $req->address;
        $supplier->phone = $req->phone;
        $supplier->save();
    }

    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|min:3',
            'address' => 'required|min:4',
            'phone' => 'required|numeric:min:11'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        Supplier::whereId($id)->update([
            'name' => $req->name,
            'address' => $req->address,
            'phone' => $req->phone
        ]);
    }

    public function delete(Supplier $supplier)
    {
        $supplier->delete();
        return redirect(route('supplier'))->with([
            'type' => 'success',
            'message' => 'Berhasil Hapus Data'
        ]);
    }
}
